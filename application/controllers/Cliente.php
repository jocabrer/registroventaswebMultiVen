<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {

	
	public function index()
	{
		redirect('Cliente/listado');
	}
	/*
	| -------------------------------------------------------------------
	|  Listado de clientes 
	| -------------------------------------------------------------------
	| M�dulo que muestra los ultimos 10 clientes activos (pedido NO cerrado) 
	|
	*/	
	public function listado()
	{
		$dataContent['titleHeader']        = $this->lang->line('titleHeader'); 
		$dataContent['descHeader']   	   = $this->lang->line('descHeader'); 
		$dataContent['titulocliente']      = $this->lang->line('titulocliente'); 
		
		//Autenticaci�n 
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		
		}else
		{
			$this->load->template('v_cliente_listado', $dataContent);
		}
	}
	/*
	*  El agregar cliente despliega el formulario para ser rellenado
	*
	*/
	public function edicion($idClie = -1)
	{
		if (! $this->ion_auth->logged_in ()) {
			redirect ( 'auth/login' );
		} else {
				
			$dataContent['titleHeader']        = $this->lang->line('NuevoCliente'); 
			$dataContent['descHeader']   	   = $this->lang->line('NuevoCliente2'); 
			$dataContent['tituloFormcliente']  = $this->lang->line('tituloFormcliente'); 
				
			$idclie = $this->input->post('idcliente');
			$nombre = $this->input->post('txt_nombre');
			
			if ($idClie <> -1)
			{
				//Tenemos un id cliente pero igual se valida que exista.
				$cliEdit = $this->M_cliente->GetCliente($idClie);
				
				if (count($cliEdit)==0)
					redirect('Cliente/edicion');
				
					
					//var_dump($cliEdit[0]['observaciones']);
					//$cliEdit[0]['observaciones']= json_decode($cliEdit[0]['observaciones']);// $cliEdit[0]['observaciones']; //json_decode($cliEdit[0]['observaciones']);
					
					//var_dump($cliEdit[0]);
					
				//Editar
				$dataContent['descHeader']   =  "Editar Cliente id ";
				//Existe, lo asigno
				$dataContent['cliEdit'] = $cliEdit[0];
			}else{
			    
			    //Nuevo obj cliente
			    $dataContent['cliEdit'] = array (
			        'id' =>-1,
			        'nombre' => '',
			        'nombre2' => '',
			        'correo1' => '',
			        'correo2' => '',
			        'fono1' => '',
			        'fono2' => '',
			        'fono1' => '',
			        'giro' => '',
			        'rut' => '',
			        'domicilio' => '',
			        'comuna' => '',
			        'observaciones' => ''
			    );
			}
			
			$this->load->template ( 'v_cliente', $dataContent );
		}
	}
	/**
	 * Ajax : Para el control de Seleccionar cliente del pedido.
	 *
	 *
	 * Devuelve y filtra el listado de clientes
	 */
	public function listadoClientes() {
		// Seguridad
		if (! $this->ion_auth->logged_in ()) {
			redirect ( 'auth/login' );
		}
		// Fin Seguridad
	
		// Rescato variable POST que me manda el control select2 para filtrar los resultados
		$criterio = $this->input->get ( 'q', TRUE );
		;
		If ($criterio == "")
		$criterio = ""; // Criterio para despistar
	
		// Obtengo los clientes seg�n criterio
		$data = $this->M_cliente->getAllControl( $criterio );
		// Transformo los nombres para evitar problemas entre JSON y los tildes y otros caracteres
		//foreach ( $data as $key => $value ) {
		//	$data [$key] ['nombre'] = utf8_encode ( $value ['nombre'] );
		//}
		echo json_encode ( $data );
	}
	public function salir()
	{
		$this->ion_auth->logout();		
		redirect('auth/login');
	}
	
	
	public function _grabaCliente($idclie,$nombre,$correo,$nombr2,$corre2,$fono1,$fono2,$rut,$giro,$direc,$comuna,$obs){
	    // Seguridad
	    if (! $this->ion_auth->logged_in ()) {
	        redirect ( 'auth/login' );
	    }
	    
	    $user = $this->ion_auth->user()->row();
	    $userid = $user->id;
	    
	    $nombre = ucwords (strtolower(trim($nombre)));
	    $correo = strtolower(trim($correo));
	    $nombr2 = ucwords (strtolower(trim($nombr2)));
	    $corre2 = strtolower(trim($corre2));
	   
	    
	    $arr = array('id' => '-', 'mensaje'=>'-');
	    if (count($this->M_cliente->getcliente($idclie))==0){
	        
	        if(!$this->existe($correo)){
	            $idclie = $this->M_cliente->insert_entry($nombre,$correo,$nombr2,$corre2,$fono1,$fono2,$rut,$giro,$direc,$comuna,$obs,$userid,new DateTime('America/Argentina/Mendoza'));
	            //$arr = array ('id' => $idclie, 'mensaje' => 'Cliente insertado  !');
	            $arr['mensaje'] = "Cliente insertado correctamente con el #".$idclie ;
	            $arr['id'] = $idclie;
	            
	        }
	        else
	        {
	            //$arr =  array('id' => $idclie, 'mensaje' => 'Correo ya est� registrado !');
	            $arr['mensaje'] = "El correo del cliente (".$correo.") ya se encuentra registrado previamente !";
	            $arr['id'] = $idclie;
	            
	        }
	        
	    }else{
	        
	        $resultado =  $this->M_cliente->update_entry($idclie,$nombre,$correo,$nombr2,$corre2,$fono1,$fono2,$rut,$giro,$direc,$comuna,$obs,$userid,new DateTime('America/Argentina/Mendoza'));
	        //$arr = array ('id' => $idclie, 'mensaje' => 'Cliente actualizado  ');
	        $arr['mensaje'] = "Cliente ".$nombre. " actualizado.";
	        $arr['id'] = $idclie;
	    }
	    
	    echo json_encode($arr);
	}
	/**
	 * Graba un nuevo cliente 
	 */
	public function grabaCliente()
	{
	    // Seguridad
	    if (! $this->ion_auth->logged_in ()) {
	        redirect ( 'auth/login' );
	    }
	    
	    
	    $user = $this->ion_auth->user()->row();
	    $userid = $user->id;
	    
		$idclie = $this->input->post('idcliente');
		$nombre = ucwords (strtolower(trim($this->input->post('txt_nombre'))));
		$correo = strtolower(trim($this->input->post('txt_correo')));
		$nombr2 = ucwords (strtolower(trim($this->input->post('txt_nombre2'))));
		$corre2 = strtolower(trim($this->input->post('txt_correo2')));
		$fono1  = $this->input->post('txt_fono1');
		$fono2  = $this->input->post('txt_fono2');
		$rut    = $this->input->post('txt_rut');
		$giro   = $this->input->post('txt_giro');
		$direc  = $this->input->post('txt_domicilio');
		$comuna = $this->input->post('txt_comuna');
		$obs    = $this->input->post('txt_observaciones');
		
		
		$rut = str_replace('.','',$rut);
		
		
		$this->_grabaCliente($idclie,$nombre,$correo,$nombr2,$corre2,$fono1,$fono2,$rut,$giro,$direc,$comuna,$obs);

	}
	/*
	 * Indica si existe o no un cliente.
	 */
	public function existe($correo) {
		
	    $cliente_encontrado = $this->M_cliente->buscarClientePorCorreo($correo);
	
			if (count($cliente_encontrado) == 0)
				return false;
				else
				return true;
	}
	
	
	
	public function  importarClienteWoo()
	{
	    if (! $this->ion_auth->logged_in()) {
	        redirect('auth/login');
	    }
	    
	    $this->load->model('M_Woo');
	    
	    $json = file_get_contents('php://input');
	    $obj = json_decode($json);
	    
	    isset($obj->idpedidowoo) ? $idpedidowoo = $obj->idpedidowoo : $idpedidowoo = -1;
	    $data = $this->M_Woo->get_cliente_pedido_woo($idpedidowoo);
	    $datospedidocliente = $data[0];
	    //var_dump($datospedidocliente);
	    //exit(0);
	    
	    $nombre = ucwords(strtolower($datospedidocliente->cliente_primer_nombre)." ".strtolower($datospedidocliente->cliente_apellido));
	    $correo = strtolower($datospedidocliente->cliente_correo);
	    $nombr2 = "";
	    $corre2 = "";
	    $fono1  = $datospedidocliente->cliente_telefono;
	    $fono2  = "";
	    $rut    = "";
	    $giro   = "";
	    $direc  = $datospedidocliente->cliente_direccion;
	    $comuna = $datospedidocliente->cliente_ciudad;
	    $obs    = $datospedidocliente->pedido_titulo;
	    
	    $this->_grabaCliente(-1,$nombre,$correo,$nombr2,$corre2,$fono1,$fono2,$rut,$giro,$direc,$comuna,$obs);
	}
	
	/**
	 * Busca cliente para no grabar uno ya existente
	 * @param unknown $criterio
	 */
	/*public function buscaCliente($criterio){
	    
	    if (! $this->ion_auth->logged_in ()) {
	        redirect ( 'auth/login' );
	    }
	    $data = $this->M_cliente->getClientes($criterio,$limit,$ordenarpor,$orden);
	}*/
	/*
	 * Funcion que llamael control de usuario select
	 */
	public function ajax_getClientes()
	{
		if (! $this->ion_auth->logged_in ()) {
			redirect ( 'auth/login' );
		}
		$json = file_get_contents('php://input');
		$obj = json_decode($json);
		
		//var_dump($obj);
		//exit(0);
		
		isset ($obj->search)?$criterio = $obj->search:$criterio =  "" ;
		isset ($obj->limit)?$limit = $obj->limit:$limit = "10000" ;
		isset ($obj->sort)?$ordenarpor =  $obj->sort:$ordenarpor =  "id" ;
		isset ($obj->order)?$orden =  $obj->order:$orden =  "desc" ;
		$data = $this->M_cliente->getClientes($criterio,$limit,$ordenarpor,$orden);
		$data2 ['rows'] = $data;
		echo json_encode($data2);
	}
}
