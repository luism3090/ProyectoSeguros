<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->view('welcome_message');

		//echo "Hola";
	}

	// // creando una vista y pasarle valores string
	// public function vista1()
	// {
	// 	$datos['mensaje'] = "Hola mundo segundo saludo";
	// 	$this->load->view('welcome/vista1',$datos);
	// } 

	// // creando una vista y pasandole valores numericos 
	// public function sumaNumeros()
	// {

	// 	// -----------------------------------------

	// 	$numeros = array('num1' => 10, 'num2' => 5);

	// 	// $numeros['num1'] = 25;
	// 	// $numeros['num2'] = 25;

	// 	// -----------------------------------------

	// 	// $numeros[0] = 25;
	// 	// $numeros[1] = 130;

	// 	//$datos = array("numbers" => $numeros);



	// 	//$numeros = array(25,130);
	// 	//$datos = array("numbers" => $numeros);

	// 	// -----------------------------------------


	// 	//$this->load->view('welcome/sumaNumeros',["numbers"=>$numeros]);
	// 	$this->load->view('welcome/sumaNumeros',$numeros);
	// } 


}
