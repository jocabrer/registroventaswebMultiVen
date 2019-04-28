<?php

class M_Fechas extends CI_Model {
	
    
    
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		
    }
    
    
    
    function obtenerFeriados(){
        
        $this->db->select('fer.fecha as fecha');
        $this->db->from('feriados fer');
        
        return $this->db->get()->result_array();
    }
    
    
    /*function esFeriado($fecha){
        $this->db->where('fecha', $fecha->format('Y-m-d H:i:s'));
        $this->db->from('feriados');
        $cant =  $this->db->count_all_results();
        if ($cant>0)
            return true;
            else
                return false;
    }*/
    
    
  
}

?>