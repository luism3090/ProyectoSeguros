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
		
		$correo = $_POST["correo"];

		$this->load->model('RegistrarUsuarios/registrarUsers');
		$datosUsuario = $this->registrarUsers->verificarEmail($correo);

		//$datosUsuario["aa"] = $datosUsuario;

		 echo json_encode($datosUsuario);
		//var_dump($datosUsuario); 
	}

	public function getDataSelectRFC()
	{
		$this->load->model('RegistrarUsuarios/GetDataSelects');
		$datosSelect = $this->GetDataSelects->getDataSelectRFC();

		 echo json_encode($datosSelect);
	}

	public function cargarSelectEstado()
	{

		$this->load->model('RegistrarUsuarios/GetDataSelects');
		$datosSelect = $this->GetDataSelects->getDataSelectEstado();

		 echo json_encode($datosSelect);


	}

	public function cargarSelectMunicipios()
	{
		$id_estado = $_REQUEST["id_estado"];

		$this->load->model('RegistrarUsuarios/GetDataSelects');
		$datosSelect = $this->GetDataSelects->getDataSelectMunicipios($id_estado);

		 echo json_encode($datosSelect);


	}


	public function cargarSelectLocalidades()
	{
		$id_municipio = $_REQUEST["id_municipio"];

		$this->load->model('RegistrarUsuarios/GetDataSelects');
		$datosSelect = $this->GetDataSelects->getDataSelectLocalidades($id_municipio);

		 echo json_encode($datosSelect);


	}

	public function insertarUsuario()
	{

		$nombre= $_REQUEST["nombre"];
		$apellido_paterno = $_REQUEST["apellido_pa"];
		$apellido_materno = $_REQUEST["apellido_ma"];
		$id_rfc = $_REQUEST["rfc"];
		$telefono = $_REQUEST["telefono"];
		$celular = $_REQUEST["celular"];
		$id_estado = $_REQUEST["id_estado"];
		$id_municipio = $_REQUEST["id_municipio"];
		$id_localidad = $_REQUEST["id_localidad"];
		$domicilio = $_REQUEST["domicilio"];
		$colonia = $_REQUEST["colonia"];
		$numero = $_REQUEST["numero"];
		$correo = $_REQUEST["correo"];
		$correo_corporativo = $_REQUEST["correoCorp"];
		$password = $_REQUEST["password"];
		$id_rol = $_REQUEST["id_rol"];
		

		$this->load->model('RegistrarUsuarios/registrarUsers');
		$datosUsuario = $this->registrarUsers->insertUsers($nombre,$apellido_paterno,$apellido_materno,$id_rfc,$telefono,$celular,$id_estado,$id_municipio,$id_localidad,$domicilio,$colonia,$numero,$correo,$correo_corporativo,$password,$id_rol);

		//$datosUsuario["aa"] = $datosUsuario;

		 echo json_encode($datosUsuario);
		//var_dump($datosUsuario); 
	}


}

?>