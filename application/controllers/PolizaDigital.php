<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PolizaDigital extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();		
		
	}



	public function index()
	{
		$this->load->view('PolizaDigital/formPolizaDigital');

	}


	public function uploadPolizaDigitalCliente()
	{

		$id_usuario= $_REQUEST["id_usuario"];
		$id_poliza= $_REQUEST["id_poliza"];

		$this->load->model('PolizaDigital/Model_PolizaDigital'); 
          $resultado_query = $this->Model_PolizaDigital->uploadPolizaDigitalCliente($id_usuario,$id_poliza,$_FILES);

		//$datosUsuario["aa"] = $datosUsuario;

		 echo json_encode($resultado_query);
		//var_dump($datosUsuario); 
	}

	public function getDatosPolizasCliente()
	{

		$id_usuario= $_REQUEST["id_usuario"];

		$this->load->model('PolizaDigital/Model_PolizaDigital'); 
          $resultado_query = $this->Model_PolizaDigital->getDatosPolizasCliente($id_usuario);

		//$datosUsuario["aa"] = $datosUsuario;

		 echo json_encode($resultado_query);
		//var_dump($datosUsuario); 
	}



}

?>