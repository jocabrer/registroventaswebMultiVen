<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

/*
 * Controlar de Pedidos
 */
class Cuenta extends CI_Controller {
	
	public function index() {
		
		if (! $this->ion_auth->logged_in ()) {
			redirect ( 'auth/login' );
		} else {		
		

			// Para agregar un pedido se necesita un cliente ya creado.
			$dataContent ['titleHeader'] = "Cuentas del sistema";
			$dataContent ['descHeader'] = "";
			
			
			
			$dataContent['cuentas'] = $this->M_Cuenta->get_Cuentas(); 
			
			$this->load->template ( 'v_cuentas', $dataContent );
		}
	}
	
	
	
	
	public function eliminaComision()
	{
		if (! $this->ion_auth->logged_in ()) {
			redirect ( 'auth/login' );
		}
		$id = $this->input->post ('id');
		
		//Si solo es el 100% y es la unica cuenta no se puede eliminar.
		//if 
		echo json_encode($this->M_Cuenta->eliminarComision($id));
	}
	
	public function eliminaTransaccion()
	{
		if (! $this->ion_auth->logged_in ()) {
			redirect ( 'auth/login' );
		}
		$id = $this->input->post ('id');
		echo json_encode($this->M_Cuenta->eliminarTransaccion($id));
	}
	
	
	public function eliminaTransacciones(){
	    if (! $this->ion_auth->logged_in ()) {
	        redirect ( 'auth/login' );
	    }
	    $ids = $this->input->post ('ids');
	    echo json_encode($this->M_Cuenta->eliminarTransacciones($ids));
	    
	}
	
	
	
	/**
	 * Metodo que lista las cuentas para una tabla ajax actualizable
	 */
	public function ListaCuenta(){
		
		if (! $this->ion_auth->logged_in ()) {
			redirect ( 'auth/login' );
		}else 
		{
			$data = $this->M_Cuenta->get_Cuentas();
			echo json_encode ( $data );
		}
	}
	/**
	 * AJAX : Lista las cuentas
	 */
	public function listadoControlCuenta($tipo=-1) {
		
	
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
	
		// Obtengo los clientes que se les peuede asigna porcentaje , los tipo 1 
		$data = $this->M_Cuenta->get_Cuentas($tipo);
	
		 //var_dump($data);
		// Transformo los nombres para evitar problemas entre JSON y los tildes y otros caracteres
		foreach ( $data as $key => $value ) {
			$data [$key] ['Nombre'] = utf8_encode ( $value ['Nombre'] );
		}
		//$data = $this->load->myutfencode($data);
		echo json_encode ( $data ,true);
	}
	
	
	
	
	
	public function ResumenCuentaPedido($idpedido)
	{
		if (! $this->ion_auth->logged_in ()) {
			redirect ( 'auth/login' );
		}else
		{
			$data = $this->M_Cuenta->get_MovCuentaPedido($idpedido);
			echo json_encode ( $data );
		}	
	}
	/**
	 * Se llama desde V_pedido
	 */
	/*public function ingresoMonto()
	{
		if (! $this->ion_auth->logged_in ())
			redirect ( 'auth/login' );
	
			$monto = $this->input->post ( 'txt_monto' );
			$idcta = $this->input->post ( 'cta' );
			$idctades = $this->input->post ( 'cta_des' );
			$idcabecera = $this->input->post ( 'idcabecera' );
	
			$idregistro = $this->M_Cuenta->InsertaMonto($idcabecera,$monto,$idcta,$idctades,new DateTime('America/Argentina/Mendoza'));
	
			$arr = array ('id' => $idregistro);
			echo json_encode ( $arr );
	}*/
	
	
     
		
	
	public function insertaTransaccion()
	{
		if (! $this->ion_auth->logged_in ())
			redirect ( 'auth/login' );
		
		$monto = $this->input->post ( 'txt_monto' );
		$idcta = $this->input->post ( 'cta' );
		$idctades = $this->input->post ( 'cta_des' );
		$idcabecera = $this->input->post ( 'idcabecera' );
		$glosa = $this->input->post ( 'glosa' );
		
		$user = $this->ion_auth->user()->row();
		$userid = $user->id;
	
		if ($idctades==-1)
		{
			//Sin cuenta de destino , valido si es un ingreso la cuenta de origen entonces se realiza trasnferencia interna entre tipo 0 y tipo 1 primer vendedor
			if($this->M_Cuenta->esCuentaIngreso($idcta))
			{
				$idctades = $this->M_Cuenta->getCuentaPrincipal();
				
				$idregistro = $this->M_Cuenta->imputarMontoCuenta($idcabecera,$monto,$idcta,new DateTime('America/Argentina/Mendoza'),$glosa,$userid);
				$idregistro = $this->M_Cuenta->imputarMontoCuenta($idcabecera,$monto,$idctades,new DateTime('America/Argentina/Mendoza'),$glosa,$userid);
			}else
			    $idregistro = $this->M_Cuenta->imputarMontoCuenta($idcabecera,$monto,$idcta,new DateTime('America/Argentina/Mendoza'),$glosa,$userid);
		}
		else 
		{
			//Cuenta ingreso no genera cargo
			if($this->M_Cuenta->esCuentaIngreso($idcta))
			{
			    $idregistro = $this->M_Cuenta->imputarMontoCuenta($idcabecera,$monto,$idctades,new DateTime('America/Argentina/Mendoza'),$glosa,$userid);
				$idregistro = $this->M_Cuenta->imputarMontoCuenta($idcabecera,$monto,$idcta,new DateTime('America/Argentina/Mendoza'),$glosa,$userid);
			}else 
			    $idregistro = $this->M_Cuenta->transferirMontoCuenta($idcabecera,$monto,$idcta,$idctades,new DateTime('America/Argentina/Mendoza'),$glosa,$userid);
		}
	
		$arr = array ('id' => $idregistro);
		echo json_encode ( $arr );
	}
	
	public function obtenerdetallemovimientos()
	{
		if (! $this->ion_auth->logged_in ()) {
			redirect ( 'auth/login' );
		}else
		{
			$json = file_get_contents('php://input');
			$obj = json_decode($json);
			isset ($obj->search)?$criterio = $obj->search:$criterio =  "" ;
			isset ($obj->limit)?$limit = $obj->limit:$limit = "10000" ;
			isset ($obj->sort)?$ordenarpor =  $obj->sort:$ordenarpor =  "nro_pedido" ;
			isset ($obj->order)?$orden =  $obj->order:$orden =  "desc" ;
			
			$data = $this->M_Cuenta->get_listadoMovimientos($criterio,$limit,$ordenarpor,$orden);
			$data2 ['rows'] = $data;
			$data2 ['total'] = count($data);
			echo json_encode($data2);
		}	
		
	}
	
	public function verdetallemovimientos($idpedido=-1)
	{
		//Autenticación
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}

		$dataContent['titleHeader']  =  "Movimiento de cuentas";
		$dataContent['descHeader']   =  "Listado de movimientos";
		
		$dataContent ['idpedido'] = $idpedido;

		$this->load->template('v_detalle_cuenta', $dataContent);
	}
	
	
	public function MuestraComision($idpedido){
		
		if (! $this->ion_auth->logged_in ()) {
			redirect ( 'auth/login' );
		}else
		{
				$data = $this->M_Cuenta->get_movimientos_cab($idpedido,true);
				echo json_encode($data);
		}
		
	
	}
	
	public function insertaComision(){
		
		if (! $this->ion_auth->logged_in ())
			redirect ( 'auth/login' );
		
		$user = $this->ion_auth->user()->row();
		$userid = $user->id;
		
		$cta = $this->input->post ( 'cta' );
		$porcentaje = $this->input->post ( 'porcentaje' );
		$idcabecera = $this->input->post ( 'idcabecera' );

		/*Antes de insertar comision a un pedido hay que validar que este porcentaje no superara el 100%*/
		$idregistro = -1;
		//echo $this->M_Cuenta->porcentajeTotalPedido($idcabecera);
		//exit(0);
		if (($this->M_Cuenta->porcentajeTotalPedido($idcabecera)+$porcentaje)>100)
		{
		    $arr = array ('estado' => "-1", 'mensaje' =>"-1 El porcentaje supera el 100%, favor modificar :)");
		    echo json_encode ($arr);
		    
		}else{
		    
		    $idregistro = $this->M_Cuenta->insertaComision($cta,$porcentaje,$idcabecera,$userid,new DateTime('America/Argentina/Mendoza'));
		    $arr = array ('estado'=> "0",'id' => $idregistro);
		    echo json_encode ( $arr );
		}
				
	
	}
	
	
	public function ActualizaPorcentaje(){
		
		if (! $this->ion_auth->logged_in ())
			redirect ( 'auth/login' );
		
		if(!$this->ion_auth->is_admin())
			redirect ( 'auth/login' );



		$user = $this->ion_auth->user()->row();
		$userid = $user->id;
			
		$idcomision = $this->input->post ('idcomision');
		$nuevoPorcentaje = $this->input->post ('nuevoPorcentaje');
		$anteriorPorcentaje = $this->input->post ('oldValue');
		$idcabecera = $this->input->post ('idcabecera');
		
		
		/*Antes de insertar comision a un pedido hay que validar que este porcentaje no superara el 100%*/
		$idregistro = -1;
		
		//echo $this->M_Cuenta->porcentajeTotalPedido($idcabecera);
		//exit(0);
		
		if ((($this->M_Cuenta->porcentajeTotalPedido($idcabecera)-$anteriorPorcentaje)+$nuevoPorcentaje)>100)
		{
		    $arr = array ('estado' => "-1", 'mensaje' =>"-1 El porcentaje supera el 100%, favor modificar :)");
		    echo json_encode ($arr);
		    
		}else{
		    $idregistro = $this->M_Cuenta->ActualizaComision($idcomision,$nuevoPorcentaje,$userid,$this->load->obtieneFechaActual());
    		
    		$arr = array ('estado'=> "0",'id' => $idregistro);
    		echo json_encode ( $arr );
		}
	}
}
