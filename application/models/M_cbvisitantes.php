<?php

class M_Cbvisitantes extends CI_Model {
	
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
   
    
    function insertaVisitante($agent,$ip,$atencion)
    {
        
        $this->navegador = $agent;
        $this->ip = $ip;
        
        $this->db->insert('cb_visitantes', $this);
        
        return  $this->db->insert_id();
    }

    
    function actualizaVisitante($idvisitante,$campo,$valor){

        $this->db->set($campo, $valor);
        $this->db->where('id',idvisitante);
        $this->db->update('cb_visitantes'); // gives UPDATE mytable SET field = field+1 WHERE id = 2
    }

   
}

?>