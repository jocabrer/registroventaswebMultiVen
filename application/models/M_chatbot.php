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
   
    

   
    function obtieneMensaje($clave){

        $this->db->select('p.respuesta,p.obligatoria,p.ck');
		$this->db->from('cb_patrones p');
		$this->db->like('claves', $clave);
        $this->db->order_by('prioridad', 'asc');
        
        $query = $this->db->get();
        
        $queryresultado = $query->row_array(1);

        $data['respuesta'] = $queryresultado['respuesta'];
        $data['obligatoria'] = $queryresultado['obligatoria'];
        $data['ck'] = $queryresultado['ck'];

        return $data;
	}
    
   

}

?>