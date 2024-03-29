﻿<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

/*
 * Controlar de Comprobante
 */
class Comprobante extends CI_Controller {
	
    public function index() {
        $dataContent['titleHeader']  =  "Sistema de seguimiento de pedidos ONLINE.";
        $dataContent['descHeader']   =  "ver comprobante ingreso";
        
        $this->load->templatepublic('v_comprobante_consulta', $dataContent);
	}
	
	/**
	 * Arma un comprobante con todos los datos del pedido. 
	 */
	public function imprimirComprobante($idPed = -1) {
		
		
			if ($this->existePedido($idPed)){

				$pededit = $this->M_pedido->obtenerPedido($idPed);
				$detallepedido = $this->M_pedido->obtenerPedidoDetalle($idPed);
				$datoscliente= $this->M_cliente->get_cliente_pedido($idPed);
				$indicadores =  $this->M_pedido->obtenerPedidoIndicadores($idPed);
				
				$dataContent['pedEdit'] = $pededit[0];
				$dataContent['detEdit'] = $detallepedido;
				$dataContent['cliEdit'] = $datoscliente[0];
				$dataContent['indicadores'] = $indicadores[0];
				
			}else 
				redirect('Pedido/nuevoPedido');
			
			$this->load->view('v_comprobanteprn', $dataContent, FALSE); // body
			//$this->load->template ( 'v_comprobante', $dataContent );
		
	}
	
	
	/**
	 * Arma un comprobante con todos los datos del pedido.
	 */
	public function verComprobante($idPed = -1) {
	
	    if (! $this->ion_auth->logged_in ()) {
	        redirect ( 'auth/login' );
	    } else {
			if ($this->existePedido($idPed)){
	
			    $pededit = $this->M_pedido->obtenerPedido($idPed);
			    $detallepedido = $this->M_pedido->obtenerPedidoDetalle($idPed);
				$datoscliente= $this->M_cliente->get_cliente_pedido($idPed);
				$indicadores =  $this->M_pedido->obtenerPedidoIndicadores($idPed);
	
				$dataContent['pedEdit'] = $pededit[0];
				$dataContent['detEdit'] = $detallepedido;
				$dataContent['cliEdit'] = $datoscliente[0];
				$dataContent['indicadores'] = $indicadores[0];
	
				$this->load->templatepublic( 'v_comprobante', $dataContent );
			}
	    }
	}
	
	/*
	* Arma un comprobante con todos los datos del pedido.
	*/
	public function verComprobanteCliente($idPed = -1,$idcli = -1) {
	    
	    
	    if ($this->existePedidoCliente($idPed,$idcli)){
	        
	        $pededit = $this->M_pedido->obtenerPedido($idPed);
	        $detallepedido = $this->M_pedido->obtenerPedidoDetalle($idPed);
	        $datoscliente= $this->M_cliente->get_cliente_pedido($idPed);
	        $indicadores =  $this->M_pedido->obtenerPedidoIndicadores($idPed);
	        
	        $dataContent['pedEdit'] = $pededit[0];
	        $dataContent['detEdit'] = $detallepedido;
	        $dataContent['cliEdit'] = $datoscliente[0];
	        $dataContent['indicadores'] = $indicadores[0];
	        
	        $this->load->templatepublic( 'v_comprobante', $dataContent );
	    }
	}
	
	/** Retorna si un periodo está en la base de datos.
	 *
	 * @param int $idpedido
	 *        	el pedido a buscar.
	 */
	public function existePedido($idpedido){
	
		if ($idpedido == -1)
			return false;
	
			return  $this->M_pedido->existePedido($idpedido);
	
	}
	
	
	
	public function existePedidoCliente($idpedido,$idcliente){
	    
	    if ($idpedido == -1)
	        return false;
	        
	        return  $this->M_pedido->existePedido($idpedido,$idcliente);
	        
	}
	/**
	 * Salir del Sistema
	 */
	public function salir() {
		$this->load->library ( 'ion_auth' );
		$this->ion_auth->logout ();
		redirect ( 'auth/login' );
	}
	
	
	
}
