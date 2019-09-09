
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chatbot extends CI_Controller {

	
	public function index()
	{
		$this->load->model('M_cbatenciones');
		$this->load->model('M_Chatbot');
		$this->load->library("Comun");
		$fecha = $this->load->obtieneFechaActual();
		
		//Crea objetos
		$atencion =  $this->M_cbatenciones->insertaAtencion($fecha);
		$visitante = $this->creaVisitante($atencion);
		$chatbox = $this->M_Chatbot->insertaChatbot($texto="",$fecha,$atencion,$visitante);
		
		$data['id_visitante'] = $visitante;
		$data['id_atencion'] = $atencion;
		$data['id_chatbox'] = $chatbox;
		$this->load->view('v_chatbot',$data); // footer
	}
	

	/**
	 * Undocumented function
	 *
	 * @return void
	 */
	public function creaVisitante($atencion){


		$this->load->model('M_Cbvisitantes');
		
		$this->load->library('user_agent');

		if ($this->agent->is_browser())
		{
				$agent = $this->agent->browser().' '.$this->agent->version();
		}
		elseif ($this->agent->is_robot())
		{
				$agent = $this->agent->robot();
		}
		elseif ($this->agent->is_mobile())
		{
				$agent = $this->agent->mobile();
		}
		else
		{
				$agent = 'Unidentified User Agent';
		}
		
		//echo $agent;
		//var_dump($_SERVER);
		
		$ip = $_SERVER['REMOTE_ADDR'];





		return $this->M_Cbvisitantes->insertaVisitante($agent,$ip,$atencion);



		//echo $this->agent->platform(); // Platform info (Windows, Linux, Mac, etc.)
	}


	/**
	 * Determina si es bot pregunta o bot respuesta 
	 *
	 * @param [type] $atencion
	 * @return void
	 */
	public function verificaCheck(){

		$this->load->model('M_cbatenciones');

		$atencion = $this->input->post('id_atencion');

		$data = $this->M_cbatenciones->obtieneAtencion($atencion);


		echo json_encode($data);

	}


	public function obtieneMensaje(){

		$this->load->model('M_Chatbot');

		$clave = $this->input->post('clave');
		$clave = trim($clave);
		$desglose = explode(" ",$clave);

		$respuesta="";
		foreach($desglose as $pal){
			
			$respuesta = $this->M_Chatbot->obtieneMensaje($pal);
			
			if($respuesta!="")
				break;
		}
		
		$data['respuesta'] = $this->reemplazaClaves($respuesta);
		$data['respuesta'] = $this->reemplazaClaves($respuesta);

		echo json_encode($data);
	}

	function actualizaObligatorio(){
		
		$this->load->model('M_Chatbot');
		$this->load->model('M_cbatenciones');
		
		$msje = $this->input->post('mensaje');
		$obligatorio = $this->input->post('obligatorio');
		$claveobligatorio = $this->input->post('claveobligatorio');
		$id_atencion = $this->input->post('id_atencion');

		//TODO validar que sea realmente lo que necesita el campo obligatorio
		$this->M_cbatenciones->actualizaAtencion($id_atencion,$claveobligatorio,0);
		
		//if($obligatorio==1)


	}



	function reemplazaClaves($msje){

		//el tiempo
		$hoy = getdate();

		$buenas = "";
		if($hoy['hours']>=12)
		{
			$buenas = "tardes";
			if($hoy['hours']>20){
				$buenas = "noches";
			}
			
		}
		else
			$buenas = "días";

		$msje = str_replace("{tiempo}",$buenas,$msje);

		return $msje;
	}
    
}


