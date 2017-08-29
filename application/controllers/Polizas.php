<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Polizas extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();		
		
	}

	public function autos()
	{
		$this->load->view('Polizas/formPolizaAutos');

	}

	public function cargarSelectStatus()
	{
		
		$this->load->model('Polizas/cargarSelectsPolizas'); 
		$datosSelect = $this->cargarSelectsPolizas->cargarSelectStatus();



		echo json_encode($datosSelect);

	}

	public function cargarSelectTipo()
	{
		
		$this->load->model('Polizas/cargarSelectsPolizas'); 
		$datosSelect = $this->cargarSelectsPolizas->cargarSelectTipo();



		echo json_encode($datosSelect);

	}

	public function cargarSelectAseguradora()
	{
		
		$this->load->model('Polizas/cargarSelectsPolizas'); 
		$datosSelect = $this->cargarSelectsPolizas->cargarSelectAseguradora();



		echo json_encode($datosSelect);

	}


	public function cargarClientes()
	{
		$this->load->model('Polizas/LoadClientes');
		$datosClientes = $this->LoadClientes->cargarClientes($_REQUEST);

		echo json_encode($datosClientes);

	}
	


}

?>