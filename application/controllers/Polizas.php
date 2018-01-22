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



	public function registrarPolizaEmpresarial()
	{
		
		$datosPoliza = $_REQUEST["datosPoliza"];
		$cliente_nacimiento = $_REQUEST["cliente_nacimiento"];
		$datosPolizaEmpresarial = $_REQUEST["datosPolizaEmpresarial"];
		$datosPolizaPrima = $_REQUEST["datosPolizaPrima"];
		$datosPagos = $_REQUEST["datosPagos"];


		$this->load->model('Polizas/insertarPolizaEmpresarial'); 
		$datosQuery = $this->insertarPolizaEmpresarial->insertPolizaEmpresarial($datosPoliza,$datosPolizaEmpresarial,$datosPolizaPrima,$datosPagos,$cliente_nacimiento);


		echo json_encode($datosQuery);


	}


	public function registrarPolizaGastosMedicos()
	{
		
		$datosPoliza = $_REQUEST["datosPoliza"];
		$cliente_nacimiento = $_REQUEST["cliente_nacimiento"];
		$datosPolizaPrima = $_REQUEST["datosPolizaPrima"];
		$datosPagos = $_REQUEST["datosPagos"];


		$this->load->model('Polizas/insertarPolizaGastosMedicos'); 
		$datosQuery = $this->insertarPolizaGastosMedicos->insertPolizaGastosMedicos($datosPoliza,$datosPolizaPrima,$datosPagos,$cliente_nacimiento);


		echo json_encode($datosQuery);


	}
	

	public function cargarDetallePolizas()
	{


		$this->load->model('Polizas/Model_Polizas');
		$datos = $this->Model_Polizas->cargarDetallePolizas($_REQUEST);

		echo json_encode($datos);

	}


	public function getPagosPoliza()
	{
		$id_poliza = $_REQUEST['id_poliza'];

		$this->load->model('Polizas/Model_Polizas');
		$datos = $this->Model_Polizas->getPagosPoliza($id_poliza);

		echo json_encode($datos);

	}


	public function hacerPagosPoliza()
	{
		$id_datos_forma_pago = $_REQUEST['id_datos_forma_pago'];
		$pagado = $_REQUEST['pagado'];
		$fecha = $_REQUEST['fecha'];
		

		$this->load->model('Polizas/Model_Polizas');
		$datos = $this->Model_Polizas->hacerPagosPoliza($id_datos_forma_pago,$pagado,$fecha);

		echo json_encode($datos);

	}


	public function enviarEmailCliente()
	{
		$id_poliza = $_REQUEST['id_poliza'];
		

		$this->load->model('Polizas/Model_Polizas');
		$datosPagoCliente = $this->Model_Polizas->getDatosPagoEmailCliente($id_poliza);



		if(is_array($datosPagoCliente))
		{
			$envioEmail = $this->sendMailGmail($datosPagoCliente["datosPagoCliente"][0]);


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
		

		

	}



	function sendMailGmail($datosPagoCliente)
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
		 $this->email->to($datosPagoCliente->correo);
		 //$this->email->to("luisame@outlook.com");
		 $this->email->subject('Pago de póliza');

		 // $host= gethostname();
		 // $ip = gethostbyname($host);

		 // $file_to_attach = "http://".$ip.":8080/PhpCodeigniterPractica/public/uploads/".$datosUsuario->foto;
		 //$file_to_attach = "http://".$ip."/PhpCodeigniterPractica/public/uploads/".$datosUsuario->foto;

		 //$this->email->attach($file_to_attach);

		 $mensaje = $this->load->view('Email/view_EmailClientePagoPoliza.php',$datosPagoCliente,TRUE);
		 // return $message;

		 $this->email->message($mensaje);

		 $envio = $this->email->send();

		 return $envio;

 	}




}

?>