<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prueba extends CI_Controller 
{

	public function vista1()
	{
		$lista = array("cosa1","cosa2","cosa3","cosa4","cosa5");

		$this->load->view('prueba/vista1',["lista" => $lista]);

		

	}

	public function vista2($nombre = null,$apellido = null)
	{
		$datos["nombre"] = $nombre;
		$datos["apellido"] = $apellido;

		$this->load->view('prueba/vista2',$datos);
	}


}

?>