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

	public function colocarFechasPagos()
	{

		$fecha_inicial = $_REQUEST["fecha_inicial"];
		$IdFormaDePago = $_REQUEST["IdFormaDePago"];

		$this->load->model('Polizas/Model_FechasPagosPolizas'); 
		$datos = $this->Model_FechasPagosPolizas->colocarFechasPagos($fecha_inicial,$IdFormaDePago);


		echo json_encode($datos);

	}


	public function empresarial()
	{
		$this->load->view('Polizas/formPolizaEmpresarial');

	}

	public function gastos_medicos_mayores()
	{
		$this->load->view('Polizas/formPolizaGastosMedicosMayores');

	}

	public function responsabilidad_civil()
	{
		$this->load->view('Polizas/formPolizaResponsabilidadCivil');

	}

	public function vida_grupo()
	{
		$this->load->view('Polizas/formPolizaVidaGrupo');

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


	public function cargarSelectFormaPago()
	{
		
		$this->load->model('Polizas/cargarSelectsPolizas'); 
		$datosSelect = $this->cargarSelectsPolizas->cargarSelectFormaPago();

		echo json_encode($datosSelect);

	}


	public function cargarSelectMoneda()
	{
		
		$this->load->model('Polizas/cargarSelectsPolizas'); 
		$datosSelect = $this->cargarSelectsPolizas->cargarSelectMoneda();

		echo json_encode($datosSelect);

	}


	public function cargarSelectMedioPago()
	{
		
		$this->load->model('Polizas/cargarSelectsPolizas'); 
		$datosSelect = $this->cargarSelectsPolizas->cargarSelectMedioPago();

		echo json_encode($datosSelect);

	}


	public function cargarSelectPais()
	{
		
		$this->load->model('Polizas/cargarSelectsPolizas'); 
		$datosSelect = $this->cargarSelectsPolizas->cargarSelectPais();

		echo json_encode($datosSelect);

	}




	public function cargarClientes()
	{
		$this->load->model('Polizas/LoadClientes');
		$datosClientes = $this->LoadClientes->cargarClientes($_REQUEST);

		echo json_encode($datosClientes);

	}



	public function registrarPolizaAutos()
	{
		

		$datosPoliza = $_REQUEST["datosPoliza"];
		$datosPolizaAuto = $_REQUEST["datosPolizaAuto"];
		$datosPolizaPrima = $_REQUEST["datosPolizaPrima"];
		$datosPagos = $_REQUEST["datosPagos"];


		$this->load->model('Polizas/insertarPolizaAutos'); 
		$datosQuery = $this->insertarPolizaAutos->insertPolizaAutos($datosPoliza,$datosPolizaAuto,$datosPolizaPrima,$datosPagos);


		echo json_encode($datosQuery);


	}
	


}

?>