
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chatbot extends CI_Controller {

	
	public function index()
	{
		
		$this->load->model('M_cbatenciones');
		$this->load->model('M_Cbvisitantes');
		$this->load->model('M_cbpatrones');
		$this->load->model('M_Chatbot');

		$this->load->library("Comun");


		$fecha = $this->load->obtieneFechaActual();
		$datosVisitante = $this->comun->obtieneDatosVisitante();

		//Crea objetos atencion , visitante y chatbox.
		$atencion =  $this->M_cbatenciones->insertaAtencion($fecha);
		$visitante = $this->M_Cbvisitantes->insertaVisitante($datosVisitante['agent'],$datosVisitante['ip'],$atencion);
		$chatbox = $this->M_Chatbot->insertaChatbot($texto="",$fecha,$atencion,$visitante);
		
		$data['id_visitante'] = $visitante;
		$data['id_atencion'] = $atencion;
		$data['id_chatbox'] = $chatbox;
		
		$data['atencion'] = $this->obtieneAtencion($atencion);
		//$data['preguntasObligatorias'] = $this->M_cbpatrones->obtienePreguntasObligatorias();

		//Salida del chat a navegador
		$this->load->view('v_chatbot',$data); // footer
	}
	

	/**
	 * 
	 *
	 * @return void
	 */
	public function creaVisitante($atencion){

		

		$this->load->model('M_Cbvisitantes');
		$this->load->library('user_agent');

		if ($this->agent->is_browser()){
			$agent = $this->agent->browser().' '.$this->agent->version();
		}elseif ($this->agent->is_robot()){
			$agent = $this->agent->robot();
		}elseif ($this->agent->is_mobile()){
			$agent = $this->agent->mobile();
		}else{
			$agent = 'Unidentified User Agent';
		}
		$ip = $_SERVER['REMOTE_ADDR'];

		return $this->M_Cbvisitantes->insertaVisitante($agent,$ip,$atencion);
	}


	/**
	 * Determina si es bot pregunta o bot respuesta 
	 *
	 * @param [type] $atencion
	 * @return void
	 */
	public function obtieneAtencion($atencion){

		$this->load->model('M_cbatenciones');
		$data = $this->M_cbatenciones->obtieneAtencion($atencion);
		return $data;
	}


	/**
	 * Metodo POST que se encarga de solicitar al modelo un mensaje según una palabra.
	 * Aplica reeplace de palabras plantilla
	 *
	 * @return json con el mensaje de respuesta y su atributo si es obligatorio y su ck
	 */
	public function obtieneMensaje(){

		$this->load->model('M_cbpatrones');

		$clave = $this->input->post('clave');
		
		//tengo el dato anterior de lo que se respondio acá puedo rescatar el nombre por ej si me respondiero el nombre 
		$claveobligatorioRespuesta = $this->input->post('claveobligatorioRespuesta');
		
		$clave = trim($clave);
		$desglose = explode(" ",$clave);

		$respuesta="";
		foreach($desglose as $pal){

			if(strlen($pal)>3)
			{
				$respuesta = $this->M_cbpatrones->obtieneMensaje($pal);
				if($respuesta!="")
					break;
			}
		}
	
		if(empty($respuesta))
			$respuesta = $this->MensajeMuletilla();
		$data['respuesta'] = $this->reemplazaClaves($respuesta);
		echo json_encode($data);
	}

	/**
	 * Obtiene un mensaje cuando no se obtuvo respuestas para alguna entrada de usuario.-
	 *
	 * @return json con 
	 */
	function MensajeMuletilla(){
		$this->load->model('M_cbpatrones');
		return $this->M_cbpatrones->obtieneMensaje('cordial');
	}

	function actualizaObligatorio(){
		
		//$this->load->model('M_Chatbot');
		$this->load->model('M_cbatenciones');
		$this->load->model('M_Cbvisitantes');
		
		$msje = $this->input->post('mensaje');
		$obligatorio = $this->input->post('obligatorio');
		$claveobligatorio = $this->input->post('claveobligatorioRespuesta');
		$id_atencion = $this->input->post('id_atencion');

		//TODO validar que sea realmente lo que necesita el campo obligatorio
		//TODO ACTUALIZAR VISITANTEEEEEEEEEEEEE
		if($claveobligatorio=="ck_nombre")
			$this->M_Cbvisitantes->actualizaVisitante($id_atencion,'nombre',$msje);
		if($claveobligatorio=="ck_contacto"){
			if($obligatorio==2)
				$this->M_Cbvisitantes->actualizaVisitante($id_atencion,'fono',$msje);
			if($obligatorio==3)
				$this->M_Cbvisitantes->actualizaVisitante($id_atencion,'correo',$msje);
		}

		$this->M_cbatenciones->actualizaAtencion($id_atencion,$claveobligatorio,0);
		
		$data['claveobligatorio'] = $claveobligatorio;
		$data['datoobligatorio'] = $msje;
		//if($obligatorio==1)
		echo json_encode($data);

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


