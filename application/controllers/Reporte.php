
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporte extends CI_Controller {

	
	public function index()
	{
	    $dataContent['titleHeader']        = "Sistema de reportes LYM";
	    $dataContent['descHeader']   	   = "Hojas de trabajo, analisis de ventas, Sistema lym.";
	    
	    
	    
	    //Autenticación
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
	    
	    //indicadores contadores
	    /*$dataContent['ind_ingresado']=$this->M_estados->get_cantidadEstado(0);
	    $dataContent['ind_enfabricacion']=$this->M_estados->get_cantidadEstado(1);
	    $dataContent['ind_esperando']=$this->M_estados->get_cantidadEstado(2);
	    $dataContent['ind_listos']=$this->M_estados->get_cantidadEstado(3);*/
	    
	    
	    //Autenticación
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
	
	
	
	function procesaHoja(){
	    
	    
	    $this->load->model('M_hojas');
	    
	    $user = $this->ion_auth->user()->row();
	    $userid = $user->id;
	    
	    $idpedidos =  $this->input->post('nrospedidos');
	    $nombre_hoja = $this->input->post('nombrehoja');
	    $tipo_hoja = $this->input->post('tipohoja');
	    $fecha_proceso  =new DateTime('America/Argentina/Mendoza');
	    
	    $data = $this->M_pedido->ObtenerPedidosFormatoListaHja($idpedidos);
	    
	    if(count($data)==0)
	    {
	        throw new Exception('no hay pedidos con esos numeros');
	    }
	    
	    
	    //Valido si la hoja existe
	    $obj_hoja = $this->M_hojas->get_hoja_cabecera($nombre_hoja);
	    if(count($obj_hoja)>0)
	    {
	        $nombre_hoja =$obj_hoja[0]->nombre_hoja;;//actualizo cabecera hoja
	        $this->M_hojas->update_entry_cab_hoja($nombre_hoja,$fecha_proceso,$fecha_proceso,$userid);
	    }else{
	        $nombre_hoja =  $this->M_hojas->insertaHojaCabecera($nombre_hoja,$fecha_proceso,$fecha_proceso,$userid);
	    }
	    
	    $cab_ante = 0;
	    $cont = 0;
	    
	    //borrar detalle previo
	    //$this->M_hojas->borrar_detalle($nombre_hoja,$tipo_hoja,$nropedido);
	    
	    
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
            
            if($tipo=="Abono"){
                $saldo = $saldo/2;
            }
            
            if($cab_ante == $pedido['pedido']){
                $pagado = 0;
                $saldo = 0;
                $iva = 0;
            }
            
	        //insertadetalle   
            $id_reg = $this->M_hojas->insert_entry_hoja($tipo,$fechaingreso,$nropedido,$cantidad,$producto,$costo_cu,$tot_costo,$pagado,$saldo,$iva,$fecha_proceso,$nombre_hoja,$cont);
            $cab_ante =  $pedido['pedido'];
            
	    }
	    echo json_encode($id_reg);
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
	    
	    // Obtengo los clientes según criterio
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
