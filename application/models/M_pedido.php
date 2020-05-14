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
	    if($id_estado!=-1)
		  $this->estadoActual   = $id_estado;

		  if($id_user<>-1){
		    $this->id_user = $id_user;
		}
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
        $this->id_cliente    = $id_cliente;
        $this->fecha_ingreso  = $fecha ;
        $this->conFactura = 0;
        $this->id_user = $id_user;
      
        
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
     * Función que busca adjuntos con diversos criterios y ordenamientos.
     *
     * @param [type] $limit
     * @param [type] $descasc
     * @param [type] $criterio
     * @return void
     */
    function buscador_adjuntos($limit,$descasc,$criterio){

        if(strlen($criterio)>0){
			$this->db->or_like('id_cabecera',$criterio);
			$this->db->or_like('filename',$criterio);
		}

        $this->db->limit($limit);
        $this->db->order_by("fecha_subida",$descasc);

        $query = $this->db->get('v_adjunto');
        
    	return $query->result_array();
    }


	/**
	 * Obtiene un registro de cabecera para el id 
	 * @param int $idcabecera 
	 */
    function obtenerPedido($idcabecera)
	{

		$this->db->select('v_cabecera.*, v_indicador_lite.comision');
		$this->db->from('v_cabecera');
		$this->db->join('v_indicador_lite', 'v_cabecera.id = v_indicador_lite.id_cabecera ', 'left');
		$this->db->where('v_cabecera.id',$idcabecera);
		$query = $this->db->get();
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
	    $this->db->from('v_reportehoja');
	    $this->db->where_in('pedido', $idpedidos);
	    $this->db->order_by("pedido", "asc");
	    
	    return $this->db->get()->result_array();
	}
	/***
	 * Listado de pedido en base a criterios
	 */
	function ObtenerPedidosListado($criterio,$limit,$estados,$ordenarpor,$orden,$slcomision,$cliente,$idprod = -1,$fechaDesde="",$fechaHasta="")
	{
			$data = $this->db->select('*')->from('v_listadopedidoextendido');
			
			if($idprod<>-1)
			{
				$data = $this->db->join('detalle', ' detalle.id_cabecera =  v_listadopedidoextendido.numeroPedido');
				$data = $this->db->where(' id_producto', $idprod);
			}
		
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
			
			if($fechaDesde!="" && $fechaHasta!="")
			{
				$data = $this->db->group_start();
				$data = $this->db->where(' est_fec_ing >=', $fechaDesde." 00:00:00");
				$data = $this->db->where(' est_fec_ing <=', $fechaHasta." 23:59:59");
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
	 * Undocumented function
	 *
	 * Por defecto busca los que estaban marcado con iva 
	 * @param integer $obligatorio
	 * @return void
	 */
	function obtenerPedidosConIvaSinFactura($iva=1){

		$this->db->select('v_cabecera.*');
		$this->db->from('v_cabecera');
		$this->db->join('v_adjunto', 'v_cabecera.id = v_adjunto.id_cabecera and v_adjunto.id_tipo = 1', 'left');
		$this->db->join('cliente', 'v_cabecera.id = v_adjunto.id_cabecera and v_adjunto.id_tipo = 1', 'left');
		$this->db->where('v_cabecera.ConFactura',$iva);
		$this->db->where('v_adjunto.id',null);

		$this->db->where('v_cabecera.est_fec_ing >','2019-11-01');

		return $this->db->get()->result_array();

	}
	
	function obtenerPedidosDescuadrados(){
		
		$notin = array(0, 1);
		
		$this->db->select('v_listadopedidoextendido.*');
		$this->db->from('v_listadopedidoextendido');
		$data = $this->db->group_start();
		$this->db->or_where('SaldoCliente <>',0);
		$this->db->or_where('SaldoFabrica <>',0);
		$this->db->or_where('SaldoVendedor1 <>',0);
		$this->db->or_where('SaldoVendedor2 <>',0);
		$data = $this->db->group_end();
		$this->db->where('est_fec_ing >','2019-11-01');
		$this->db->where_not_in('estado_sec',$notin);

		return $this->db->get()->result_array();
	}

	function obtenerIngresosPorPedido($fechaDesde,$fechaHasta){

		$this->db->select('year(est_fec_ing) as agno');
		$this->db->select('month(est_fec_ing) as mes');
		$this->db->select('concat(year(est_fec_ing),"-",month(est_fec_ing)) as label');
		$this->db->select('count(est_fec_ing) as qty');
		$this->db->select_sum('totalAPagar','totalAPagar');
		$this->db->select_sum('Ganancia100','ganancia');
		$this->db->from('v_listadopedidoextendido');
		if($fechaDesde!="" && $fechaHasta!="")
			{
				$data = $this->db->group_start();
				$data = $this->db->where(' est_fec_ing >=', $fechaDesde." 00:00:00");
				$data = $this->db->where(' est_fec_ing <=', $fechaHasta." 23:59:59");
				$data = $this->db->group_end();
			}

		$this->db->group_by(array("year(est_fec_ing)", "month(est_fec_ing)","(concat(year(est_fec_ing),'-',month(est_fec_ing)))"));

		return $this->db->get()->result_array();
	}


	function obtenerIngresosPorPedidoDiario($fechaDesde,$fechaHasta){

		$this->db->select('year(est_fec_ing) as agno');
		$this->db->select('DATE_FORMAT(est_fec_ing, "%Y-%m-%d") as label');
		$this->db->select('count(est_fec_ing) as qty');
		$this->db->select_sum('totalAPagar','totalAPagar');
		$this->db->select_sum('Ganancia100','ganancia');
		$this->db->from('v_listadopedidoextendido');
		if($fechaDesde!="" && $fechaHasta!="")
			{
				$data = $this->db->group_start();
				$data = $this->db->where(' est_fec_ing >=', $fechaDesde." 00:00:00");
				$data = $this->db->where(' est_fec_ing <=', $fechaHasta." 23:59:59");
				$data = $this->db->group_end();
			}

		$this->db->group_by(array("DATE_FORMAT(est_fec_ing, '%Y-%m-%d')","year(est_fec_ing)"));

		return $this->db->get()->result_array();
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
			 //0 es publico
			 //1 es no publico 
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
	    $query = $this->db->where('pedido',$idcabecera);
		$query = $this->db->where('id_cliente',$idcliente);
	    
	    if($userid==-1)
			$query = $this->db->where('publico',1);
	    
			$query = $this->db->where_not_in('tipo','E');
			$query = $this->db->order_by('fecha_mod','desc');
	    
	   		$query = $this->db->get('v_seguimiento');
	    
	    return $query->result_array();
	}

	/**
	 * Verifica si existe un pedido validando el número de cliente
	 *
	 * @param [int] $idcabecera número de pedido
	 * @param [int] $idcliente número de cliente
	 * @return void retorna true o false si no existe.
	 */
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
	
	function busquedaPedidoXProd($idprod){

		$this->db->where('id_prod',$idprod);
		$query = $this->db->get('v_totaldetallepedido');
	    
	    return $query->result();
	}
	
	

}

?>