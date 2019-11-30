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
    
    /**
     * Graba eun objto de chatbox para el visitante y atención.
     *
     * @param [type] $texto
     * @param [type] $fecha
     * @param [type] $atencion
     * @param [type] $visitante
     * @return el id del chatbox
     */
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