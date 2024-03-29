<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * custom loader file extends CI_Loader
 */
 
class MY_Loader extends CI_Loader {
	
   
   public $userid;
    
    
	public function __construct() {
		parent::__construct();
	}
	/*
	* @template_name  nombre de la vista que se cargar� en el wrapper
	* @dataContent   datos para la vista solicitada a cargar.
	*/
    public function template($template_name, $dataContent = array(), $return = FALSE)
    {
		$CI =& get_instance();
        $CI->load->library('ion_auth');
        $CI->load->library('M_pedido');
        $CI->load->library('M_Productos');
        $CI->load->library('M_Comentarios');
        
		$CI->load->language('site');
		
		//Datahader
		$dataheader['titulo'] = $CI->lang->line('titulo');
		$dataheader['logo'] = $CI->lang->line('logo');
		$dataheader['logomini'] = $CI->lang->line('logomini');
		$dataheader['user'] = $CI->ion_auth->user()->row();
		$dataheader['menuheader'] =  $CI->lang->line('menuheader');
		
		$dataheader['currentAction'] =  $CI->router->fetch_method();
		$dataheader['currentClass'] =  $CI->router->fetch_class();
		
		
		//Autenticaci�n
		if (!$CI->ion_auth->logged_in())
		{
		    redirect('auth/login');
		}else
		{
		    $user = $CI->ion_auth->user()->row();
		    $user_last_visit = $user->last_login;
		    $userid = $user->id;
		    
		}
		
		
		$dataheader['ultimoscomentarios'] =  $CI->M_Comentarios->obtenerUltimosComentariosDelSistema(10);
		$dataheader['ultimoscomentariosNoleidos'] =  $CI->M_Comentarios->obetenerCantidadComentariosSinLeer($user_last_visit);
				
		
		$dataFooter['ultimospedidos'] =  $CI->M_pedido->ObtenerPedidosListado($criterio="",$limit="10",$slestado= array('0','1','2','3'),$ordenarpor="numeroPedido","desc",$slcomision=-1,$cliente="todos");
		$dataFooter['ultimosproductos'] =  $CI->M_Productos->get_productos($criterio="",$limit="5",$ordenarpor="producto.id","desc",$categoria=0);
        
        
        $dataheader['ind_conivasinfactura']  = $CI->M_pedido->obtenerPedidosConIvaSinFactura();
        $dataheader['ind_descuadrados']  = $CI->M_pedido->obtenerPedidosDescuadrados();
		
		//var_dump($dataFooter['ultimospedidos']) ;
		//exit(0);
		
		//Todo datos de usuario Se sacabn de la tabla de autenticacion ( $user->first_name;)
		/*$dataheader['datosusario'] = "usuario jose";
		$dataFooter['datosusario'] = $dataheader['datosusario'];*/
		
		$dataFooter['datosusario']  = "";
		
        $content1 = $this->view('comun/v_header', $dataheader, $return); // header
        $content2 = $this->view($template_name, $dataContent, $return); // body
        $content3 = $this->view('comun/v_footer', $dataFooter, $return); // footer
		
        if ($return)
        {
            return $content1.$content2.$content3;;
        }
    }
    
    
    /*
     * @template_name  nombre de la vista que se cargar� en el wrapper
     * @dataContent   datos para la vista solicitada a cargar.
     */
    public function templatepublic($template_name, $dataContent = array(), $return = FALSE)
    {
        $CI =& get_instance();
        $CI->load->library('M_pedido');
        $CI->load->library('M_Productos');
        $CI->load->library('M_Comentarios');
        
        $CI->load->language('site');
        
        //Datahader
        $dataheader['titulo'] = $CI->lang->line('titulo');
        $dataheader['logo'] = $CI->lang->line('logo');
        $dataheader['logomini'] = $CI->lang->line('logomini');
        $dataheader['user'] = $CI->ion_auth->user()->row();
        $dataheader['menuheader'] =  $CI->lang->line('menuheader');
        
        $dataheader['currentAction'] =  $CI->router->fetch_method();
        $dataheader['currentClass'] =  $CI->router->fetch_class();
        
        //var_dump($dataFooter['ultimospedidos']) ;
        //exit(0);
        
        //Todo datos de usuario Se sacabn de la tabla de autenticacion ( $user->first_name;)
        /*$dataheader['datosusario'] = "usuario jose";
         $dataFooter['datosusario'] = $dataheader['datosusario'];*/
        
        $dataFooter['datosusario']  = "";
        
        $content1 = $this->view('comun/v_publicheader', $dataheader, $return); // header
        $content2 = $this->view($template_name, $dataContent, $return); // body
        $content3 = $this->view('comun/v_publicfooter', $dataFooter, $return); // footer
        
        if ($return)
        {
            return $content1.$content2.$content3;;
        }
    }
    public function myutfencode($data) {
    
    	// var_dump($data);
    	// Transformo los nombres para evitar problemas entre JSON y los tildes y otros caracteres
    	foreach ( $data as $key => $value ) {
    		$data [$key] ['nombre'] = utf8_encode ( $value ['nombre'] );
    	}
    	return $data;
    }

    /**
     * Metodo que se encarga de tomar las variables y presentarlas como un array para salida del sistema
     *
     * @param [int] $id Identificador del objeto
     * @param [string] $objeto Nombre del objeto ej 'pedido','producto' 
     * @param [char] $estado Resultado de la operacion 'E' error, 'L' listo
     * @param [string] $accion  Accion realizada por la operaci�n ej. 'Grabar', 'Eliminar'
     * @param [string] $mensaje mensaje 
     * @return void
     */
    public function salidaRetornoAjax($id,$objeto,$estado,$accion,$mensaje){
        
        //Consulto estado de salida 
        if($estado=="E"){
            //Es Error
            $mensajeError = "No se pudo ".$accion." el ".$objeto ." Error : Cod.". $mensaje;
            $arr = array ('id' => -1, 'mensaje' => $mensajeError);
        }elseif ($estado=="L") {
            //Listo
            $mensajeListo = "Se ha ".$accion." el ".$objeto." (".$id.") correctamente - Cod. ". $mensaje;
            $arr = array ('id' => $id, 'mensaje' => $mensajeListo );
            
        }
        //$arr['estado'] = $estado;
        echo json_encode ($arr);
    }

    public function obtieneFechaActual(){
        return (new DateTime('America/Argentina/Mendoza'))->format('Y-m-d H:i:s');
              
    }

    public function fechaFinalDeMes(){
        $mes = date('m');
        $agno = date('Y');
        if($mes==12){
            $mesprox = 1;
            $agno = $agno+1;
        }
        else
            $mesprox = $mes +1;

        $fechamesprox = date_create("01-$mesprox-$agno");
        return date_modify($fechamesprox,'-1 day');
        
    }

    public function fechaInicialDeAgno(){
        $agno = date('Y');
        return date_create("01-01-$agno");
    }

    public function fechaInicialDeAgnoAnterior(){
        return date_modify($this->fechaInicialDeAgno(),'-1 year');
      }
      
    public function fechaFinalDeAgnoAnterior(){
      return date_modify($this->fechaInicialDeAgno(),'-1 days');
    }
    
    

   
   
   
    public function restaDiasFecha($fecha,$arestar){

        return date("Y-m-d",strtotime($fecha."- ".$arestar." days"));
    }
    public function restaAgnoFecha($fecha,$arestar){

        return date("Y-m-d",strtotime($fecha."- ".$arestar." years"));
    }


}