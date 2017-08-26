<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OlvidarPassword extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();

	}

	public function index()
	{
		$this->load->view('OlvidarPassword/olvidarPassword');
	}

	public function enviarEmailUserOlvidarPassword()
	{
		$email = $_REQUEST["email"];	

		$this->load->model('ForgotPassword/VerificarExisteEmail');
		$datosConsultaExisteMail = $this->VerificarExisteEmail->verifyExistsEmail($email);

		//$datosConsultaExisteMail["email"] = $email;

		if($datosConsultaExisteMail["msjCantidadRegistros"]> 0)
		{

			$id_usuario = $datosConsultaExisteMail["usuario"][0]->id_usuario;

	
			$this->load->model('ForgotPassword/EnviarEmailForgotPassword');

			$datosProceso = $this->EnviarEmailForgotPassword->enviarMailUsuario($email,$id_usuario);


			if($datosProceso["msjConsulta"] == "OK")
			{

				$envioEmail = $this->sendMailGmail($email,$datosProceso["token"]);


				if($envioEmail)
				{
					$datosProceso["msjConsulta"] = "OK";

					//echo json_encode($msjEnvioEmail);
				}
				else
				{
					$datosProceso['msjConsulta'] = "Error";
					//echo json_encode($msjEnvioEmail);
				}

				
			}
			else
			{
				$datosProceso['msjConsulta'] = "Error";
				
			}

			$salida = $datosProceso;
			echo json_encode($salida);


		}
		else
		{
			$salida = $datosConsultaExisteMail;
			echo json_encode($salida);
		}

	
	}


	function sendMailGmail($email,$token)
 	{

 		$this->load->library("email");
 
         //configuracion para gmail
		 $configGmail = array(
		 'protocol' => 'smtp',
		 'smtp_host' => 'ssl://smtp.gmail.com',
		 'smtp_port' => 465,
		 'smtp_user' => 'luis.molina.testing@gmail.com',
		 'smtp_pass' => 'tesTingSendEmail_1',
		 'mailtype' => 'html',
		 'charset' => 'utf-8',
		 'newline' => "\r\n"
		 );    
		 
		 //cargamos la configuración para enviar con gmail
		 $this->email->initialize($configGmail);
		 
		 $this->email->from('luis.molina.testing@gmail.com');
		 $this->email->to($email);
		 //$this->email->to("luisame@outlook.com");
		 $this->email->subject('Solicitud de cambio de contraseña');

		 $datosUsuario["email"]= $email;
		 $datosUsuario["token"]= $token; 

		 $mensaje = $this->load->view('OlvidarPassword/msjEmailOlvidarPassword',$datosUsuario,TRUE);
		 // return $message;

		 $this->email->message($mensaje);

		 $envio = $this->email->send();

		 return $envio;

 	}

 	function cambiarContrasena()
 	{
 		$token = $_REQUEST["token"];

 		$this->load->model('ForgotPassword/verificarTokenChangePassword');
		$datosTokenUsuarios = $this->verificarTokenChangePassword->verifyTokenChangePassword($token);

		if($datosTokenUsuarios["msjCantidadRegistros"]>0)
		{
			$this->load->view('OlvidarPassword/formCambiarPassword');
		}
		else
		{
			$this->load->view('OlvidarPassword/formCambiarPasswordCaducado');
		}

 		
 	}

 	public function actualizarPasswordUsuario()
 	{
 		$password = $_REQUEST["password"];
 		$token = $_REQUEST["token"];


 		$this->load->model('ForgotPassword/ActualizarPasswordUsuario');
		$datosUpdatePassword = $this->ActualizarPasswordUsuario->updatePasswordUsuario($password,$token);

 		echo json_encode($datosUpdatePassword);

		
 	}


}