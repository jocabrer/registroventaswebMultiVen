<?php

class Usuario extends CI_Model {

    var $nombre1   = '';
	var $nombre2   = '';
	var $correo1   = '';
	var $correo2   = '';
	var $fono1     = '';
	var $fono2     = '';
	
	var $giro 	   = '';
	var $rut 	   = '';
	
    var $domicilio = '';
    var $comuna    = '';
	var $observaciones = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		
    }
    
    function get_last_ten_entries()
    {
        $query = $this->db->get('Usuario', 10);
        return $query->result();
    }

    function insert_entry()
    {
        /*$this->title   = $_POST['title']; // please read the below note
        $this->content = $_POST['content'];
        $this->date    = time();

        $this->db->insert('entries', $this);*/
    }

    function update_entry()
    {
       /* $this->title   = $_POST['title'];
        $this->content = $_POST['content'];
        $this->date    = time();

        $this->db->update('entries', $this, array('id' => $_POST['id']));*/
    }
	


}

?>