<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

/*
 * Controlar de Pedidos
 */
class Comentario extends CI_Controller {
	
	public function index() {
		
	}
	
	
	/**
	 * *
	 * AJAX: Graba una línea de detalle para un pedido.
	 *
	 * @return el id de la línea recien ingresada.
	 */
	public function ObtieneComentarios($id_pedido) {
		
		if (! $this->ion_auth->logged_in ()) {
			redirect ( 'auth/login' );
		}
		$data = $this->M_Comentarios->obtenerPedidoComentarios($id_pedido);
		echo json_encode ( $data );
	}
	
	
	public function grabaComentario()
	{
		if (! $this->ion_auth->logged_in ()) {
			redirect ( 'auth/login' );
		}
		
		$id_cabecera = $this->input->post ( 'idpedido' );
		$estado= $this->input->post ( 'estado' );
		$com = $this->input->post ( 'comm' );
		
		
		$user = $this->ion_auth->user()->row();
		$idusuario = $user->id;
		
		$idcomentario = $this->M_Comentarios->insertaPedidoComentario($id_cabecera,$idusuario,$estado,$com,new DateTime('America/Argentina/Mendoza'));
		
		$arr = array ('id' => $idcomentario,'idpedido' => $id_cabecera);
		echo json_encode ( $arr );
	}
	
}
