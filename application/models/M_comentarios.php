<?php

class M_Comentarios extends CI_Model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function obetenerCantidadComentariosSinLeer($lastlogin)
    {
        $date = new DateTime();
        $date->setTimestamp($lastlogin);
        
        $fecha = $date->format('Y-m-d H:i:s');
        
        $query = $this->db->order_by('fecha_mod', 'desc');
        $query = $this->db->where('fecha_mod >=', $fecha);
        return $this->db->count_all_results('comentarios');
    }

    function obtenerUltimosComentariosDelSistema($limit)
    {
        $query = $this->db->order_by('fecha_mod', 'desc');
        $query = $this->db->get('comentarios', $limit);
        return $query->result_array();
    }

    function obtenerPedidoComentarios($id)
    {
        /*
         * $query = $this->db->query(
         * "SELECT c.*, u.first_name nombre FROM comentarios c
         * INNER JOIN users u ON c.id_user = u.id
         * WHERE c.id_cabecera = ". $id ;
         */
        $this->db->select('comentarios.*, users.first_name nombre')->from('comentarios');
        $this->db->join('users', '  comentarios.id_user = users.id');
        $this->db->where_in(' comentarios.id_cabecera', $id);
        $this->db->order_by('comentarios.fecha_mod', ' desc');
        return $this->db->get()->result_array();
    }

    function insertaPedidoComentario($idcabecera, $id_user, $estado, $com, $fecha)
    {
        // $fecha_creacion = date('Y/m/d H:i:s', strtotime(new DateTime('America/Argentina/Mendoza')));
        $this->id_cabecera = $idcabecera;
        $this->estado = $estado;
        $this->id_user = $id_user;
        $this->fecha_mod = $fecha->format('Y-m-d H:i:s');
        $this->comentario = $com;
        
        $this->db->insert('comentarios', $this);
        // El id del nuevo estado.
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function obtieneMensajeEstado($id_estado)
    {
        $this->db->where('id',$id_estado);
        $query = $this->db->get('estado');
        return  $query->row()->descripcion_larga;
    }
    
    /**
     * FUncion que elimina de la base de datos un comentario segun su id
     * @param int $idcomentario id del comentario en la tabla 
     */
    function eliminaPedidoComentarios($idcomentario){
        $this->db->delete('estado', array('id' => $idcomentario));  
    }
}

?>