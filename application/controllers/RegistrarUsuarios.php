<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RegistrarUsuarios extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();

		
		
	}
	public function index()
	{
		$this->load->view('RegistrarUsuarios/registrarUsuarios');

	}

	public function checkEmail()
	{
		
		$email = $_POST["email"];

		$this->load->model('RegistrarUsuarios/registrarUsers');
		$datosUsuario = $this->registrarUsers->verificarEmail($email);

		//$datosUsuario["aa"] = $datosUsuario;

		 echo json_encode($datosUsuario);
		//var_dump($datosUsuario); 
	}

	public function insertarUsuario()
	{

		$nombre= $_REQUEST["nombre"];
		$apellidos = $_REQUEST["apellidos"];
		$email = $_REQUEST["email"];
		$password = $_REQUEST["password"];
		$id_rol = $_REQUEST["id_rol"];

		
		// $email = $_POST["email"];
		// $password = $_POST["password"];
		// $id_rol = $_POST["id_rol"];

		

		$datosUsuario = $this->registrarUsers->insertUsers($nombre,$apellidos,$email,$password,$id_rol,$_FILES);

		//$datosUsuario["aa"] = $datosUsuario;

		 echo json_encode($datosUsuario);
		//var_dump($datosUsuario); 
	}


}

?>