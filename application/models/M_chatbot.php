<?php

class M_Chatbot extends CI_Model {
    
    
    public $id;
    public $texto;
    public $fecha;
    public $id_atencion;
    public $id_visitante;

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		
    }
    
    
    function insertaChatbot($texto,$fecha,$atencion,$visitante)
    {
        $this->texto = $texto;
        $this->fecha = $fecha;
        $this->id_atencion = $atencion;
        $this->id_visitante = $visitante;
        $this->db->insert('cb_chatbox', $this);
        return  $this->db->insert_id();
    }
   
    

   
    
    
   

}

?>