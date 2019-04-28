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
    
    
    function insert_entry_hoja($tipo,$fechaingreso,$pedido,$cantidad,$producto,$costo_cu,$tot_costo,$pagado,$saldo,$iva,$fecha_proceso,$nombre_hoja,$orden)
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
        $this->db->insert('hojas', $this);
        
        return  $nombre_hoja;
    }
    
    function insertaHojaCabecera($nombrehoja,$fechaproceso,$fechamod,$userid)
    {
        $this->nombre_hoja = $nombrehoja;
        $this->fecha_proceso  = $fechaproceso->format('Y-m-d H:i:s');;
        $this->fecha_mod  = $fechamod->format('Y-m-d H:i:s');;
        
        $this->userid  =$userid;
        
        $this->db->insert('cabecera_hojas', $this);
        
        return  $nombrehoja;
    }
    
    function update_entry_cab_hoja($nombrehoja,$fechaproceso,$fechamod,$userid)
    {
        $this->fecha_proceso  = $fechaproceso->format('Y-m-d H:i:s');;
        $this->fecha_mod  = $fechamod->format('Y-m-d H:i:s');;
        
        $this->userid  =$userid;
        
        $this->db->where('nombre_hoja',$nombrehoja);
        $this->db->update('cabecera_hojas', $this);
        
        
        $insert_id = $this->db->insert_id();
        
        return  $insert_id;
    }
    
    function get_Hoja($hoja)
    {
        $query = $this->db->where('nombre_hoja',$hoja);
        $query =$this->db->order_by('id_cabecera', 'asc');
        $query =$this->db->get('v_hojas');
        return $query->result_array();
    }
    
    
    function get_Hoja_cabecera($hoja)
    {
        $query = $this->db->where('nombre_hoja',$hoja);
        $query =$this->db->order_by('nombre_hoja', 'asc');
        $query =$this->db->get('cabecera_hojas');
        return $query->result();
    }
    
    /*function get_Hojas()
    {
        $query =$this->db->order_by('orden', 'asc');
        $query =$this->db->get('hojas');
        return $query->result_array();
    }*/
    
    function borrar_detalle($nombre_hoja,$tipo,$nropedido){
        
        $this->db->where('nombre_hoja', $nombre_hoja);
        $this->db->where('tipo', $tipo);
        $this->db->where('id_cabecera', $nropedido);
        $this->db->delete('hojas'); 
        
    }
    
    
}

?>