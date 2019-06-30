<?php


class M_Cuenta extends CI_Model {
    
	
	
	function getCuentaPrincipal()
	{
		return $this->db->query("SELECT id FROM `cuenta` WHERE entidad = 'VEN1'")->row()->id;	
	}
	
	
	
	function get_CuentaTipo($tipo){
		
		$this->db->where('Tipo',$tipo);
		$query = $this->db->get('cuenta');
		return $query->row()->id;
		
	}
	
		
	function tieneCuentaTipo($idpedido,$tipo){
	
		
		/*SELECT * FROM `movimiento_cab` cab
		INNER JOIN cuenta cta   ON cab.id_cuenta = cta.id
		WHERE cta.tipo*/
		
		
		$this->db->select('cta.id');
		$this->db->from('movimiento_cab cab');
		$this->db->join('cuenta cta', 'cab.id_cuenta = cta.id','inner');
		$this->db->where('cab.id_cabecera', $idpedido);
		$this->db->where('cta.Tipo', $tipo);
			
		$cont = $this->db->count_all_results();
		
		if ($cont>0)
		{
			return true;
		}else
			return false;
	
	}
	
	function esCuentaIngreso($idcuenta)
	{
		
		$Tipo = $this->db->query("SELECT Tipo FROM `cuenta` WHERE id = ". $idcuenta)->row()->Tipo;
		if ($Tipo=='0')
		{
			return true;
		}else
			return false;
		
	}
	
	function get_movimientos_cab($idpedido,$muestraCuentasBase)
	{
		$this->db->select('mc.id,cta.Nombre AS nom_cta,porcentaje');
		$this->db->from('movimiento_cab mc');
		$this->db->join('cuenta cta', 'mc.id_cuenta = cta.id','inner');
		$this->db->where('id_cabecera', $idpedido);
		
		if ($muestraCuentasBase)
		  $this->db->where('cta.tipo', 1);
		
		$query = $this->db->get();
		
	//	echo $this->db->last_query();
//		exit(0);
		
		return $query->result_array();
		
	}
	
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		
    }
    function get_Cuentas($tipo=-1)
    {
    	
        
        $this->db->select('*');
        $this->db->from('cuenta cta');
        
        if($tipo<> -1)
            $this->db->where('tipo', $tipo);
        
        $query = $this->db->get();
    	
		return $query->result_array();
    }
    

    /**
     * Ese metodo retorna la vista que se muestra en la tabla de movimientos de platas en el pedido 
     * @param  $id_pedido el pedido
     */
	function get_MovCuentaPedido($id_pedido)
	{
		$query = $this->db->query("SELECT *,debe-haber as saldo FROM v_cuentasdebehaber where id_cabecera =". $id_pedido ." order by tipo asc");
		return $query->result_array();
	}
    
	/*function getdetallemovimientos($idpedido)
	{
		$qry="";
		if ($idpedido==-1)
			$qry = "SELECT * FROM v_detallecuentas ";
		else 
			$qry = "SELECT * FROM v_detallecuentas where nro_pedido = ". $idpedido;
		
		$query = $this->db->query($qry);
		return $query->result_array();
	}*/
	function get_listadoMovimientos($criterio,$limit,$ordenarpor,$orden)
	{
		$this->db->or_like(' nombre_cuenta ', $criterio);
		$this->db->or_where(' nro_pedido', $criterio);
		$this->db->or_where(' DATE(fecha_ingreso)', $criterio);
		$this->db->or_like(' glosa ', $criterio);
		
		$this->db->order_by($ordenarpor, $orden);
	
		$this->db->limit($limit);
	
		$query = $this->db->get('v_detallecuentas');
		return $query->result_array();
	
		//echo $this->db->last_query();
		//exit(0);
	}

	
	/**
	 * Función que genera las transacciones necesarias para efectuar una transferencia entre cuentas.
	 * @param unknown $idcabecera
	 * @param unknown $monto
	 * @param unknown $cuenta_origen
	 * @param unknown $cuenta_destino
	 * @param unknown $fecha
	 * @param unknown $glosa
	 * @return el id de la transaccion de la cuenta que se abona
	 */
	function transferirMontoCuenta($idcabecera,$monto,$cuenta_origen,$cuenta_destino,$fecha_mod,$glosa,$id_user)
	{
		/*En una transferencias se realizan 2 transacciones simultaneamente
		1) Primero realizo el abono a la cuenta de destino*/
		
		$this->id_cabecera   = $idcabecera;
		$this->monto  = $monto ;
		$this->id_cuenta  = $cuenta_destino;
		$this->id_user=$id_user;
		$this->fecha_mod = $fecha_mod->format('Y-m-d H:i:s');
		$this->glosa  = "Abono desde la cuenta " . $this->get_nombrecuenta($cuenta_origen). ", obs:"  . $glosa;
		$this->db->insert('movimiento_cta', $this);
	
		$id_tx_abono  = $this->db->insert_id();
		
		
		/*2) Ahora el cargo */
		
		
		$this->monto  = $monto * -1 ;
		$this->id_cuenta  = $cuenta_origen;
		$this->id_user=$id_user;
		$this->fecha_mod = $fecha_mod->format('Y-m-d H:i:s');
		$this->glosa  = "REF.". $id_tx_abono ." Monto transferido hacia la cuenta de : " .$this->get_nombrecuenta($cuenta_destino)." obs:".$glosa;
		$this->db->insert('movimiento_cta', $this);
		$id_tx_cargo  = $this->db->insert_id();
		
		return  $id_tx_cargo;
	}
	
	function get_nombrecuenta($id_cuenta)
	{
		
		$nombre = $this->db->query("SELECT nombre FROM `cuenta` WHERE id = ". $id_cuenta)->row()->nombre;
		return $nombre;
	}
	
	/**
	 * Metodo encargado de inserta una transaccion a una cuenta
	 * @param unknown $idcabecera
	 * @param unknown $monto
	 * @param unknown $cuenta
	 * @param unknown $fecha
	 * @param unknown $glosa
	 * @return el id de la transacción
	 */
	function imputarMontoCuenta($idcabecera,$monto,$cuenta,$fecha_mod,$glosa,$id_user)
	{
		$this->id_cabecera   = $idcabecera;
		$this->monto  = $monto ;
		$this->id_cuenta  = $cuenta;
		$this->id_user=$id_user;
		$this->fecha_mod = $fecha_mod->format('Y-m-d H:i:s');
		$this->glosa  = $glosa;

		$this->db->insert('movimiento_cta', $this);
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}
	
	#region Comisiones 
	function insertaComision($cta,$porcentaje,$idcabecera,$id_user,$fecha_mod)
	{
	    $this->id_cabecera = $idcabecera;
	    $this->id_cuenta = $cta;
	    $this->porcentaje = $porcentaje;
	    $this->id_user = $id_user;
	    $this->fecha_mod = $fecha_mod;
	    
	    $this->db->insert('movimiento_cab', $this);
	    $insert_id = $this->db->insert_id();
	    return  $insert_id;
	}
	function ActualizaComision($id,$porcentaje,$id_user,$fecha_mod){
	    
	    
	    $this->db->simple_query("UPDATE movimiento_cab set porcentaje = " . $porcentaje .", id_user = ".$id_user.", fecha_mod = '".$fecha_mod."' WHERE `id` = ".$id);
	    
	 
	    
	}
	function eliminarComision($idcab)
	{
	    return $this->db->simple_query("DELETE FROM  `movimiento_cab` WHERE `id` = ".$idcab);
	}
	function eliminaPorcentajeExistente($idcab){
	    
	    return $this->db->simple_query("DELETE FROM  `movimiento_cab` WHERE `id_cabecera` = ".$idcab);
	}
	function porcentajeTotalPedido($idcabecera){
	    
	    $this->db->from('movimiento_cab');
	    $this->db->where('id_cabecera', $idcabecera);
	    $this->db->select_sum('porcentaje','porcentaje');
	    $porcentaje =  $this->db->get()->row()->porcentaje;
	    
	    
	    return $porcentaje;
	    
	    /*if ($porcentaje>0)
	     return true;
	     else
	     return false;*/
	}
	
	
	
	#endregion
	
	
	
	
	function eliminarTransaccion($idmov)
	{
	 
		return $this->db->simple_query("DELETE FROM  `movimiento_cta` WHERE `id` = ".$idmov);
	}
	
	
	function eliminarTransacciones($idarr){
	    
	    for ($indice=0; $indice< count($idarr) ; $indice++){
	        
	        $idElimina = $idarr[$indice]['id_transaccion'];
	        $this->eliminarTransaccion($idElimina);
	    }
	    
	    return true;
	}
	
	
	
	
	
	
	
}



?>