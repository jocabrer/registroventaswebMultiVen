
<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
 * Controlar de Seguimientos
 */
class Seguimiento extends CI_Controller
{

    public function Index()
    {
       redirect ( 'seguimiento/Consulta' );
    }
    
    public function Consulta(){
        $dataContent['titleHeader']  =  "Sistema de seguimiento de pedidos ONLINE.";
        $dataContent['descHeader']   =  "ver estado de su pedido";
        
        
        $this->load->templatepublic('v_seguimiento_consulta', $dataContent);
    }
    
    
    /***
     * Función encargada de mostrar el seguimiento de un pedido.
     * @param int $idpedido Pedido a mostrar 
     * @param int $idcliente Cliente al cual pertenece el pedido
     */
    public function Ver($idpedido=-1,$idcliente = -1)
    {
        
        $userid = -1;
        
        if ($this->ion_auth->is_admin())
        {
            $user = $this->ion_auth->user()->row();
            $userid = $user->id;
        }
        
        
        if ($idpedido==-1 or $idcliente==-1) {
            redirect ( 'seguimiento/Consulta' );
        } else {
                
                $pededit = $this->M_pedido->obtenerPedido($idpedido);
                $cliente = $this->M_cliente->getcliente($idcliente);
                
                if($pededit==NULL OR $cliente==NULL)
                    redirect ( 'seguimiento/Consulta' );
                
                    
                $fecha_actual = date_create();
                // Llamados a los modelos
                $detallepedido = $this->M_pedido->obtenerPedidoDetalle($idpedido);
                $indicadores =  $this->M_pedido->obtenerPedidoIndicadores($idpedido);
                $pedidoSeguimiento = $this->M_pedido->obtenerPedidoSeguimiento($idpedido,$idcliente,$userid);
                
                if($indicadores==NULL)
                    $dataContent['indicadores'] = '';
                    else
                        $dataContent['indicadores'] = $indicadores[0];
               
                $dataContent['titleHeader']  =  "Sistema de seguimiento de pedidos ONLINE.";
                $dataContent['descHeader']   =  "ver estado de su pedido";
                $dataContent['id_cabecera']   =  $idpedido;
                $dataContent['fecha_consulta']= $fecha_actual->format('Y-m-d');;
                $dataContent['datos_seguimiento'] = $this->ProcesaListado($pedidoSeguimiento,$fecha_actual);
                $dataContent['pedEdit'] = $pededit[0];  
                $dataContent['cliente'] = $cliente[0];
                $dataContent['detEdit'] = $detallepedido;
                
                $this->load->templatepublic('v_seguimiento', $dataContent);
        }
    }
    
    public function ObtieneDetallePedidoCliente() {
        
        $json = file_get_contents('php://input');
        $obj = json_decode($json);
        
        
        isset($obj->idPed) ? $idPed = $obj->idPed : $idPed = -1;
        isset($obj->idcli) ? $idcli = $obj->idcli : $idcli = -1;
        
        
    
        if ($this->existePedidoCliente($idPed,$idcli)){
            
            $data = $this->M_pedido->obtenerPedidoDetalle($idPed);
            
            
            $data2['rows'] = $data;
            
            $data2['total'] = count($data);
            
            
            echo json_encode($data2);
            
            
           /* $pededit = $this->M_pedido->obtenerPedido($idPed);
            $detallepedido = $this->M_pedido->obtenerPedidoDetalle($idPed);
            $datoscliente= $this->M_cliente->get_cliente_pedido($idPed);
            $indicadores =  $this->M_pedido->obtenerPedidoIndicadores($idPed);
            
            $dataContent['pedEdit'] = $pededit[0];
            $dataContent['detEdit'] = $detallepedido;
            $dataContent['cliEdit'] = $datoscliente[0];
            $dataContent['indicadores'] = $indicadores[0];
            
            $this->load->templatepublic( 'v_comprobante', $dataContent );*/
        }else
            echo "no existe";
    }
    
    /** Retorna si un periodo está en la base de datos.
     *
     * @param int $idpedido
     *        	el pedido a buscar.
     */
    public function existePedidoCliente($idpedido,$idcliente){
        
        if ($idpedido == -1)
            return false;
            
            return  $this->M_pedido->existePedidoCliente($idpedido,$idcliente);
            
    }
    
    
    
    function ProcesaListado($data,$fecha_actual)
    {
        $this->load->library("Comun");
        
        
        
        for ($i = 0; $i < count($data); $i ++) {
            
            $fecha_mod =  $this->comun->transformaStringFecha($data[$i]["fecha_mod"]);
            $fecha_mod_hora = $this->comun->transformaStringFechaHora($data[$i]["fecha_mod"]);
            
            $data[$i]["fecha_mod"] = $fecha_mod->format('Y-m-d');
            $data[$i]["fecha_mod_hora"] = $fecha_mod_hora;
            

            
            $data[$i]["cuentadias_fecha_mod"] =  $this->comun->cuentaDias($fecha_mod, $fecha_actual);
        }
        
        return $data;
    }
  
}
