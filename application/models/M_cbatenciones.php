<?php

class M_cbatenciones extends CI_Model {
    
    public $fecha_ingreso;
    public $fecha_termino;
    public $id;
    public $ck_nombre;
    public $ck_contacto;
    public $ck_saludo;


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		
    }
	
   
    function insertaAtencion($fecha_ingreso){
        
        $this->fecha_ingreso = $fecha_ingreso;
        $this->db->insert('cb_atenciones', $this);
        return  $this->db->insert_id();
    }

    function obtieneAtencion($atencion){

        $this->db->select('*');
		$this->db->from('cb_atenciones');
		$this->db->like('id', $atencion);
        
        $query = $this->db->get();
        $queryresultado = $query->row_array(1);

        $this->fecha_ingreso = $queryresultado['fecha_ingreso'];
        $this->fecha_termino = $queryresultado['fecha_termino'];
        $this->ck_contacto = $queryresultado['ck_contacto'];
        $this->ck_nombre = $queryresultado['ck_nombre'];
        $this->ck_saludo = $queryresultado['ck_saludo'];

       return $queryresultado;

    }

    function actualizaAtencion($id_atencion,$campo,$valor){

        $this->db->set($campo, $valor);
        $this->db->where('id',$id_atencion);
        $this->db->update('cb_atenciones'); // gives UPDATE mytable SET field = field+1 WHERE id = 2
    }

}

?>