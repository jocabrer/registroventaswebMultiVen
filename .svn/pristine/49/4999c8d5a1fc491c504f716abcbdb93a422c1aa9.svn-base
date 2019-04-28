<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {

	
	
	public function index()
	{
		
		$dataContent['titleHeader']  =  $this->lang->line('i_titleHeader'); 
		$dataContent['descHeader']   =  $this->lang->line('i_descHeader'); 
		
		//Autenticación 
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}else
		{
			$this->load->template('v_producto', $dataContent);
		}
	}

	
	public function eliminaProducto()
	{
		if (! $this->ion_auth->logged_in ()) {
			redirect ( 'auth/login' );
		}
		$id = $this->input->post ('id');
		echo json_encode($this->M_Productos->delete_prod($id));
		
	}
	
	public function agregar($idProd = -1)
	{
	    
	    
		//Autenticación
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
		
		$dataContent['titleHeader']  =  "Productos";
		$dataContent['descHeader']   =  "Agregar productos";
		$dataContent['categorias']   = $this->M_Productos->get_Categorias();
		
		
		$dataContent['proEdit'] = array (
					'id' =>-1,
				    'Codigo' => '',
				    'Nombre' => '',
				    'Descripcion' => '',
					'valor_venta' => 0,
					'costo' => 0,
		            'id_categoria' => -1
		);
		
		
		if ($idProd<>-1)
		{
			$dataContent['descHeader']   =  "Editar producto id " . $idProd;
			//Valido que producto existe
			
			
			$prodedit = $this->M_Productos->getProdPorid($idProd);
			//var_dump($prodedit);
			//exit(0);
			if (count($prodedit)==0)
				redirect('Productos/agregar');
			
			$dataContent['proEdit'] = $prodedit[0];
			
		}
		
		
		$this->load->template('v_producto_nuevo', $dataContent);
		
	}
	
	
	public function listado()
	{
		$dataContent['titleHeader']  =  "Productos";
		$dataContent['descHeader']   =  "Listado productos";
		$dataContent['categorias']   = $this->M_Productos->get_Categorias();
		
		
		//Autenticación
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}else
		{
			$this->load->template('v_productos', $dataContent);
		}
	}
	public function save()
	{
	    $user;
	    
	    (!$this->ion_auth->logged_in ())? redirect ( 'auth/login' ):$user = $this->ion_auth->user()->row();
				
		$txt_codProd = $this->input->post ('txt_codProd');
		$txt_nomProd = $this->input->post ('txt_nomProd');
		$txt_descProd = $this->input->post ('txt_descProd');
		$txt_costoventa = $this->input->post ('txt_costoventa');
		$txt_precioventa = $this->input->post ('txt_precioventa');
		$idcategoria = $this->input->post ('idcategoria');
		$idproducto = $this->input->post ( 'idproducto' );
		
		if($idproducto <> -1)
		{
			//Actualizar
		    $resultado = $this->M_Productos->update_entry($idproducto,$txt_codProd,$txt_nomProd,$txt_descProd,$txt_precioventa,$txt_costoventa,$idcategoria,$user->id);
		    $mensaje = 'Producto actualizado';
		}
		else{
		    //genera codigo de producto nuevo
		    $txt_codProd = $this->getNuevoCodigo($idcategoria);
		    $resultado = $this->M_Productos->insert_entry($txt_codProd,$txt_nomProd,$txt_descProd,$txt_precioventa,$txt_costoventa,$idcategoria,$user->id);
		    $mensaje = 'Producto agregado';
		}
		
		if(is_numeric($resultado)){
		    $nuevoIDproducto = $resultado;
		    $arr = array ('id' => $nuevoIDproducto, 'mensaje' => $mensaje);
		}
		else{
		    $arr = array ('id' => -1, 'mensaje' => 'No se pudo grabar el producto. Error : '. $resultado);
		}
		
		
		echo json_encode ($arr);
	

	}
	
	public function actualizaProducto(){
	    
	    $user = $this->ion_auth->user()->row();
	    
	    $Nombre = $this->input->post('Nombre');
        $valor_venta = $this->input->post('valor_venta');
	    $costo = $this->input->post('costo');
	    $idproducto = $this->input->post('id');
	    $codigo = $this->input->post('Codigo');
	    
	    //Actualizar
	    $resultado = $this->M_Productos->update_entry($idproducto,$codigo,$Nombre,'',$valor_venta,$costo,'',$user->id);
	    
	    $arr = array ('id' => $idproducto, 'mensaje' => 'Producto actualizado');
	    
	    echo json_encode($arr);
	}
	
	
	
	private function getNuevoCodigo($catid){
	      
	    if($catid!=""){
	       $sigla = $this->M_Productos->get_sigla_cat($catid);
	       $id =  $this->M_Productos->get_ultimo_id()+1;

	      return  $sigla.$id;
	       
	    }
	}
	
	
	public function ajax_getProductos()
	{
		if (! $this->ion_auth->logged_in ()) {
			redirect ( 'auth/login' );
		}
		
		$json = file_get_contents('php://input');
		$obj = json_decode($json);
		isset ($obj->search)?$criterio = $obj->search:$criterio =  "" ;
		isset ($obj->limit)?$limit = $obj->limit:$limit = "10000" ;
		isset ($obj->sort)?$ordenarpor =  $obj->sort:$ordenarpor =  "id" ;
		isset ($obj->order)?$orden =  $obj->order:$orden =  "desc" ;
		isset ($obj->categoria)?$categoria =  $obj->categoria:$categoria="0";
	
		$data = $this->M_Productos->get_productos($criterio,$limit,$ordenarpor,$orden,$categoria);
		
		$data2 ['rows'] = $data;
		echo json_encode($data2);
	}
	
	
	
	public function ObtieneProductoPorId($idprod)
	{
		if (! $this->ion_auth->logged_in ()) {
			redirect ( 'auth/login' );
		}
		$data = $this->M_Productos->getById($idprod);
		echo json_encode ( $data );
	}
	
	
	/**
	 * AJAX : Lista los productos
	 */
	public function listadoControlProductos() {
		$this->load->model ( 'M_productos' );
	
		// Seguridad
		if (! $this->ion_auth->logged_in ()) {
			redirect ( 'auth/login' );
		}
		// Fin Seguridad
	
		// Rescato variable POST que me manda el control select2 para filtrar los resultados
		$criterio = $this->input->get( 'q', TRUE );
		;
		If ($criterio == "")
		$criterio = ""; // Criterio para despistar
	
		// Obtengo los clientes según criterio
		$data = $this->M_productos->getAll ( $criterio );
	
		// var_dump($data);
		// Transformo los nombres para evitar problemas entre JSON y los tildes y otros caracteres
		foreach ( $data as $key => $value ) {
			$data [$key] ['nombre'] = utf8_encode ( $value ['nombre'] );
		}
		$data = $this->load->myutfencode($data);
		echo json_encode ( $data );
	}
	

	
	
	public function salir()
	{
	    $this->load->library('ion_auth');
	    $this->ion_auth->logout();
	    redirect('auth/login');
	}
}
