<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PagosVencer extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();		
		
	}



	public function index()
	{
		$this->load->view('Polizas/formPolizaPagosVencer');

	}





}

?>