<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class comun {
    
    
    public $feriados=[];
    
    public function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->model('M_fechas');
        $this->cargaFeriados();
    }
    
    function cargaFeriados(){
        
        if(count($this->feriados)==0){
            $f =  $this->ci->M_fechas->obtenerFeriados();
            $cont = 0 ;
            foreach ($f as $row)
            {
                $resultado2[$cont] = $this->transformaStringFecha($row['fecha']);
                $cont++;
            }
            $this->feriados = $resultado2;
        }
    }
    /**
     * Crea un Datetime a partir de un string
     * @param $fecha_ingreso string fecha debe estar separado por guion
     * @return DateTime 
     */
    function transformaStringFecha($fecha_ingreso)
    {
        $temp1  =  explode('-', $fecha_ingreso);
        $temp1[2] = substr($temp1[2], 0,2);
        return new DateTime(join('-',$temp1 ));
     
    }
    
    function transformaStringFechaHora($fecha_ingreso)
    {
        
        return substr($fecha_ingreso, 10,6);
    }
    
    /**
     * Cuenta los d�as entre 2 fechas
     * @param date $fecha_ingreso fecha pasada
     * @param date $fecha_actual fecha actual
     * @return number
     */
    function cuentaDias($fecha_ingreso,$fecha_actual){

         //exit(0);
        $contador = 0;
        $fecha_aux=$fecha_ingreso;
        
        do{
            $fecha_aux= $fecha_aux->add(new DateInterval('P1D'));
            if($fecha_aux<=$fecha_actual)
            {
                if(!in_array($fecha_aux,$this->feriados)){

                    $diadelasemana = date("l", strtotime(date_format($fecha_aux,"Y-m-d")));
                    if($diadelasemana !="Sunday" && $diadelasemana!="Saturday")
                        $contador++;
                }
            }
        
        }while($fecha_aux <= $fecha_actual);
        return $contador;
    }

    
    /**
     * Obtiene información relevante al visitante actual
     */
    public function obtieneDatosVisitante(){

        $this->ci->load->library('user_agent');
        
        $data ="";
        $agent="";

        if ($this->ci->agent->is_browser()){
				$agent = $this->ci->agent->browser().' '.$this->ci->agent->version();
		}elseif ($this->ci->agent->is_robot()){
				$agent = $this->ci->agent->robot();
		}elseif ($this->ci->agent->is_mobile()){
				$agent = $this->ci->agent->mobile();
		}else{
				$agent = 'Unidentified User Agent';
		}
        
        $data['agent'] = $agent;
        $data['ip'] = $_SERVER['REMOTE_ADDR'];

        return $data;
    }
    
    
}