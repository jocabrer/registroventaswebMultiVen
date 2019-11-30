
<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('America/Santiago');

/*
 * Controlar de Pedidos
 */
class Pedido extends CI_Controller
{

    public function index()
    {
        $this->Listado();
    }


    /**
     * Retorna si un periodo está en la base de datos.
     *
     * @param int $idpedido
     *            el pedido a buscar.
     */
    public function existePedido($idpedido)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }

        if ($idpedido == -1)
            return false;

        return $this->M_pedido->existePedido($idpedido);
    }

    public function porcentajeTotalPedido($idpedido)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
        if ($idpedido == -1)
            return false;

        return $this->M_Cuenta->porcentajeTotalPedido($idpedido);
    }


    public function obtieneIndicadoresExtendidos()
    {

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
        $idpedido = $this->input->post('idpedido');

        $data = $this->M_pedido->obtenerPedidoIndicadoresDetalle($idpedido);



        echo json_encode($data);
    }



    /* ____Salidas____________________________________________________________________________________________________________________________________ */


    public function nuevoPedido()
    {
        $dataContent['titleHeader']  =  "Crear nuevo pedido.";
        $dataContent['descHeader']   =  "Creación de un nuevo pedido";


        $this->load->template('v_pedido_nuevo', $dataContent);
    }
    /*
     * SALIDA Despliega controles para agregar un nuevo pedido
     */
    public function editarPedido($idPed = -1)
    {
        date_default_timezone_set('America/Santiago');

            if (!$this->ion_auth->logged_in()) {
                redirect('auth/login/');
            } else {

                $user = $this->ion_auth->user()->row();
                $userid = $user->id;
            

            $this->load->library("Comun");
            $this->load->helper('form');

            // Para agregar un pedido se necesita un cliente ya creado.
            $dataContent['titleHeader'] = $this->lang->line('i_titleHeader');
            $dataContent['descHeader'] = $this->lang->line('i_descHeader');

            // Frases
            $dataContent['p_nuevopedido'] = $this->lang->line('p_nuevopedido');
            $dataContent['p_formselectcliente'] = $this->lang->line('p_formselectcliente');
            $dataContent['p_linknuevocliente'] = $this->lang->line('p_linknuevocliente');
            $dataContent['p_headerdatospedido'] = $this->lang->line('p_headerdatospedido');
            $dataContent['p_fechaingresopedido'] = $this->lang->line('p_fechaingresopedido');
            $dataContent['p_diasestimados'] = $this->lang->line('p_diasestimados');

            // INicialización control estado
            $dataContent['vEstados'] = $this->M_estados->get_Estados();

            if ($this->existePedido($idPed)) {
                // Editar
                $dataContent['descHeader'] = "Modo Edición ";
                $pededit = $this->M_pedido->obtenerPedido($idPed);

                // Si no lo encuentro redirecciono a este mismo metodo
                if (count($pededit) == 0)
                    redirect('Pedido/nuevoPedido');
                else {

                    $pedido = $pededit[0];
                    $cliente = $this->M_cliente->getcliente($pedido['cli_id']);

                    //Si el pedido es sin comision y no es admin no se permite seguir.
                    if ($pedido['comision']==0){
                        if (!$this->ion_auth->is_admin()) {
                            redirect('Pedido/Listado');
                        }
                    }

                    $dataContent['pedEdit'] = $pedido;
                    $dataContent['cliente'] = $cliente[0];

                    // var_dump($dataContent['cliente']);
                    // exit(0);
                    // Comentarios/Seguimiento
                    $dataContent['comm'] = $this->M_Comentarios->obtenerPedidoComentarios($idPed);

                    // Cuento los dias transcurridos del pedido desde su fecha de ingreso
                    $fecha_ingreso = $this->comun->transformaStringFecha($pededit[0]['est_fec_ing']);
                    $cuantosdias = $this->comun->cuentaDias($fecha_ingreso, date_create());

                    // if ($fecha_ingreso->format('Y-m-d')<=(NEW DateTime('America/Argentina/Mendoza'))->format('Y-m-d'))
                    // $diasTranscurridos = $this->comun->Evalua($this->comun->DiasHabiles($fecha_ingreso->format('Y-m-d'),(NEW DateTime('America/Argentina/Mendoza'))->format('Y-m-d')));
                    // else

                    $dataContent['pedEdit']['diastranscurridos'] = $cuantosdias;

                    // necesito la fehca estado para calcular los dias en ese estado
                    $fechaEstado = $this->comun->transformaStringFecha($pededit[0]['est_fec_estactual']);
                    // if($dataContent['pedEdit']['est_esecuencia']==2){
                    // esperando entrega
                    $diasCambioEstado =  $this->comun->cuentaDias($fechaEstado, date_create());
                    //$this->comun->Evalua($this->comun->DiasHabiles($fechaEstado->format('Y-m-d'), (new DateTime('America/Argentina/Mendoza'))->format('Y-m-d')));
                    $dataContent['pedEdit']['diasCambioEstado'] = $diasCambioEstado;
                    // }

                    // echo $dataContent['pedEdit']['est_esecuencia'];
                    // echo "han pasado ". $diasTranscurridos . " dias , entre el" . $fecha_ingreso . " y el ". $fecha_actual;
                    // exit(0);
                }
            } else
                redirect('Pedido/nuevoPedido');

            $this->load->template('v_pedido', $dataContent);
        }
    }

    /*
   `  * SALIDA listado de pedidos
     */
    public function Listado()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
        $user = $this->ion_auth->user()->row();
        $userid = $user->id;

        if (!$this->ion_auth->in_group(1)) {
            //no es admin solo cuento pedidos con comision
            $comision = 1;
        } else {
            $comision = -1;
        }

        $dataContent['titleHeader'] = "Pedidos";
        $dataContent['descHeader'] = "Panel de pedidos";

        // inicialización control estado
        $dataContent['vEstados'] = $this->M_estados->get_Estados();

        // indicadores contadores
        $dataContent['ind_ingresado'] = $this->M_estados->get_cantidadEstadoComision(0, $comision);
        $dataContent['ind_enfabricacion'] = $this->M_estados->get_cantidadEstadoComision(1, $comision);
        $dataContent['ind_esperando'] = $this->M_estados->get_cantidadEstadoComision(2, $comision);
        $dataContent['ind_listos'] = $this->M_estados->get_cantidadEstadoComision(3, $comision);
        $dataContent['ind_conproblema'] = $this->M_estados->get_cantidadEstadoComision(4, $comision);
        $dataContent['ind_calculando'] = $this->M_estados->get_cantidadEstadoComision(5, $comision);


        $this->load->template('v_pedido_listado', $dataContent);
    }

    /* Metodos________________________________________________________________________________________________________________________________________ */
    /**
     * Método que actualiza la propiedad con factura, para controlar si el envio es con factura.
     */
    public function ActualizaCF()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }

        $id_pedido = $this->input->post('idpedido');
        $chkiva = $this->input->post('chk_iva_val') == "false" ? FALSE : TRUE;

        $this->M_pedido->actualizaPedidoPropiedadFactura($id_pedido, $chkiva);

        $arr = array('id' => $id_pedido);
        echo json_encode($arr);
    }

    /**
     * *
     * AJAX: Graba una línea de detalle para un pedido.
     *
     * @return el id de la línea recien ingresada.
     */
    public function grabaDetalle()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }

        $id_pedido = $this->input->post('idpedido');
        $cant = $this->input->post('cantidad');
        $idprod = $this->input->post('idproducto');
        $monto_cos = $this->input->post('costoventa');
        $monto_precio = $this->input->post('precioventa');

        $this->_grabaDetalle($id_pedido, $cant, $idprod, $monto_cos, $monto_precio);
    }

    public function _grabaDetalle($id_pedido, $cant, $idprod, $monto_cos, $monto_precio)
    {

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }


        $data = $this->M_pedido->insertaPedidoLineaDetalle($id_pedido, $cant, $idprod, $monto_cos, $monto_precio);
        $arr = array(
            'id' => $id_pedido
        );
        echo json_encode($arr);
    }


    /**
     * Graba un nuevo pedido con su respectiva cabecera 
     */
    public function grabaCabecera()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }

        $id_pedido = $this->input->post('idpedido');
        $id_cliente = $this->input->post('idcliente');
        $comision = $this->input->post('comision');

        $idnuevo = $this->_grabaCabecera($id_pedido,$id_cliente,$comision);

        //Salida por modulo
        $this->load->salidaRetornoAjax($idnuevo, "pedido", "L", "grabado", $idnuevo);
    }

    /**
     * Graba una nota para una cabecera
     */
    public function Adj_grabar()
    {
        //Verificamos seguridad
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
        $user = $this->ion_auth->user()->row();

        //Se lee el pedido al que se le grabará el adjunto.
        $id_pedido = $this->input->post('cabecera');

        //Configuracion de los parámetros de subida de archivos.
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png|pdf|doc|docx';

        //analizamos si existe la carpeta del usuario.
        $cliente = $this->M_cliente->get_cliente_pedido($id_pedido);
        $config['upload_path'] = $config['upload_path'].$cliente[0]->cli_id;
        
        //Si no existe lo creamos.
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }
        
        //Cargamos librerias con el config de upload
        $this->load->library('upload', $config);
        $this->load->helper(array('form', 'url'));
       
        //Realizamos la subida y preguntamos si hubo error preparamos salida de error.
        $error="";
        if (!$this->upload->do_upload('userfile')) {
            $error = $this->upload->display_errors();
            $arr = array('id' => -1, 'mensaje' => "Pedido error " . $id_pedido . " - " . $error);
        } else {
            //Si la subida fue correcta obtenemos los datos para grabar el registro.
            $tipo =  $this->input->post('sl_tipoAdjunto');
            $userid = $user->id;
            $url  = $this->upload->data('file_path');
            $filename = $this->upload->data('file_name');
            $fecha  = $this->load->obtieneFechaActual();
            $publico = $this->input->post('publico');
            //Grabamos en la base de datos
            $res =  $this->M_pedido->insertaAdjuntoPedido($id_pedido, $userid, $tipo, $url, $fecha, $filename, $publico);
            #Waring aca daigual ya que despues se hace un redirect.
            if (is_numeric($res))
                $arr = array('id' => $res, 'mensaje' => 'Archivo subido correctamente.');
            else
                $arr = array('id' => -1, 'mensaje' => $res . " " . $error);
        }
        //Redireccionamos a la página del pedido.
        redirect('/Pedido/editarPedido/' . $id_pedido);
    }

    /*
     * Metodo que graba una cabecera recibe los valores por parametro
     */
    public function _grabaCabecera($id_pedido, $id_cliente,$comision)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }

        $fecha_ing = $this->load->obtieneFechaActual();
        //para el log de usuario
        $userid = $this->ion_auth->user()->row()->id;

        //Creo nueva cabecera en caso de no existir.
        if (!$this->existePedido($id_pedido)) {

            //inserto cabecera sin estado aún
            $id_pedido = $this->M_pedido->insertaPedidoCabecera($id_cliente, $fecha_ing, $userid, $this->load->obtieneFechaActual());
            //Comision
            $this->generaComision($id_pedido, $comision);
            //Cambio estado, es el primero asi que va con estado inicial 0
            $idcambioestado = $this->cambiaEstadoPedido($id_pedido, 0, false);

            return $id_pedido;
        }
    }


    /**
     * 
     */
    public function importarPedidoWoo()
    {
       /* if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }

        $this->load->model('M_Woo');
        $this->load->model('M_Cliente');

        $json = file_get_contents('php://input');
        $obj = json_decode($json);

        isset($obj->idpedidowoo) ? $idpedidowoo = $obj->idpedidowoo : $idpedidowoo = -1;

        //rescato el id cliente 
        $datacli = $this->M_Woo->get_cliente_pedido_woo($idpedidowoo);
        $datospedidocliente = $datacli[0];
        $correocliente = $datospedidocliente->cliente_correo;
        $clientes =  $this->M_cliente->buscarClientePorCorreo($correocliente);

        $arr = array(
            'idcabecera' => '-',
            'mensaje' => '-',
            'estado' => '-1',
            'idcliente' => '-1'
        );

        if (count($clientes) == 0) {
            $arr['mensaje'] = "Cliente no existe, este debe ser creado o importado con el mismo correo de WOO";
            $arr['idcliente'] = -1;
            $arr['estado'] = -1;
        } else {

            $arr['idcabecera'] =  $this->_grabaCabecera(-1, $clientes[0]['id'], 1),$comision = 0);
            $arr['idcliente'] = $clientes[0]['id'];
            $arr['mensaje'] = "Pedido grabado correctamente, número de pedido #" . $arr['idcabecera'];
            $arr['estado'] = 1;
            //mi nuevo número de pedido
            $id_pedido = $arr['idcabecera'];
            //asigno el $id_pedido con $idpedidowoo en la tabla 


            //busco los datos del pedido woo.
            $datapedido = $this->M_Woo->get_detalle_pedido($idpedidowoo);
            foreach ($datapedido as $linea) {
                //$this->_grabaDetalle($id_pedido,$linea['cantidad'],$linea['id_producto_interno'],$linea['precio_costo'],$linea['precio_vendido_woo']);
                $data = $this->M_pedido->insertaPedidoLineaDetalle($id_pedido, $linea['cantidad'], $linea['id_producto_interno'], $linea['precio_costo'], $linea['precio_vendido_woo']);
            }

            //falta grabar la relacion cabecera_woo
        }
        echo json_encode($arr);*/
    }

    /**
     * Cambia el estado para un pedido.
     * @param unknown $id_pedido
     * @return unknown[]
     */
    function cambiaEstadoPedido($id_pedido = -1, $idestado = -1)
    {

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }

        if ($id_pedido == -1 || $idestado == -1) {
            return;
        }
        //para el log de usuario
        $userid = $this->ion_auth->user()->row()->id;

        //$comentario =$this->M_Comentarios->obtieneMensajeEstado($idestado);
        //Pedido existente
        //obtengoelestadoanterior si no tiene será -1
        $idestadoanterior = $this->M_estados->obtieneIdEstadoActualPedido($id_pedido);

        //Si cambió estado actualizo
        if ($idestadoanterior != $idestado) {
            $idcambioestadoactual = $this->registraCambioEstado($idestado, $id_pedido, $this->load->obtieneFechaActual());
            //Creo un nuevo comentario para seguimiento al cambiar de estado
            //$this->M_Comentarios->insertaPedidoComentario($id_pedido, $userid, $idestado, $comentario, new DateTime('America/Argentina/Mendoza'));
        } else
            $idcambioestadoactual = -1;

        // Actualizo cabecera pero no se actualiza ni la fecha de ingreso ni el usuario que lo ingresó por eso mando -1 en el usuario
        $idnuevocabecera = $this->M_pedido->actualizaPedidosDatosCabecera($id_pedido, $idcambioestadoactual, -1, $this->load->obtieneFechaActual());

        return $idnuevocabecera;
    }

    function cambiadEstadoPedidoPost()
    {
        $id_pedido = $this->input->post('idpedido');
        $idestado = $this->input->post('estado');

        $this->cambiaEstadoPedido($id_pedido, $idestado);

        $arr = array('id' => $id_pedido);
        echo json_encode($arr);
    }


    /**
     * Contiene la lógica para generar la estructura de comision del pedido
     *
     * @param [int] $id_pedido
     * @param [bool] $vendedorPrincipal
     * @return void
     */
    function generaComision($id_pedido, $vendedorPrincipal)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
        //para el log de usuario
        $userid = $this->ion_auth->user()->row()->id;
        $this->M_Cuenta->eliminaPorcentajeExistente($id_pedido);
        
        $cta = $this->M_Cuenta->getCuentaPrincipal();
        
        if($vendedorPrincipal){
           $porcentaje = 100;
        }
        else{
            $porcentaje = 50;
            $cta_sec = $this->M_Cuenta->getCuentaSecundaria();
            $this->M_Cuenta->insertaComision($cta_sec, $porcentaje, $id_pedido, $userid, $this->load->obtieneFechaActual());
        }


        $this->M_Cuenta->insertaComision($cta,$porcentaje, $id_pedido, $userid, $this->load->obtieneFechaActual());

        //Inserto los demás participantes 
        //tipo 2 y 0  Cliente y fabrica
        $cta_pro = $this->M_Cuenta->get_CuentaTipo(2);
        if (!$this->M_Cuenta->tieneCuentaTipo($id_pedido, 2))
        $this->M_Cuenta->insertaComision($cta_pro, $porcentaje = 0, $id_pedido, $userid, $this->load->obtieneFechaActual());

        // porcentaje 0 cuenta cliente 0
        $cta_cli = $this->M_Cuenta->get_CuentaTipo(0);
        if (!$this->M_Cuenta->tieneCuentaTipo($id_pedido, 0))
            $this->M_Cuenta->insertaComision($cta_cli, $porcentaje = 0, $id_pedido, $userid, $this->load->obtieneFechaActual());

    }

    /**
     * Elimina una línea del detalle del pedido.
     */
    public function EliminaLineaDetalle()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
        $id_detalle = $this->input->post('id_detalle');
        echo json_encode($this->M_pedido->eliminaLineaDetallePedido($id_detalle));
    }

    /*
     * Graba estado cambioestado para una cabecera
     */
    public function registraCambioEstado($idestado, $idcabecera, $fecha)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
        $user = $this->ion_auth->user()->row();
        $idusuario = $user->id;
        $idestado = $this->M_estados->insertaPedidoEstado($idcabecera, $idestado, $fecha, $idusuario);

        return $idestado;
    }

    /**
     * Metodo que elimina un pedido
     */
    public function eliminaPedido()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }

        $id_pedido = $this->input->post('id');


        $resultado = $this->M_pedido->eliminaPedido($id_pedido);

        $this->load->salidaRetornoAjax($id_pedido, "pedido", "L", "eliminado", $resultado);
    }

    /**
     * Metodo que llama al modelo que elimina un adjunto
     */
    public function Adj_eliminar()
    {

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
        //Rescato id a eliminar
        $id_adjunto = $this->input->post('id');
        $adjunto = $this->M_pedido->obtenerAdjunto($id_adjunto);

        if($adjunto!=null){
            //Cargo liberías necesaria
            $this->load->helper('file');

            //Debo rescatar el pathurl del archivo para eliminarlo
            unlink($adjunto->pathurl . $adjunto->filename);

            //Eliminamos registro de la BD 
            $estado = $this->M_pedido->eliminaAdjunto($adjunto->id);

            // Salida de respuesta 
            //$id,$objeto,$estado,$accion,$mensaje
            $this->load->salidaRetornoAjax($id_adjunto, "adjunto", "L", "eliminado", $estado);
        }
    }

    /*
     * AJAX : Obtiene las lineas de detalle de un pedido
     *
     * @return Obj. JSON con las lineas de detalle
     */
    public function ajax_getLinesPedido($id_cabecera)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }

        if ($id_cabecera == "")
            $id_cabecera = "-1";

        $data = $this->M_pedido->obtenerPedidoDetalle($id_cabecera);

        echo json_encode($data);
    }


    /*
     * AJAX : Obtiene las lineas de detalle de un pedido
     *
     * @return Obj. JSON con las lineas de detalle
     */
    public function Adj_obtenerPorPedido()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }

        //Obtengo datos del usuario conectado
        $user = $this->ion_auth->user()->row();
        $idusuario = $user->id;

        //Leo las variables del post
        $json = file_get_contents('php://input');
        $obj = json_decode($json);
        isset($obj->pedidoid) ? $pedidoid = $obj->pedidoid : $pedidoid = "";
        isset($obj->order) ? $order = $obj->order : $order = "asc";

        if ($pedidoid == "")
            $pedidoid = "-1";

        $data = $this->M_pedido->obtenerPedidoAdjuntosListado($pedidoid, $idusuario, $order);

        echo json_encode($data);
    }

    public function Adj_buscar($criterio = ""){

        $this->load->model('M_hojas');
		$datos = $this->M_pedido->buscador_adjuntos(5,"desc",$criterio);
		echo json_encode ( $datos );
        
    }

    

    public function Adj_listadoTipo()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
        $data = $this->M_pedido->obtenerTiposAdjuntos();

        echo json_encode($data);
    }

    /**
     * Obtiene el detalle del pedido 
     */
    public function obtenerDetallePedido()
    {

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }

        $json = file_get_contents('php://input');
        $obj = json_decode($json);

        isset($obj->numeroPedido) ? $numeroPedido = $obj->numeroPedido : $numeroPedido = -1;

        $data = $this->M_pedido->obtenerPedidoDetalle($numeroPedido);
        echo json_encode($data);
    }


    /**
     * ********************************************* V_pedido_listado *****************************************************************************
     */

    /*
     * AJAX : METODO pedidos en base a un criterio
     */
    public function listadoPedidos()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }

        $json = file_get_contents('php://input');
        $obj = json_decode($json);

        isset($obj->search) ? $criterio = $obj->search : $criterio = "";
        isset($obj->limit) ? $limit = $obj->limit : $limit = "10000";
        isset($obj->sort) ? $ordenarpor = $obj->sort : $ordenarpor = "numeroPedido";
        isset($obj->order) ? $orden = $obj->order : $orden = "desc";
        isset($obj->slestado) ? $slestado = $obj->slestado : $slestado = array('0', '1', '2', '3', '4', '5', '6', '7', '8');
        isset($obj->cliente) ? $cliente = $obj->cliente : $cliente = "todos";
        isset($obj->slcomision) ? $slcomision = $obj->slcomision : $slcomision = "-1";
        isset($obj->idprod) ? $idprod = $obj->idprod : $idprod = -1;

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
        $data = $this->M_pedido->ObtenerPedidosListado($criterio, $limit, $slestado, $ordenarpor, $orden, $slcomision, $cliente,$idprod);

        $data = $this->ProcesaListado($data);

        // Transformo los nombres para evitar problemas entre JSON y los tildes y otros caracteres
        $data2['rows'] = $data;
        $data2['total'] = count($data);
        echo json_encode($data2);
    }
    /**
     * Realiza calculos sobre la data del pedido, calculos extra para ser mostrados.
     * @param $data array de pedidos
     * @return el array de pedidos con los datos extras
     */
    function ProcesaListado($data)
    {
        date_default_timezone_set('America/Santiago');

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }

        $this->load->library("Comun");

        for ($i = 0; $i < count($data); $i++) {
            $fecha_ingreso = $this->comun->transformaStringFecha($data[$i]["est_fec_ing"]);
            $estadoactual = $data[$i]["estado_sec"];

            if ($estadoactual = 1 || $estadoactual = 0) {
                $data[$i]["diastranscurridos"] = $this->comun->cuentaDias($fecha_ingreso, date_create());
            } else {
                $fecha_estadoactual = $this->comun->transformaStringFecha($data[$i]["est_fec_estactual"]);
                $data[$i]["diastranscurridos"] = $this->comun->cuentaDias($fecha_ingreso, $fecha_estadoactual);
            }
        }

        return $data;
    }


    public function salir()
    {
        $this->load->library('ion_auth');
        $this->ion_auth->logout();
        redirect('auth/login');
    }
}
