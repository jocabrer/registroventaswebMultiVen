<?php

class M_pedido extends CI_Model {

	

  	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		
    }
    
    /**
	
	/**
	 * Funcion que elimina un pedido de la base de datos
	 * @param int $id_pedido el pedido id a eliminar
	 * @return boolean true o false segun corresponda
	 */
	function eliminaPedido($id_pedido){
        
	    $this->db->trans_start();
	    $this->db->query("DELETE FROM hojas WHERE id_cabecera = ".$id_pedido.";");
	    $this->db->query("DELETE FROM cabecera_notas WHERE id_cabecera = ".$id_pedido.";");
	    $this->db->query("DELETE FROM comentarios WHERE id_cabecera = ".$id_pedido.";");
	    $this->db->query("DELETE FROM movimiento_cab WHERE id_cabecera = ".$id_pedido.";");
	    $this->db->query("DELETE FROM movimiento_cta WHERE id_cabecera = ".$id_pedido.";");
	    $this->db->query("DELETE FROM cambioestado WHERE id_cabecera = ".$id_pedido.";");
	    $this->db->query("DELETE FROM detalle WHERE id_cabecera = ".$id_pedido.";");
	    $this->db->query("DELETE FROM cabecera WHERE id = ".$id_pedido.";");
	    $this->db->trans_complete(); 
	    
	    if ($this->db->trans_status() === FALSE)
	    {
	       return false;
	    }else 
	        return true;
	        
	}

	/**
	 * Funcion que elimina registro de adjunto.
	 * @param int $id_adjunto el id del registro a elimina 
	 */
	function eliminaAdjunto($id_adjunto){
		$ejecucion = $this->db->delete('adjuntos', array('id' => $id_adjunto)); 
		return true;
	}

	/**
	 * Elimina línea de detalle de pedido
	 */
	function eliminaLineaDetallePedido($id)
	{
		return $this->db->simple_query("DELETE FROM  `detalle` WHERE `id` = ".$id);
	}
	/**
	 * Actualiza la propiedad ConFactura
	 * @param unknown $id_pedido cabecera a actualizar
	 * @param unknown $chkiva valor a actualizar
	 */
	function actualizaPedidoPropiedadFactura($id_pedido,$chkiva)
	{
		
		$this->db->simple_query("UPDATE `cabecera` SET `ConFactura` = ".(int)$chkiva." WHERE `id` = '".$id_pedido."'");
		
	}
    /**
     * Actualiza los datos de la cabecera de un pedido.
     * @param $id_cabecera
     * @param $id_estado
     * @param $fec_ing
     */
	function actualizaPedidosDatosCabecera($id_cabecera,$id_estado,$id_user,$fecha_mod)
	{
	    //extra�amente poniendo y d m funcion no asi y-m-d
	    //$fec_ing = date_format(DateTime::createFromFormat('Y-m-d', $fec_ing),'Y-m-d H:i:s');
	    if($id_estado!=-1)
		  $this->estadoActual   = $id_estado;
		//$this->fecha_ingreso  = $fec_ing;
		if($id_user<>-1){
		    $this->id_user = $id_user;
		}
		$this->fecha_mod = $fecha_mod->format('Y-m-d H:i:s');;
		$this->db->update('cabecera', $this, array('id' => $id_cabecera));
	}
	/**
	 * Inserta la cabacera de un nuevo pedido.
	 * @param unknown $id_cliente
	 * @param unknown $fecha
	 * @param unknown $id_user
	 * @param unknown $fecha_mod
	 * @return unknown
	 */
	function insertaPedidoCabecera($id_cliente,$fecha,$id_user,$fecha_mod)
    {
        //var_dump($fecha);
        $fecha = date_format(DateTime::createFromFormat('Y-m-d H:i:s', $fecha),'Y-m-d H:i:s');

        $this->id_cliente    = $id_cliente;
        $this->fecha_ingreso  = $fecha ;
        $this->conFactura = 0;
        $this->id_user = $id_user;
        $this->fecha_mod = $fecha_mod->format('Y-m-d H:i:s');
        
        $this->db->insert('cabecera', $this);
        $insert_id = $this->db->insert_id();
        
        return  $insert_id;
    }
    /**
     * Inserta una nueva linea de detalle para el pedido
     * @param int $idpedido
     * @param int $cant
     * @param int $idprod
     * @param double $cos
     * @param double $pri
     * @return Id insertado
     */
 	function insertaPedidoLineaDetalle($idpedido,$cant,$idprod,$cos,$pri)
    {
    
        $data = array(
            'cantidad' =>  $cant,
            'id_cabecera' =>  $idpedido,
            'valor_cli' => $pri,
            'costo' => $cos,
            'id_producto' => $idprod
        );
    	
     
        $this->db->insert('detalle', $data);
        $insert_id = $this->db->insert_id();
        
        return  $insert_id;
    }
    /**
     * Inserta adjunto
     * @param int $id_pedido
     * @param varchar $nota
     * @param date $fecha_ing
     * @param int $userid
     */
    function insertaAdjuntoPedido($id_pedido, $userid, $tipo,$url,$fecha,$filename,$publico){
		
		
        $fecha = date_format(DateTime::createFromFormat('Y-m-d H:i:s', $fecha),'Y-m-d H:i:s');
        
        $this->id_cabecera    = $id_pedido;
        $this->id_user        = $userid;
        $this->id_tipo           = $tipo;
        $this->pathurl            = $url;
		$this->fecha_subida = $fecha ;
		$this->filename = $filename ;
		if($publico=="on")
			$this->publico = 0;
		else 
			$this->publico = 1;
        
        $result = $this->db->insert('adjuntos', $this);
        //echo $this->db->last_query();
        $insert_id = $this->db->insert_id();
        
        return  $insert_id;
        
        if($result){
            return  $insert_id;
        }else{
            return $this->db->_error_message();
        }
    }
	
	/**
	 * Funcion que obtiene un Adjunto
	 */
    function obtenerAdjunto($id){
		$this->db->where('id',$id);
		$query = $this->db->get('adjuntos');
		$result =  $query->result();		
		return $result[0];
	}
	/**
	 * Obtiene un registro de cabecera para el id 
	 * @param int $idcabecera 
	 */
    function obtenerPedido($idcabecera)
	{
		$this->db->where('id',$idcabecera);
		$query = $this->db->get('v_cabecera');
		return $query->result_array();
	}
	/**
	 * Obtiene las l�neas de detalle tabla:detalle  de cada pedido tabla:cabecera
	 * @param int $id_cabecera
	 * @return Detalles del pedido
	 */
	function obtenerPedidoDetalle($id_cabecera)
	{
	    $this->db->where('id_cabecera',$id_cabecera);
	    $query = $this->db->get('v_totaldetallepedido');
	    return $query->result();
	}
	/**
	 * Obtiene un listado de pedido en formato de reporte tipo hojas de trabajo.
	 * @param varchar $idpedidos
	 * @return Array de pedidos.
	 */
	function ObtenerPedidosFormatoListaHja($idpedidos)
	{
	    /* $query = "SELECT
	    
	    lp.`est_fec_ing` AS fechaingreso,
	    dp.id_cabecera AS pedido,
	    dp.`cantidad` AS cantidad,
	    dp.nom_prod AS producto,
	    dp.`costo_un` costo_cu,
	    dp.`det_costo` AS tot_costo,
	    dh.haber AS pagado,
	    lp.`SaldoFabrica` AS saldo,
	    lp.`iva`
	    FROM `v_totaldetallepedido` dp
	    INNER JOIN `v_listadopedidoextendido` lp ON dp.`id_cabecera` = lp.`numeroPedido`
	    LEFT JOIN v_cuentasdebehaber dh ON dp.id_cabecera = dh.id_cabecera  AND dh.id_cuenta = 2
	    WHERE dp.id_cabecera  IN (".$idpedidos.");";
	    
	    return  $this->db->query($query)->result_array();*/
	    //echo $this->db->last_query();
	    //exit(0);
	    $this->db->from('v_reportehoja');
	    $this->db->where_in('pedido', $idpedidos);
	    $this->db->order_by("pedido", "asc");
	    
	    return $this->db->get()->result_array();
	    
	    
	    
	    
	}
	/***
	 * Listado de pedido en base a criterios
	 */
	function ObtenerPedidosListado($criterio,$limit,$estados,$ordenarpor,$orden,$slcomision,$cliente)
	{
	    $data = $this->db->select('*')->from('v_listadopedidoextendido');
	    $data = $this->db->where_in(' estado_sec', $estados);
	    
	    if($cliente!="todos")
	        $data = $this->db->where(' cli_id', $cliente);
	        
	        if($slcomision <> -1){
	            $data = $this->db->where(' comision', $slcomision);
	        }
	        if($criterio!=""){
	            
	            $data = $this->db->group_start();
	            $data = $this->db->or_where(' numeroPedido =', $criterio);
	            $data = $this->db->or_like(' cli_nom', $criterio);
	            $data = $this->db->or_where(' cli_nom =', $criterio);
	            $data = $this->db->group_end();
	        }
	        $data = $this->db->limit($limit);
	        $data = $this->db->order_by($ordenarpor, $orden);
	        
	        //$res = null;
	        //if($cliente!="todos"){
	         $res = $this->db->get()->result_array();
	           //echo $this->db->last_query();
	          // var_dump($res);
	        //}
	        
	        
	        return $res;
	        
	        
	        //exit(0);
	        
	}
	/**
	 * Obtiene los indicadores de un pedido
	 * @param int $idpedido
	 * @return Indicadores
	 */
	function obtenerPedidoIndicadores($idpedido)
	{
	    $query = $this->db->query("SELECT
                                        ind.*,
                                        IFNULL(dh.haber,0) AS PagadoCliente,
                                        (IFNULL(dh.debe,0)-IFNULL(dh.haber,0)) SaldoCliente
                                    FROM
                                        v_indicador_lite ind
                                        LEFT JOIN v_cuentasdebehaber dh  ON ind.id_cabecera = dh.id_cabecera AND dh.tipo = 0
                                    WHERE ind.id_cabecera 	= " . $idpedido);
	    
	    return $query->result();
	}
	
	function obtenerTiposAdjuntos(){
		$query = $this->db->get('tipoadjunto');
		return $query->result_array();
	}
	/**
	 * 
	 */
	function obtenerPedidoAdjuntosListado($idpedido,$userid,$order){
		
		$this->db->select('*');
    	$this->db->from('v_adjunto');
    	$this->db->where('id_cabecera',$idpedido);
	    if($userid==-1){
			 //Significa que el usuario es publico x tanto solo debe ver los 0
			 $this->db->where('publico',0);
		}
		$this->db->order_by('id',$order);
		$query = $this->db->get();

		return $query->result_array(); 
	}

	/**
	 * Obtiene los indicadores de un pedido al detalle en varias lineas dependiendo los vendedores involucrados.
	 * @param unknown $idpedido
	 * @return unknown
	 */
	function obtenerPedidoIndicadoresDetalle($idpedido)
	{
	    $query = $this->db->query("SELECT
                                	ind.*,
                                	IFNULL(dh.haber,0) AS PagadoCliente,
                                	(IFNULL(dh.debe,0)-IFNULL(dh.haber,0)) SaldoCliente,
                                	dh1.`nombre_cta` NombreVendedor,
                                	(IFNULL(dh1.debe,0)-IFNULL(dh1.haber,0)) SaldoVendedor,
                                    (IFNULL(dh1.debe,0)) TotalVendedor
                                    FROM
                                	v_indicador_lite ind
                                	LEFT JOIN v_cuentasdebehaber dh  ON ind.id_cabecera = dh.id_cabecera AND dh.tipo = 0
                                	LEFT JOIN v_cuentasdebehaber dh1  ON ind.id_cabecera = dh1.id_cabecera 
                                    WHERE ind.id_cabecera = " . $idpedido);
	    
	    return $query->result();
	}
	
	/**
	 * Obtiene los datos de seguimiento de la vista v_seguimiento
	 * @param int $idcabecera numero de pedido
	 * @param int $idcliente cliente del pedido
	 * @param int $user id usuario actual
	 * @return unknown
	 */
	function obtenerPedidoSeguimiento($idcabecera, $idcliente,$userid){
	    
	    //v_seguimiento
	    $this->db->where('pedido',$idcabecera);
	    $this->db->where('id_cliente',$idcliente);
	    
	    if($userid==-1)
	        $this->db->where('publico',1);
	    
	    $this->db->where_not_in('tipo','E');
	    $this->db->order_by('fecha_mod','desc');
	    
	    $query = $this->db->get('v_seguimiento');
	    
	    return $query->result_array();
	}
	/*function get_Hoja($hoja)
	{
	    $query = $this->db->where('nombre_hoja',$hoja);
	    $query =$this->db->order_by('orden', 'asc');
	    $query =$this->db->get('hoja');
	    return $query->result_array();
	}
	
	function get_Hojas()
	{
	    $query =$this->db->order_by('orden', 'asc');
	    $query =$this->db->get('hoja');
	    return $query->result_array();
	}*/
	
	function existePedidoCliente($idcabecera,$idcliente){
	    
	    $this->db->where('id', $idcabecera);
	    $this->db->where('id_cliente', $idcliente);
	    $this->db->from('cabecera');
	    $cant =  $this->db->count_all_results();
	    if ($cant>0)
	        return true;
	        else
	            return false;
	}
	function existePedido($idcabecera)
	{
		$this->db->where('id', $idcabecera);
		$this->db->from('cabecera');
		$cant =  $this->db->count_all_results();
		if ($cant>0)
			return true;
		else 
			return false;
	}
	
	
	
	

}

?>