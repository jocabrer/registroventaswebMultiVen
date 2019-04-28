
<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('America/Santiago');
/*
 * Controlar de Seguimientos
 */
class Woo extends CI_Controller
{

    public function Index()
    {
        
            //$data = $this->M_Woo->get_dato_pedido(162,"_billing_first_name");
        
        
        
        $this->Ver();
        
    }
    
    
    public function Ver()
    {
        $dataContent['titleHeader']  =  "Sistema de seguimiento de pedidos ONLINE.";
        $dataContent['descHeader']   =  "Pedidos desde Woo Comerce";
        //$dataContent['clienteswoo'] = $data;
        
        $this->load->template('v_woo_importar', $dataContent);
        
    }
    /**
     * Muestra el listado de clientes por pedido woo.
     */
    public function listadoClientesWoo(){
        
        if (! $this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
        
        $json = file_get_contents('php://input');
        $obj = json_decode($json);
        
        isset($obj->search) ? $criterio = $obj->search : $criterio = "";
        
        
        $this->load->model('M_Woo');
        $data = $this->M_Woo->get_listado_clientes_pedido($criterio);
        $data2 ['rows'] = $data;
        echo json_encode($data);
    }
    
    
    /**
     * Muestra el detalle de productos para un pedido woo
     */
    public function detallePedidoWoo(){
        
        if (! $this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
        
        $json = file_get_contents('php://input');
        $obj = json_decode($json);
        
        isset($obj->idwoo) ? $idpedidowoo = $obj->idwoo : $idpedidowoo = -1;
        
        
        $this->load->model('M_Woo');
        $data = $this->M_Woo->get_detalle_pedido($idpedidowoo);
        echo json_encode($data);
    }
    
    
    
    /*public function importarClienteWoo()
    {
        
        
        $idclie = $this->input->post('idcliente');
        $nombre = ucwords (strtolower($this->input->post('txt_nombre')));
        $correo = strtolower($this->input->post('txt_correo'));
        $nombr2 = ucwords (strtolower($this->input->post('txt_nombre2')));
        $corre2 = strtolower($this->input->post('txt_correo2'));
        $fono1  = $this->input->post('txt_fono1');
        $fono2  = $this->input->post('txt_fono2');
        $rut    = $this->input->post('txt_rut');
        $giro   = $this->input->post('txt_giro');
        $direc  = $this->input->post('txt_domicilio');
        $comuna = $this->input->post('txt_comuna');
        $obs    = $this->input->post('txt_observaciones');
        
    }*/
    
    
    /**
     * 
     */
    /*public function importarPedido(){
        if (! $this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
        
        $arr = [];
        
        $this->load->model('M_Woo');
        $this->load->model('M_Cliente');
        $this->load->model('M_Pedido');
        
        $user = $this->ion_auth->user()->row();
        $userid = $user->id;
        
        $json = file_get_contents('php://input');
        $obj = json_decode($json);
        
        isset($obj->idpedidowoo) ? $idpedidowoo = $obj->idpedidowoo: $idpedidowoo = -1;
        
        $arrayresult =$this->M_Woo->get_cliente_pedido_woo($idpedidowoo);
        
        if(count($arrayresult)>0)
        {
            $clientewoo =$arrayresult[0];
        }
        else{
                $arr['estado'] = -1;
                $arr['mensaje'] = "Problema al importar cliente de Woo";
                echo json_encode($arr);
                //exit(0);
       }
            
        //crear cliente 
        $nombre = $clientewoo->cliente_primer_nombre." ". $clientewoo->cliente_segundo_nombre ;
        $correo = $clientewoo->cliente_correo;
        $nombr2 = "";
        $corre2 = "";
        $fono1 = $clientewoo->cliente_telefono;
        $fono2 = "";
        $rut = "";
        $giro ="";
        $direc = $clientewoo->cliente_direccion;
        $comuna = $clientewoo->cliente_comuna;
        $obs = $clientewoo->pedido_titulo;
        $id_user = $userid;
        $fecha_mod = new DateTime('America/Argentina/Mendoza');
        
        
        
        
        if(!$this->existe($correo)){
            $arr['id_cliente']= $this->M_Cliente->insert_entry($nombre,$correo,$nombr2,$corre2,$fono1,$fono2,$rut,$giro,$direc,$comuna,$obs,$id_user,$fecha_mod);
            $arr['mensaje'] = '<br/><b>Paso 1</b> Cliente <b>'.$arr['id_cliente'].'</b> grabado correctamente <br/>';
            $arr['estado'] = 1;
        }else
        {
            $arr['mensaje'] = '<br/>El correo del cliente  <b>'.$correo.'</b> ya está ingresado como cliente.<br><br><center><b>Favor Revisar</b></center> <br/>';
            $arr['estado'] = -1;
            $arr['id_cliente']=-1;
        }
        
        //crear cabecera pedido
        //inserto cabecera sin estado aún
        if( $arr['id_cliente']!=-1){
        
            $id_cliente = $arr['id_cliente'];
            $id_pedido = $this->M_pedido->insertaPedidoCabecera($id_cliente, $fecha_mod->format('Y-m-d H:i:s'), $userid, $fecha_mod);
            $arr['mensaje'] = $arr['mensaje'].'<b>Paso 2</b> El pedido número <b>'.$id_pedido.'</b> ingresado correctamente!<br/>';
            //Comision
            //Creo comision con cuentaprincipal 100% porcentaje
            $cta = $this->M_Cuenta->getCuentaPrincipal();
            $this->M_Cuenta->insertaComision($cta, $porcentaje = 100, $id_pedido, $userid, $fecha_mod);
            $arr['mensaje'] = $arr['mensaje'].'<b>Paso 3</b> Comision por defecto inicial creada<br/>';
            //Cambio estado, es el primero asi que va con estado inicial 0
            $idcambioestadoactual = $this->M_estados->insertaPedidoEstado($id_pedido, 0,  new DateTime('America/Argentina/Mendoza'), $userid);
            $arr['mensaje'] = $arr['mensaje'].'<b>Paso 4</b> Estado inicial creado<br/>';
            //Creo un nuevo comentario para seguimiento al cambiar de estado
            $comentario =$this->M_Comentarios->generadorDeComentarioAutomaticoEstado(0);
            $this->M_Comentarios->insertaPedidoComentario($id_pedido, $userid, 0, $comentario, new DateTime('America/Argentina/Mendoza'));
            $arr['mensaje'] = $arr['mensaje'].'<b>Paso 5</b> Comentario inicial creado<br/>';
            // Actualizo cabecera pero no se actualiza ni la fecha de ingreso ni el usuario que lo ingresó por eso mando -1 en el usuario
            $idnuevocabecera = $this->M_pedido->actualizaPedidosDatosCabecera($id_pedido, $idcambioestadoactual, -1, new DateTime('America/Argentina/Mendoza'));
            $arr['mensaje'] = $arr['mensaje'].'<b>Paso 6</b> Cabecera actualizada<br/>';
        }
        echo json_encode($arr);
        
    }
    
    public function existe($correo) {
        
        $cliente_encontrado = $this->M_cliente->buscarClientePorCorreo($correo);
        
        if (count($cliente_encontrado) == 0)
            return false;
            else
                return true;
    }*/
    
}
