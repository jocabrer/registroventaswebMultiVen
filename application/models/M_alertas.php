<?php

class M_Alertas extends CI_Model {
	
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		
    }
	
   
    /**
     * Graba una alerta del proceso
     *
     * @param [int] $idtipo tipo de alerta
     * @param [type] $fecha fecha de alerta
     * @param [type] $hoja nombre de la hoja relacionada
     * @param [type] $idpedido pedido relacionado
     * @param [type] $texto alerta
     * @return void
     */
    function grabaAlerta($idtipo,$fecha,$hoja,$idpedido,$texto)
    {
        $this->id_tipo = $idtipo;
        $this->fecha = $fecha;
        $this->nombrehoja = $hoja;
        $this->id_pedido= $idpedido;
        $this->texto = $texto;    

        $this->db->insert('alertas', $this);
        
        return  $this->db->insert_id();
    }

    /**
     * Obtiene las alertas generadas para un proceso de hoja.
     *
     * @param [varchar] $hoja nombre de la hoja
     * @return listado de alertas
     */
    function obtieneAlertas($hoja){
        $this->db->where('nombrehoja',$hoja);
	    $query = $this->db->get('alertas');
	    return $query->result();
    }
    
}

?>