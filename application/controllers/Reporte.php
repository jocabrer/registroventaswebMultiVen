
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporte extends CI_Controller {

	
	public function index()
	{
	    $dataContent['titleHeader']        = "Sistema de reportes LYM";
	    $dataContent['descHeader']   	   = "Hojas de trabajo, analisis de ventas, Sistema lym.";
	    
	    //Autenticaci�n
	    if (!$this->ion_auth->logged_in())
	    {
	        redirect('auth/login');
	        
	    }else
	    {
	        $this->load->template('v_blank', $dataContent);
	    }
	}
	

	public function hojas(){
	    
	    $dataContent['titleHeader']        = "Sistema de reportes LYM";
	    $dataContent['descHeader']   	   = "Hojas de trabajo, analisis de ventas, Sistema lym.";
	    
	    if (!$this->ion_auth->logged_in()){
	        redirect('auth/login');        
	    }else  {
	        $this->load->template('v_hoja', $dataContent);
	    }
	}
	
	/*public function procesaHojaPedidos(){
	    
	    if (! $this->ion_auth->logged_in ()) {
	        redirect ( 'auth/login' );
	    }
	    $json = file_get_contents('php://input');
	    $obj = json_decode($json);
	    
	    //var_dump($obj);
	    
	    //exit(0);
	    if( (!Isset($obj->nrospedidos))||(!Isset($obj->nombrehoja)) || (!Isset($obj->tipohoja))|| (!Isset($obj->procesa)) )
	    {
	           return "";
	    }
	    else{
	        
	      //  var_dump($obj->nrospedidos);
 //	        exit(0);
	        if ($obj->nrospedidos=="") return "vacia";
	        
	    	        $idpedidos = $obj->nrospedidos;
	    	        $nombre_hoja = $obj->nombrehoja;
	    	        $tipo_hoja = $obj->tipohoja;
	    	        $procesa = $obj->procesa;
	    }
	    

	    if($procesa=="true")
	    {
	       $this->calculaHoja($idpedidos,$nombre_hoja,$tipo_hoja);
	    }
	    

	    $data =  $this->M_pedido->get_hoja($nombre_hoja);
	    
	    $data2['rows'] = $data;
	    $data2['total'] = count($data);
	    
	    echo json_encode($data);
	    
	}*/
	
	function muestraHoja($idhoja){
	    
	    $this->load->model('M_hojas');
	    
	    if (! $this->ion_auth->logged_in ()) {
	        redirect ( 'auth/login' );
	    }
	    
	    $data =  $this->M_hojas->get_hoja($idhoja);
	    
	    $data2['rows'] = $data;
	    $data2['total'] = count($data);
	    
	    echo json_encode($data);
	    
	}
	
	
	/**
	 * Proceso un listado de pedidos según el tipo de procesamiento
	 *
	 * @return void
	 */
	function procesaHoja(){
		
		//Seguridad.
		if (! $this->ion_auth->logged_in ()) {
	        redirect ( 'auth/login' );
		}
		
		//Cargamos el modelo. 
	    $this->load->model('M_hojas');
		
		//Obtengo identificación el usuario.
	    $user = $this->ion_auth->user()->row();
	    $userid = $user->id;
		
		//Lectura de variables
	    $idpedidos =  $this->input->post('nrospedidos');
	    $nombre_hoja = $this->input->post('nombrehoja');
		$tipo_hoja = $this->input->post('tipohoja');
		//fecha de ejecución
	    $fecha_proceso  =new DateTime('America/Argentina/Mendoza');
		
		//Obtengo todos los pedidos ingresados.
	    $data = $this->M_pedido->ObtenerPedidosFormatoListaHja($idpedidos);
		
		//Si no hay pedidos lanzo excepción.
	    if(count($data)==0){
	        throw new Exception('no hay pedidos con esos numeros');
	    }
	    
	    //Valido si la cabecera de la hoja existe.
		$obj_hoja_cabecera = $this->M_hojas->get_hoja_cabecera($nombre_hoja);
		
		//Si existe actualizo fechas, sino inserto una cabecera de hoja.
		if(count($obj_hoja_cabecera)>0){
			$nombre_hoja =  $this->M_hojas->update_entry_cab_hoja($nombre_hoja,$fecha_proceso,$fecha_proceso,$userid);
			//Elimino de la hoja los pedidos que ahora voy a procesar para evitar duplicados.
			$this->M_hojas->borrar_pedidos_hoja($nombre_hoja,$idpedidos);
	    }else{
	        $nombre_hoja =  $this->M_hojas->insertaHojaCabecera($nombre_hoja,$fecha_proceso,$fecha_proceso,$userid);
	    }

		$id_reg = $this->calculoDeHoja($data,$tipo_hoja,$fecha_proceso,$nombre_hoja);
		echo json_encode($id_reg);
	}

	/**
	 * Crealos registros de la tabla hojas según la lógica de reporte.
	 *
	 * @param [type] $data datos a procesas.
	 * @param [type] $tipo_hoja tipos de registros.
	 * @param [type] $fecha_proceso fecha de este proceso.
	 * @param [type] $nombre_hoja nombre de lah hoja a la que corresponden los datos.
	 * @return void
	 */
	public function calculoDeHoja($data,$tipo_hoja,$fecha_proceso,$nombre_hoja){
		//Inicializo contadores en 0
	    $cab_ante = 0;
	    $cont = 0;
		// Variable de control para no duplicar pedidos.
		$nropedidoActual = "";

		//Recorremos los datops de
	    foreach ($data as $pedido){
	        $cont++;
	        
	        $tipo = $tipo_hoja;
            $fechaingreso = $pedido['fechaingreso'];
            $nropedido = $pedido['pedido'];
            $cantidad = $pedido['cantidad'];
            $producto = $pedido['producto'];
            $costo_cu = $pedido['costo_cu'];
            $tot_costo = $pedido['tot_costo'];
            $pagado = $pedido['pagado'];
            $saldo = $pedido['saldo'];
			$iva = $pedido['iva'];
			$saldocliente = $pedido['SaldoCliente'];
			$saldovendedor2 = $pedido['SaldoVendedor2'];


			
			
			//Solo se calculan por pedido , no por linea de detalle
            if($cab_ante == $pedido['pedido']){
                $pagado = 0;
                $saldo = 0;
				$iva = 0;
				$saldovendedor2 = 0;
				$saldocliente = 0 ;
            }else{
				//Cuando es un nuevo pedido se hace el calculo del saldo a la fabrica y al vendedor.
				
				//Si es abono se abona el 50% solamente
				if($tipo=="Abono"){
					//Si es un abono no se muestra saldo aún del vendedor. Solo si el cliente ha pagado todo
					if($saldocliente!=0){
						$saldo = $saldo/2;
						$saldovendedor2 = 0;
					}else{
						//es un abono pero paga todo
					}
				}
			}
		
			
	        //insertadetalle   
            $id_reg = $this->M_hojas->insert_entry_hoja($tipo,$fechaingreso,$nropedido,$cantidad,$producto,$costo_cu,$tot_costo,$pagado,$saldo,$iva,$fecha_proceso,$nombre_hoja,$cont,$saldovendedor2);
            $cab_ante =  $pedido['pedido'];
			
			
		}
		
		return $id_reg;
	}
	
	/**
	 * AJAX : Lista los productos
	 */
	public function listadoControlHojas() {
	    
	    $this->load->model ( 'M_hojas' );
	    
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
	    
	    // Obtengo los clientes seg�n criterio
	    $data = $this->M_hojas->getAll ( $criterio );
	    
	    // var_dump($data);
	    // Transformo los nombres para evitar problemas entre JSON y los tildes y otros caracteres
	    foreach ( $data as $key => $value ) {
	        $data [$key] ['nombre_hoja'] = utf8_encode ( $value ['nombre_hoja'] );
	    }
	    //$data = $this->load->myutfencode($data);
	    echo json_encode ( $data );
	}
}
