<?php


class M_estados extends CI_Model {

  
	
	
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		
    }
    function get_Estados()
    {
    	$query = $this->db->query("SELECT * FROM estado;");
    	return $query->result_array();
    }
    
    /**
     * 
     */
    function obtieneIdEstadoActualPedido($id_pedido)
    {

        $this->db->where('id',$id_pedido);
        $query = $this->db->get('v_cabecera');
        if($query->row()!=null)
            return  $query->row()->estado_sec;
        else 
            return -1;
    }
    
    
    
	/***
	*	Graba en la tabla cambioestado un nuevo estado asignado a un pedido.
	*/
    function insertaPedidoEstado($id_cabecera,$estado,$fecha,$id_user)
    {
        
        
        $this->id_cabecera  = $id_cabecera;
        $this->estado 		= $estado;
        $this->id_user  = $id_user;
        $this->fecha_mod  = $fecha;

        $this->db->insert('cambioestado', $this);
		
        $insert_id = $this->db->insert_id();
        
        return  $insert_id;
    }
    
  
    /*
     * Metodo que obtiene la cantidad de pedidos en un estado especifico, considera si se considera los sin comisión 
     */
    function get_cantidadEstadoComision($estado,$comision){
        
        if($comision!=-1)
        {
            $query = $this->db->query('SELECT v.*, il.comision FROM v_cabecera v  
                inner join v_indicador_lite il on vc.id = il.id_cabecera
                WHERE il.comision = '.$comision.' and v.`estado_sec` = '.$estado);
           
        }
        else
        {
            $query = $this->db->query('SELECT * FROM v_cabecera v  WHERE v.`estado_sec` = '.$estado);
        }
        
        return $query->num_rows();
        
        
    }
    
}



?>