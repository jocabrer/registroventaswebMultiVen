<?php

class M_cliente extends CI_Model {

     function __construct()
    {
       parent::__construct();
    }
    
    /**
     * Realiza busqueda de cliente segun criterio por nombre solamente, formato devuelto para el control de clientes.. 
     * @param $criterio Criterio de busqueda.
     */
    public function getAllControl($criterio)
    {
    	//TODO mejorar inteligencia de la query
    	$sql = "Select CONCAT(id,'-',nombre) as 'nombre', id from cliente CLI where nombre like '%".$criterio."%' order by nombre asc";
    	
    	$query = $this->db->query($sql);
    	return $query->result_array();
    }
    
    
    public function buscarCliente($criterio){
        $data = $this->db->select('*')->from('cliente')
        ->group_start()
        ->or_like(' nombre', $criterio)
        ->or_like(' nombre2', $criterio)
        ->or_like(' correo1', $criterio)
        ->or_like(' correo2', $criterio)
        ->or_like(' fono1',$criterio)
        ->or_like(' fono2',$criterio)
        ->group_end()
        ->get();
        return $data->result_array();
        
    }
    
    public function buscarClientePorCorreo($correo){
        $data = $this->db->select('*')->from('cliente')
        ->group_start()
        ->or_like(' correo1', $correo)
        ->or_like(' correo2', $correo)
        ->group_end()
        ->get();
        return $data->result_array();
        
    }
    
    
    /**
     * Obtiene un listado de clientes pedido segùn la vista v_ResumenclientePedido sin filtro, solo limitando la cantidad de registros ordenados por ID desc.
     * @param $elimite Limite de resultados a obtener.
     */
    public function getAll($elimite)
    {
    	$query = $this->db->query("SELECT * FROM v_resumenclientepedido ORDER BY id DESC LIMIT ". $elimite .";");
    	return $query->result_array();
    }
    
    /**
     * Obtiene un listado de clientes pedido segùn la vista v_ResumenclientePedido mediante un filtro que aplica para el nombre o el correo.
     * @param  $criterio de busqueda puede ser el nombre o el correo.
     */
    public function getClientes($criterio,$limit,$ordenarpor,$orden)
    {
    	$data = $this->db->select('*')->from('v_resumenclientepedido')
    	       ->group_start()
    	       ->or_like(' nom_cliente', $criterio)
    	       ->or_like(' adr_cliente', $criterio)
    	       ->or_like(' nom_empresa', $criterio)
    	       ->or_like(' fono1',$criterio)
    	       ->or_like(' fono2',$criterio)
    	       ->group_end()
    	       ->limit($limit)
               ->order_by($ordenarpor, $orden)
      	       ->get();
    	return $data->result_array();
    }
    
    /**
     * Obtiene un cliente mediante su ID
     * @param  $id Id del cliente.
     */
    public function getcliente($id)
    {
    	$this->db->where('id',$id);
    	$query = $this->db->get('cliente');
    	return $query->result_array();
    }
    /**
     * Obtiene el cliente de un pedido
     * @param int $idpedido el número de pedido
     */
    public function get_cliente_pedido($idpedido)
    {
    	
    	$this->db->select('*,cliente.id cli_id');
    	$this->db->from('cliente');
    	$this->db->join('cabecera', 'cabecera.id_cliente = cliente.id');
    	$this->db->where('cabecera.id',$idpedido);

    	$query = $this->db->get();
    	return $query->result();
    }
    

    /**
     * Inserta un registro en base de datos para la tabla cliente, segùn los valores recibidos.
     * @param unknown $nombre
     * @param unknown $correo
     * @param unknown $nombr2
     * @param unknown $corre2
     * @param unknown $fono1
     * @param unknown $fono2
     * @param unknown $rut
     * @param unknown $giro
     * @param unknown $direc
     * @param unknown $comuna
     * @param unknown $obs
     * @return unknown
     */
    function insert_entry($nombre,$correo,$nombr2,$corre2,$fono1,$fono2,$rut,$giro,$direc,$comuna,$obs,$id_user,$fecha_mod)
    {
        $this->nombre    = trim($nombre);
        $this->nombre2    = trim($nombr2);
		$this->correo2    = trim($corre2);
        $this->correo1    = trim($correo);
        $this->fono1    = trim($fono1);
        $this->fono2    = trim($fono2);
        $this->rut    = trim($rut);
        $this->giro    = trim($giro);
        $this->domicilio    = trim($direc);
        $this->comuna    = trim($comuna);
        $this->observaciones    = trim($obs);
        
        $this->id_user = $id_user;
        $this->fecha_mod = $fecha_mod->format('Y-m-d H:i:s');
                                                                                
        $result = $this->db->insert('cliente', $this);
        $insert_id = $this->db->insert_id();
        
        
        
        if($result){
            return  $insert_id;
        }else{
            return $this->db->_error_message();
        }
        
        
    }
	/**
	 * Actualiza un cliente segun los datos recibidos para el cliente especificado.
	 * @param unknown $id_cliente
	 * @param unknown $nombre
	 * @param unknown $correo
	 * @param unknown $nombr2
	 * @param unknown $corre2
	 * @param unknown $fono1
	 * @param unknown $fono2
	 * @param unknown $rut
	 * @param unknown $giro
	 * @param unknown $direc
	 * @param unknown $comuna
	 * @param unknown $obs
	 */
    function update_entry($id_cliente,$nombre,$correo,$nombr2,$corre2,$fono1,$fono2,$rut,$giro,$direc,$comuna,$obs,$id_user,$fecha_mod)
    {

        
        $this->db->set('nombre',trim($nombre));
        $this->db->set('nombre2',trim($nombr2));
        $this->db->set('correo2',trim($corre2));
        $this->db->set('correo1',trim($correo));
        $this->db->set('fono1',trim($fono1));
        $this->db->set('fono2',trim($fono2));
        $this->db->set('rut',trim($rut));
        $this->db->set('giro',trim($giro));
        $this->db->set('domicilio',trim($direc));
        $this->db->set('comuna',trim($comuna));
        $this->db->set('observaciones',trim($obs));
        
        $this->db->set('id_user',$id_user);
        $this->db->set('fecha_mod',$fecha_mod->format('Y-m-d H:i:s'));
        
        $this->db->where('id',$id_cliente);
        
        $result = $this->db->update('cliente');
        
        if($result){
            return  $id_cliente;
        }else{
            return $this->db->_error_message();
        }
    }
	


}

?>