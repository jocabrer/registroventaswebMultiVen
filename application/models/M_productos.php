<?php

class M_Productos extends CI_Model {
	
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		
    }
	
    function getProdPorid($idProd)
    {
    	$this->db->select('*');
    	$this->db->from('producto');
    	$this->db->where('id',$idProd);
    	 
    	$query = $this->db->get();
    	 
    	return $query->result_array();
    }
    
    /**
     * Retorna las categorias de productos del sistema
     */
    function get_Categorias(){
        
        return   $this->db->select(' id,nom_categoria')->from('categoria')->get()->result_array();
    }
    
    
    
	/**
	 *  Usado en listado de maestro de productos 
	 *  Metodo de busqueda por COD
	 */
	function get_productos($search,$limit,$ordenarpor,$orden,$cat)
	{
		
		$this->db->select('producto.*, categoria.nom_categoria,(producto.valor_venta- producto.costo) as ganancia')->from('producto')
		->join('categoria','categoria.id = producto.id_categoria')
		->group_start()
		->or_like(' producto.codigo ', $search)
		->or_like(' producto.descripcion', $search)
		->or_like(' producto.Nombre', $search)
		->group_end();
		
		if($cat!=0)// valor 0 es cuando se muestran todas
		    $this->db->where('categoria.id',$cat);
		
        $this->db->limit($limit);
        $this->db->order_by($ordenarpor, $orden);
        return $this->db->get()->result_array();;
	}
    /**
     * Metodo de busqueda por descripcion 
     * 
     * @param unknown $criterio
     */
    function getAll($criterio)
    {
        $sql = "SELECT id, nombre FROM producto WHERE descripcion LIKE  '%".$criterio."%' or Nombre LIKE  '%".$criterio."%'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
     /**
      * Obtiene un producto por su ID.
      */
     function getById($idprod)
     {
     	
     	$sql = "SELECT * FROM producto WHERE id = " . $idprod;
     	$query = $this->db->query($sql);
     	return $query->result_array();
     	
     }
    
     /**
      * Obtiene la sigla de la categoría del producto
      * @param int $id
      */
     function get_sigla_cat($id)
     {
        // return $this->db->select('sigla')->from('categoria')->where('id',$id)->get()->result_array();;
        
         $query = $this->db->select('sigla')->from('categoria')->where('id',$id)->get();
         
         if($query->num_rows() > 0) {
             $sigla = $query->row("sigla");
             
             return $sigla;
         } else {
             return FALSE;
         }
     }
     
     
     function get_ultimo_id(){
         
         $query = $this->db->select(' MAX(id) as nuevoid')->from('producto')->get();
         
         if($query->num_rows() > 0) {
             $nuevoid = $query->row("nuevoid");
             return $nuevoid;
         } else {
             return FALSE;
         }
     }
     
     
	/*
	* Elimina un producto de la >BD.
	*/    
     function delete_prod($id)
     {
     	return $this->db->simple_query("DELETE FROM `producto` WHERE `id` = ".$id);
     }
     
     
	/**
	 * 
	 * @param unknown $codigo
	 * @param unknown $nombre
	 * @param unknown $Descripcion
	 * @param unknown $valor_venta
	 * @param unknown $costo
	 */
    function insert_entry($codigo,$Nombre,$Descripcion, $valor_venta, $costo,$cat,$iduser)
    {
    	$this->codigo   	  = $codigo;
    	$this->nombre   	  = $Nombre;
    	$this->Descripcion    = $Descripcion;
    	$this->valor_venta    = $valor_venta;
    	$this->costo 		  = $costo;
    	$this->id_categoria   = $cat;
    	$this->userid         = $iduser;
    	
    	$result = $this->db->insert('producto', $this);
    	
    	$insert_id = $this->db->insert_id();
    	
    	if($result){
    	    return  $insert_id;
    	}else{
    	    return $this->db->_error_message();
    	}
    }
       
    
    function update_entry($idproducto,$codigo,$Nombre,$Descripcion, $valor_venta, $costo,$cat,$iduser)
    {
        if($codigo!='')$this->codigo   	  = $codigo;
        if($Nombre!='')$this->Nombre   	  = $Nombre;
        if($Descripcion!='')$this->Descripcion    = $Descripcion;
        if($valor_venta!='')$this->valor_venta    = $valor_venta;
        if($costo!='')$this->costo 		  = $costo;
        if($cat!='')$this->id_categoria   = $cat;
        
    	$this->userid         = $iduser;
    	
    	$this->db->where('id', $idproducto);
    	$result = $this->db->update('producto', $this);
    	
    	
    	if($result){
    	    return  $idproducto;
    	}else{
    	    return $this->db->_error_message();
    	}
    }
    

    function obtenerProductosMasVendidos($fechaDesde,$fechaHasta){

        $this->db->select('p.id as id');
		$this->db->select('p.Nombre as nombre');
		$this->db->select('p.Descripcion as descripcion');
		$this->db->select_sum('d.cantidad','unidades');
        $this->db->from('cabecera as cab','as cab'); 
        $this->db->join('detalle as d','cab.id = d.id_cabecera');
        $this->db->join('producto as p','d.id_producto = p.id');

		if($fechaDesde!="" && $fechaHasta!="")
			{
				$data = $this->db->group_start();
				$data = $this->db->where(' cab.fecha_ingreso >=', $fechaDesde." 00:00:00");
				$data = $this->db->where(' cab.fecha_ingreso <=', $fechaHasta." 23:59:59");
				$data = $this->db->group_end();
			}

        $this->db->group_by(array("p.id", "p.Nombre","p.Descripcion"));
        $this->db->order_by(4,"desc");
		return $this->db->get()->result_array();
    }

    
    /**
     * Obtiene el desglose mensual de unidades vendidas para un  producto durante un año.-
     *
     * @param [type] $fechaDesde fecha desde
     * @param [type] $fechaHasta fecha hasta
     * @param [type] $prod prod a analizar.
     * @return Resultados
     */
    function obtenerProductoPorMes($fechaDesde,$fechaHasta,$prod){

        $this->db->select('p.id as id');
		$this->db->select('p.Nombre as nombre');
        $this->db->select('p.Descripcion as descripcion');
        $this->db->select('MONTH(cab.fecha_ingreso) mes');
		$this->db->select_sum('d.cantidad','unidades');
        $this->db->from('cabecera as cab','as cab'); 
        $this->db->join('detalle as d','cab.id = d.id_cabecera');
        $this->db->join('producto as p','d.id_producto = p.id');

		if($fechaDesde!="" && $fechaHasta!="")
			{
				$data = $this->db->group_start();
				$data = $this->db->where(' cab.fecha_ingreso >=', $fechaDesde." 00:00:00");
				$data = $this->db->where(' cab.fecha_ingreso <=', $fechaHasta." 23:59:59");
                $data = $this->db->group_end();
                $data = $this->db->where(' d.id_producto ', $prod);
			}

		$this->db->group_by(array("p.id", "p.Nombre","p.Descripcion,MONTH(cab.`fecha_ingreso`)"));
		return $this->db->get()->result_array();
    }
    

}

?>