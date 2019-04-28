<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	
	
	public function index()
	{
		
		$dataContent['titleHeader']  =  $this->lang->line('i_titleHeader'); 
		$dataContent['descHeader']   =  $this->lang->line('i_descHeader');
		
		
		
		
		
		
		
		//Autenticación 
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}else
		{
			$this->load->template('inicio', $dataContent);
		}
	}

	public function salir()
	{
		$this->load->library('ion_auth');
		$this->ion_auth->logout();		
		redirect('auth/login');
	}
}
