<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();

		 $this->load->model('Usuarios/users');
		
	}
	public function index()
	{
		$this->load->view('Usuarios/usuarios');

	}

	public function cargarUsuariosAlta()
	{
		$id_usuario = $this->session->userdata('id');

		$datosUsuariosAlta = $this->users->obtenerUsuariosAlta($_REQUEST,$id_usuario);

		echo json_encode($datosUsuariosAlta);

	}

	public function cargarUsuariosBaja()
	{

		$id_usuario = $this->session->userdata('id');

		$datosUsuariosBaja = $this->users->obtenerUsuariosBaja($_REQUEST,$id_usuario);

		echo json_encode($datosUsuariosBaja);

	}

	public function getDatosUpdateUsuario()
	{
		$id_usuario = $_POST["id_usuario"];


		$datosUsuario = $this->users->obtenerDatosUsuario($id_usuario);


		if(is_array($datosUsuario))
		{
			echo json_encode($datosUsuario);
		}
		else
		{
			$datos["algo"] = "Hola";
			echo json_encode($datos);
		}

		
	}

	public function enviarEmailUsuario()
	{


		$id_usuario = $_POST["id_usuario"];


		$datosUsuario = $this->users->obtenerDatosUsuario($id_usuario);



		if(is_array($datosUsuario))
		{

			$envioEmail = $this->sendMailGmail($datosUsuario["usuario"][0]);


			if($envioEmail)
			{
				$msjEnvioEmail['msj'] = "Email enviado con éxito";

				echo json_encode($msjEnvioEmail);
			}
			else
			{
				$msjEnvioEmail['msj'] = "Ocurrió un error a la hora de enviar el email, intente de nuevo";
				echo json_encode($msjEnvioEmail);
			}

			
		}
		else
		{
			$datos["algo"] = "Hola";
			echo json_encode($datos);
		}

	}


	function sendMailGmail($datosUsuario)
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
		 $this->email->to($datosUsuario->email);
		 //$this->email->to("luisame@outlook.com");
		 $this->email->subject('Probando Email de prueba');

		 $host= gethostname();
		 $ip = gethostbyname($host);

		 $file_to_attach = "http://".$ip.":8080/PhpCodeigniterPractica/public/uploads/".$datosUsuario->foto;
		 //$file_to_attach = "http://".$ip."/PhpCodeigniterPractica/public/uploads/".$datosUsuario->foto;

		 $this->email->attach($file_to_attach);

		 $mensaje = $this->load->view('Email/email',$datosUsuario,TRUE);
		 // return $message;

		 $this->email->message($mensaje);

		 $envio = $this->email->send();

		 return $envio;

 	}








	public function updateUsuario()
	{
		$id_usuario = $_REQUEST["id_usuario"];
		$id_rol = $_REQUEST["id_rol"];
		$nombre = $_REQUEST["nombre"];
		$apellidos = $_REQUEST["apellidos"];
		$email = $_REQUEST["email"];
		$password = $_REQUEST["password"];
		$cambioImagen = $_REQUEST["cambioImagen"];

		// echo $nombre;
		// echo json_encode($_FILES);

		// exit();


		$datosUsuario = $this->users->actualizarUsuario($id_usuario,$id_rol,$nombre,$apellidos,$email,$password,$cambioImagen,$_FILES);

		//$datosUsuario["aa"] = $datosUsuario;

		echo json_encode($datosUsuario);
		//echo $datosUsuario;
	}


	public function updateUsuarioCabecera()
	{
		$id_usuario = $_REQUEST["id_usuario"];
		$id_rol = $_REQUEST["id_rol"];
		$nombre = $_REQUEST["nombre"];
		$apellidos = $_REQUEST["apellidos"];
		$email = $_REQUEST["email"];
		$password = $_REQUEST["password"];
		$cambioImagen = $_REQUEST["cambioImagen"];

		// echo $nombre;
		// echo json_encode($_FILES);

		// exit();


		$datosUsuario = $this->users->actualizarUsuarioCabecera($id_usuario,$id_rol,$nombre,$apellidos,$email,$password,$cambioImagen,$_FILES);

		//$datosUsuario["aa"] = $datosUsuario;

		echo json_encode($datosUsuario);
		//echo $datosUsuario;
	}

	
	public function checkEmail()
	{
		
		$email = $_POST["email"];
		$id_usuario = $_POST["id_usuario"];


		$datosUsuario = $this->users->verificarEmail($email,$id_usuario);

		//$datosUsuario["aa"] = $datosUsuario;

		 echo json_encode($datosUsuario);
		//echo $datosUsuario;
	}


	public function getDatosBajaUsuario()
	{
		$id_usuario = $_POST["id_usuario"];


		$datosUsuario = $this->users->obtenerDatosBajaUsuario($id_usuario);

		echo json_encode($datosUsuario);
	}

	public function bajaUsuario()
	{
		
		$id_usuario = $_POST["id_usuario"];

		
		$datosUsuario = $this->users->darDeBajaUsuario($id_usuario);

		//$datosUsuario["aa"] = $datosUsuario;

		 echo json_encode($datosUsuario);
		//echo $datosUsuario;
	}


	public function getDatosAltaUsuario()
	{
		$id_usuario = $_POST["id_usuario"];


		$datosUsuario = $this->users->obtenerDatosAltaUsuario($id_usuario);

		echo json_encode($datosUsuario);
	}

	public function altaUsuario()
	{
		
		$id_usuario = $_POST["id_usuario"];

		
		$datosUsuario = $this->users->darDeAltaUsuario($id_usuario);

		//$datosUsuario["aa"] = $datosUsuario;

		 echo json_encode($datosUsuario);
		//echo $datosUsuario;
	}

}

?>