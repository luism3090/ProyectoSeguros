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

	
	


}

?>