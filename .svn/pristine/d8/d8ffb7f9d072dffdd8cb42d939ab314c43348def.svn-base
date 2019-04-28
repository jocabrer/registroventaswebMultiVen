<?php

class M_Woo extends CI_Model {
	
    
    public $dbwoo="ef3c71v0_bandejasenlozadas";
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		
    }
    
    /*
     * Obtiene un listado de los clientes que por el sitio dewoo comerce han hecho pedido y muestra el pedido del sistema interno en caso de existir
     */
    function get_listado_clientes_pedido($criterio)
    {
        $this->db->select('cli.id as idcliente,w.*');
        $this->db->from('v_woo_clientes w');
        $this->db->join('cliente cli', ' w.cliente_correo = cli.correo1','left');
        if($criterio!="")
        {
            $this->db->like('w.cliente_primer_nombre',$criterio);
            $this->db->or_like('w.pedido_sistema',$criterio);
            $this->db->or_like('w.cliente_apellido',$criterio);
            $this->db->or_like('w.id_woo',$criterio);
            $this->db->or_like('w.cliente_empresa',$criterio);
        }
        
        $this->db->order_by('pedido_fecha','desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    
 
    /*
     * Obtiene un listado de los clientes que por el sitio dewoo comerce han hecho pedido y muestra el pedido del sistema interno en caso de existir
     */
    function get_cliente_pedido_woo($idpedidowoo)
    {
        $this->db->select('*');
        $this->db->from('v_woo_clientes w');
        $this->db->where('w.id_woo',$idpedidowoo);
        $query = $this->db->get();
        
        return $query->result();
    }
    function get_detalle_pedido($idwoo){
        
        $this->db->select('w.id_pedido_woo,p.id id_producto_interno,w.cantidad, w.nom_producto AS producto_woo,p.costo precio_costo, w.precio_unitario precio_vendido_woo');
        $this->db->from('v_woo_detallepedidos w');
        $this->db->join('producto p','w.sku_producto_interno = p.id','left');
        $this->db->where('w.id_pedido_woo',$idwoo);
            
        $query = $this->db->get();
        return $query->result_array();
        
    }
	
    function get_dato_pedido($idwoopedido,$key)
    {
    	$this->db->select('*');
    	
    	$this->db->join($this->dbwoo.'.wp_posts as p', 'p.ID = pm.post_id');
    	$this->db->from($this->dbwoo.'.wp_postmeta as pm');
    	
    	$this->db->where('pm.post_id',$idwoopedido);
    	$this->db->where('pm.meta_key',$key);
    	$this->db->where('p.post_type','shop_order');
    	
    	$query = $this->db->get();
    	 
    	return $query->result()[0]->meta_value;
    	
    	
    	/*SELECT * FROM
    	ef3c71v0_bandejasenlozadas.wp_posts p
    	INNER JOIN ef3c71v0_bandejasenlozadas.wp_postmeta m ON p.`ID` = m.`post_id`
    	
    	WHERE p.post_type = 'shop_order'
    	AND m.`meta_key` = '_billing_first_name'*/
    	    
    	    
    	    
    }
    
}

?>