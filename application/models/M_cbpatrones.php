<?php

class M_cbpatrones extends CI_Model {
    
    
    public $id;
    public $tipo;
    public $claves;
    public $prioridad;
    public $respuesta;
    public $ck;
    public $obligatoria;


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		
    }

    function obtieneMensaje($clave){

        $this->db->select('p.respuesta,p.obligatoria,p.ck');
		$this->db->from('cb_patrones p');
		$this->db->like('claves', $clave);
        $this->db->order_by('prioridad', 'asc');
        
        $query = $this->db->get();
        
        $queryresultado = $query->row_array(0);

      /*  $data['respuesta'] = $queryresultado['respuesta'];
        $data['obligatoria'] = $queryresultado['obligatoria'];
        $data['ck'] = $queryresultado['ck'];*/
      

        return $queryresultado;
    }
    

    function obtienePreguntasObligatorias(){
        
        $this->db->select('p.respuesta,p.obligatoria,p.ck');
		$this->db->from('cb_patrones p');
		$this->db->where('obligatoria >', 0);
        $this->db->order_by('prioridad', 'asc');

        $query = $this->db->get();
        
        return $query->row_array(0);
    }

}

?>    
    
