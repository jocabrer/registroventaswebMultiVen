
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporte extends CI_Controller {

	
	public function index()
	{
	    $dataContent['titleHeader']        = "Sistema de reportes LYM";
	    $dataContent['descHeader']   	   = "Hojas de trabajo, analisis de ventas, Sistema lym.";
	    
	    //Autenticación
	    if (!$this->ion_auth->logged_in()){
	        redirect('auth/login');
		}
		$this->hojas(-1);
	}
	
	/*
	 * Función que elimina una hoja.
	 *
	 * @return void
	 */
	public function eliminaHoja()
	{
		//Seguridad
		if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
		}
		$this->load->model('M_hojas');

        //Rescato id a eliminar
        $nombre_hoja = $this->input->post('nombre_hoja');
		//Eliminamos registro de la BD 
        $estado = $this->M_hojas->eliminaHojaCompleta($nombre_hoja);
        // Salida de respuesta $id,$objeto,$estado,$accion,$mensaje
        $this->load->salidaRetornoAjax($nombre_hoja, "hoja", "L", "eliminada", $estado);
	}

	
	
	/**
	 * Función que carga la pantalla de hojas.
	 *
	 * @param integer $hoja nombre id de la hoja que se desea cargar (opcional).
	 * @return void Salida de pantalla.
	 */
	public function hojas($hoja=-1){
		
		$this->load->model('M_alertas');

	    $dataContent['titleHeader']        = "Sistema de reportes LYM";
		$dataContent['descHeader']   	   = "Hojas de trabajo, analisis de ventas, Sistema lym.";
		$dataContent['idhoja'] = $hoja;

		if($hoja!=-1)
		$dataContent['alertas'] = $this->M_alertas->obtieneAlertas($hoja);
	    
	    if (!$this->ion_auth->logged_in()){
	        redirect('auth/login');        
	    }else  {
	        $this->load->template('v_hoja', $dataContent);
	    }
	}
	
	/**
	 * Función que obtiene y devuelve una hoja y su detalle en formato Json para cargar en tabla.
	 *
	 * @param [type] $idhoja
	 * @return void
	 */
	function muestraHoja(){
	    
	    $this->load->model('M_hojas');
	    
	    if (! $this->ion_auth->logged_in ()) {
	        redirect ( 'auth/login' );
		}
		
		$json = file_get_contents('php://input');
        $obj = json_decode($json);

		isset($obj->hoja) ? $idhoja = $obj->hoja : $idhoja = -1;
		
		
		if($idhoja!=-1)
		{
			$data =  $this->M_hojas->get_hoja($idhoja);
			
			$data2['rows'] = $data;
			$data2['total'] = count($data);
			
			echo json_encode($data2);
		}
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
		$this->load->model('M_alertas');
		
		//Obtengo identificación el usuario.
	    $user = $this->ion_auth->user()->row();
	    $userid = $user->id;
		
		//Lectura de variables
	    $idpedidos =  $this->input->post('nrospedidos');
	    $nombre_hoja = $this->input->post('nombrehoja');
		$tipo_hoja = $this->input->post('tipohoja');
		//fecha de ejecución
	    $fecha_proceso  = $this->load->obtieneFechaActual();
		
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
			$nombre_hoja =  $this->M_hojas->update_entry_cab_hoja($nombre_hoja,$fecha_proceso,$userid);
			$this->M_alertas->grabaAlerta(1,$fecha_proceso,$nombre_hoja,null,"Comienza actualización de hoja : $nombre_hoja");
			//Elimino de la hoja los pedidos que ahora voy a procesar para evitar duplicados.
			$this->M_hojas->borrar_pedidos_hoja($nombre_hoja,$idpedidos);
	    }else{
			$nombre_hoja =  $this->M_hojas->insertaHojaCabecera($nombre_hoja,$fecha_proceso,$userid);
			$this->M_alertas->grabaAlerta(1,$fecha_proceso,$nombre_hoja,null,"Nuevo proceso hoja creada : $nombre_hoja");
	    }

		$id_reg = $this->calculoDeHoja($data,$tipo_hoja,$fecha_proceso,$nombre_hoja);

		$this->load->salidaRetornoAjax($nombre_hoja,'registro','L','procesado','');
	}

	/**
	 * Crea los registros de la tabla hojas según la lógica de reporte.
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
		$cant = count($data);
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
			
			//Solo se calculan totales por pedido , no por linea de detalle
            if($cab_ante == $pedido['pedido']){
				//Mismo pedido distinta línea
                $pagado = 0;
                $saldo = 0;
				$iva = 0;
				$saldovendedor2 = 0;
				$saldocliente = 0 ;

				$elPedido = $this->M_pedido->obtenerPedido($pedido['pedido']);
				$ped= $elPedido[0];
				$this->generaAlertaPedidoHojasPrevias($ped['id'],$nombre_hoja,$fecha_proceso);

            }else{
				//Cuando es un nuevo pedido se hace el calculo del saldo a la fabrica y al vendedor.
				//Si es abono se abona el 50% solamente
				if($tipo=="Abono"){
					//Si es un abono no se muestra saldo aún del vendedor. Solo si el cliente ha pagado todo
					if($saldocliente!=0){
						$saldo = $saldo/2;
						$saldovendedor2 = 0;
						$obs = "Saldado";
					}else{
						//es un abono pero no paga todo
					}
				}
			}
			//Seteo metodo burbuja
			$cab_ante =  $pedido['pedido'];
	        //insertadetalle proceso linea  
            $id_reg = $this->M_hojas->insert_entry_hoja($tipo,$fechaingreso,$nropedido,$cantidad,$producto,$costo_cu,$tot_costo,$pagado,$saldo,$iva,$fecha_proceso,$nombre_hoja,$cont,$saldovendedor2);
		}
		return $id_reg;
	}


	/**
	 * Valida posibles problemas y genera alertas.
	 *
	 * @param [int] $idpedido numero de pedido a analizar.
	 * @param [varchar] $hojactual nombre de la hoja actual.
	 * @return void
	 */
	function generaAlertaPedidoHojasPrevias($idpedido,$hojactual,$fecha_proceso){

		//buscamos coincidencias anteriores
		$hojasPrevias = $this->M_hojas->buscaPedidoHojasPrevias($idpedido,$hojactual);
		
		//recorro  las coincidencias
		foreach($hojasPrevias as $pedido){

			$this->M_alertas->grabaAlerta(1,$fecha_proceso,$hojactual,$pedido->id_cabecera,"El pedido $pedido->id_cabecera se encuentra en la hoja : $pedido->nombre_hoja como : $pedido->tipo");
		}
	}
	
	/**
	 * Función que devuelve un listado de nombres de las hojas del siste,a-
	 *
	 * @return void Salida Json 
	 */
	public function listadoControlHojas() {
	    
	    $this->load->model('M_hojas');
	    
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

	/**
	 * Metodo que entrega json con el listado de ultimas hojas 
	 *
	 * @return Salida json con los resultados.
	 */
	public function ultimasHojasProcesadas(){
		$this->load->model('M_hojas');
		$datos = $this->M_hojas->buscador_hojas(5,"desc","");
		echo json_encode ( $datos );
	}


	/**
	 * Página muestra los distintos informes y graficos según el códigop del reporte muestra titulos y otra info.
	 *
	 * @return void
	 */
	public function graficosCC($cod="RPTDIARIO"){

	    if (! $this->ion_auth->logged_in ()) {
			$this->session->set_userdata('previous_url', current_url());
			redirect ( 'auth/login' );
		}

		if(!$this->ion_auth->is_admin()){
			redirect ( '/' );
		}

		$dataContent['titleHeader']  =  "Informes y Gráficos.";
		$dataContent['descHeader']   =  "Analisis de las ventas.";

		if($cod == "RPTDIARIO"){
			$dataContent['subtitulo']  =  "Informe de pedidos diarios";
		}
			
		if($cod == "RPTMENSUAL"){
			$dataContent['subtitulo']  =  "Informe de pedidos mensuales";
		
		}

		if($cod == "RPTPRODUCTO"){
			$dataContent['subtitulo']  =  "Informe de productos";
			/* controles a desplegar */
		
		}
		
		$dataContent['cod']  = $cod;
		$dataContent['codigoReporte']   =  $cod;
		$dataContent['fechaActual']	= $this->load->obtieneFechaActual();
		$dataContent['agnoActual']	= date("Y");


        $this->load->template('v_graficos', $dataContent);
		
	}

	/**
	 * Método que deriva según el código de reporte al método adecuado para obtener la data
	 *
	 * @return void
	 */
	public function graficoObtieneDatos(){

		$cod =  $this->input->post('cod');

		switch ($cod) {
			case "RPTDIARIO":
				$this->obtenerIngresosPorRangoDiario();
				break;
			case "RPTMENSUAL":
				$this->obtenerIngresosPorRango();
				break;
			case "RPTPRODUCTO":
				$this->obteneReporteProductosMensual();
				break;
		}

	}
	/**
	 * Método Ajax que obtiene la data para el gráfico mensual
	 *
	 * @return void
	 */
	public function obtenerIngresosPorRango(){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }

        $fechaDesde = $this->input->post('startDate');
        $fechaHasta = $this->input->post('endDate');

		$fechaDesdeYP = $this->load->restaAgnoFecha($fechaDesde,1);
		$fechaHastaYP = $this->load->restaAgnoFecha($fechaHasta,1);

		$data['tipo'] = "pedidos";
        $data['act'] = $this->M_pedido->obtenerIngresosPorPedido($fechaDesde,$fechaHasta);
		$data['ant'] = $this->M_pedido->obtenerIngresosPorPedido($fechaDesdeYP,$fechaHastaYP);
		
        echo json_encode($data);
	}
	/*
	 * Método Ajax que obtiene la data para el gráfico diario
	 *
	 * @return void
	 */
	public function obtenerIngresosPorRangoDiario(){
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }

        $fechaDesde = $this->input->post('startDate');
        $fechaHasta = $this->input->post('endDate');
		$data['tipo'] = "pedidos";
		
        $data['act'] = $this->M_pedido->obtenerIngresosPorPedidoDiario($fechaDesde,$fechaHasta);

        echo json_encode($data);

	}
	

	public function obteneReporteProductosMensual(){

		$fechaHasta = $this->load->fechaFinalDeMes()->format('Y-m-d');
		$fechaDesde = $this->load->fechaInicialDeAgno()->format('Y-m-d');
		$prod = $this->input->post('prod');

               
        $fechaDesdeYP = $this->load->fechaInicialDeAgnoAnterior($fechaDesde,1)->format('Y-m-d');
        $fechaHastaYP = $this->load->fechaFinalDeAgnoAnterior()->format('Y-m-d');

		$data['tipo'] = "productos";
		$data['prodata'] = $this->M_Productos->obtenerProductoPorMes($fechaDesde,$fechaHasta,$prod);
		$data['prodataAnt'] = $this->M_Productos->obtenerProductoPorMes($fechaDesdeYP,$fechaHastaYP,$prod);
        echo json_encode($data);
	}


	public function obtenerReporteProductosVendido(){

		$fechaHasta = $this->load->fechaFinalDeMes()->format('Y-m-d');
		$fechaDesde = $this->load->fechaInicialDeAgno()->format('Y-m-d');
		       
        $fechaDesdeYP = $this->load->fechaInicialDeAgnoAnterior($fechaDesde,1)->format('Y-m-d');
        $fechaHastaYP = $this->load->fechaFinalDeAgnoAnterior()->format('Y-m-d');

		
		$data['rows'] = $this->M_Productos->obtenerProductosMasVendidos($fechaDesde,$fechaHasta);
        echo json_encode($data['rows']);
	}


}
