<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
	
	}

	public function index()
	{
		
		 $this->load->view('Login/login');

	}

	public function loginUsuario()
	{

		$datos = array(
						"email" => $_POST['email'],
						"password" => $_POST['password']
					  );

		$this->load->model('InicioLogin/ValidaLogin'); 
		$datosLogin = $this->ValidaLogin->verificarLogin($datos);


		if($datosLogin["msjCantidadRegistros"] > 0)
		{
			
			$arregloSesion = array(
				                    "id_rol"=> $datosLogin["loginUsuario"][0]->id_rol,
									"id_usuario" => $datosLogin["loginUsuario"][0]->id_usuario,
									"nombre" => $datosLogin["loginUsuario"][0]->nombre." ".$datosLogin["loginUsuario"][0]->apellido_paterno." ".$datosLogin["loginUsuario"][0]->apellido_materno,
									"correo" => $datosLogin["loginUsuario"][0]->correo,
									"foto" => $datosLogin["loginUsuario"][0]->foto, 
									"logueado" => true
								  );
										
			

		  $this->session->set_userdata($arregloSesion);
								  
		}

		if($this->session->userdata('id_rol') != "3" )
		{
			$datosLogin["base_url"] = base_url()."Home";
		}
		else
		{
			$datosLogin["base_url"] = base_url()."PolizaDigitalCliente";
		}

		

		echo json_encode($datosLogin);
		
	}


}

?>