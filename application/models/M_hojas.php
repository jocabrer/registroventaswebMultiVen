<?php

class M_Hojas extends CI_Model {
	
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		
    }
	
 
    /**
     * Metodo de busqueda por descripcion 
     * 
     * @param unknown $criterio
     */
    function getAll($criterio)
    {
        $sql = "SELECT nombre_hoja FROM cabecera_hojas WHERE nombre_hoja LIKE  '%".$criterio."%'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    
    function insert_entry_hoja($tipo,$fechaingreso,$pedido,$cantidad,$producto,$costo_cu,$tot_costo,$pagado,$saldo,$iva,$fecha_proceso,$nombre_hoja,$orden,$SaldoVendedor2)
    {
        
        //$fecha = date('Y-m-d H:i:s', strtotime($fecha));
        unset($this->fecha_mod);
        unset($this->userid);
        unset($this->nombre_hoja);
        $this->tipo = $tipo;
        $this->fecha_ingreso = $fechaingreso;
        $this->id_cabecera= $pedido;
        $this->cantidad  = $cantidad;
        $this->producto  = $producto;
        $this->costo_cu  = $costo_cu;
        $this->tot_costo  = $tot_costo;
        $this->pagado  =$pagado;
        $this->saldo  = $saldo;
        $this->iva  = $iva;
        $this->fecha_proceso  = $fecha_proceso->format('Y-m-d H:i:s');;
        $this->nombre_hoja  =$nombre_hoja;
        $this->orden = $orden;
        $this->saldovendedor2 = $SaldoVendedor2;
        $this->db->insert('hojas', $this);
        
        return  $nombre_hoja;
    }
    /**
     * Crea un registro de cabecera de hoja.
     *
     * @param [string] $nombrehoja Nombre de la hoja.
     * @param [date] $fechaproceso Fecha de proceso.
     * @param [date] $fechamod Fecha de modificación de los registros.
     * @param [int] $userid Id del usuario
     * @return void
     */
    function insertaHojaCabecera($nombrehoja,$fechaproceso,$fechamod,$userid)
    {
        //Seteamos nuevos valores
        $this->nombre_hoja = $nombrehoja;
        $this->fecha_proceso  = $fechaproceso->format('Y-m-d H:i:s');;
        $this->fecha_mod  = $fechamod->format('Y-m-d H:i:s');;
        $this->userid  =$userid;
       
        //insertamos 
        $this->db->insert('cabecera_hojas', $this);
        
        //Retornamos el nombr de la hoja
        return  $nombrehoja;
    }
    
    /**
     * Undocumented function
     *
     * @param [type] $nombrehoja
     * @param [type] $fechaproceso
     * @param [type] $fechamod
     * @param [type] $userid
     * @return void
     */
    function update_entry_cab_hoja($nombrehoja,$fechaproceso,$fechamod,$userid)
    {
        $this->fecha_proceso  = $fechaproceso->format('Y-m-d H:i:s');;
        $this->fecha_mod  = $fechamod->format('Y-m-d H:i:s');;
        
        $this->userid  =$userid;
        
        $this->db->where('nombre_hoja',$nombrehoja);
        $this->db->update('cabecera_hojas', $this);
        
        return  $nombrehoja;
    }

    
    /**
     * Obtiene los registros de la vista v_hojas para un nombre de hoja.
     *
     * @param [string] $hoja Nombre d ela hoja para leer.
     * @return Arry con el contendido de las hojas.
     */
    function get_Hoja($hoja)
    {
        $query = $this->db->where('nombre_hoja',$hoja);
        $query =$this->db->order_by('id_cabecera', 'asc');
        $query =$this->db->get('v_hojas');
        return $query->result_array();
    }
    
    /**
     * Obtiene el registro de cabecera de la hoja.
     *
     * @param [String] $hoja el nombre de la hoja.
     * @return el registro
     */
    function get_Hoja_cabecera($hoja)
    {
        $query = $this->db->where('nombre_hoja',$hoja);
        $query =$this->db->order_by('nombre_hoja', 'asc');
        $query =$this->db->get('cabecera_hojas');
        return $query->result();
    }
    
    
    function borrar_detalle($nombre_hoja,$tipo,$nropedido){
        
        $this->db->where('nombre_hoja', $nombre_hoja);
        $this->db->where('tipo', $tipo);
        $this->db->where('id_cabecera', $nropedido);
        $this->db->delete('hojas'); 
        
    }
    
    /**
     * Función que elimina las líneas de los pedidos enviados.
     *
     * @param [type] $nombre_hoja hoja de la que se borraran las lineas de pedido.
     * @param [type] $idpedidos Los pedidos a eliminar.
     * @return void 
     */
    function borrar_pedidos_hoja($nombre_hoja,$idpedidos){
        
        $this->db->where('nombre_hoja', $nombre_hoja);
        $this->db->where_in('id_cabecera', $idpedidos);
        $this->db->delete('hojas'); 
    }
}

?>