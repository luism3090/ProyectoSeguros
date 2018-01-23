<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PolizaDigitalCliente extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
	
	}



	public function index()
	{
		
		 $this->load->view('PolizaDigital/formPolizaDigitalClientes');

	}

	public function cerrarSesion()
	{
	
		if($this->session->userdata('logueado')!=null)
		{
			
			$this->session->sess_destroy();
			
			$datos["sesion"] = false;
			$datos["base_url"] = base_url()."Login";

			echo json_encode($datos);

		} 
		else{

			$datos["sesion"] = false;
			$datos["base_url"] = base_url()."Login";

			echo json_encode($datos);
		}
	}	


	public function cargarMenu()
	{

		if($this->session->userdata('id_rol') == '1' || $this->session->userdata('id_rol') == '2' ) 
		{

			$dataMenu = '
								<li>
									<a href="'.base_url().'Home"><i class="fa fa-file-text"></i>Pólizas</a>

								</li>
						
		
								<li class="active">

											 <a href="#" data-toggle="collapse" data-target="#Usuarios" class="collapse active" aria-expanded="false">
										    	 <i class="fa fa-user"></i>
										    	 <span class="nav-label">Usuarios</span>
										    	 <i class="fa fa-chevron-left pull-right"></i>
											 </a>

											 <ul class="sub-menu collapse" id="Usuarios" aria-expanded="false" style="">
										    	 <li><a href="'.base_url().'RegistrarUsuarios"><i class=""></i>Registrar</a></li>
											 </ul>
										</li>


										<li class="active">

											 <a href="#" data-toggle="collapse" data-target="#Pólizas" class="collapse active" aria-expanded="true">
										    	 <i class="fa fa-expeditedssl"></i>
										    	 <span class="nav-label">Registrar Pólizas</span>
										    	 <i class="fa fa-chevron-left pull-right"></i>
											 </a>

											 <ul class="sub-menu collapse" id="Pólizas" aria-expanded="false" style="">

											 	<li class="active">

													 <a href="#" data-toggle="collapse" data-target="#Ramo" class="collapse active" aria-expanded="true">
														 <i class="fa fa-list"></i>
														 <span class="nav-label">Ramo</span>
														 <i class="fa fa-chevron-left pull-right"></i>
													 </a>

												 	<ul class="sub-menu collapse" id="Ramo" aria-expanded="false" style="">
														 <li>
														 	<a href="'.base_url().'Polizas/autos"><i class=""></i>Autos</a>
														 </li>'.
														 // <li>
														 // 	<a href="'.base_url().'Polizas/empresarial"><i class=""></i>Empresarial</a>
														 // </li>
														 '<li>
														 	<a href="'.base_url().'Polizas/gastos_medicos_mayores"><i class=""></i>GMM</a>
														 </li>
														
													</ul>

												</li>'.

												

													// <li class="active">
												 //    	 <a href="#" data-toggle="collapse" data-target="#Pagos" class="collapse active">
												 //        	 <i class="fa fa-money"></i>
												 //        	 <span class="nav-label">Pagos</span>
												 //        	 <i class="fa fa-chevron-left pull-right"></i>
												 //    	 </a>
												 //    	 <ul class="sub-menu collapse" id="Pagos">
												 //    	 	<li>
												 //    	 		<a href="'.base_url().'PagosVencer"><i class=""></i>Próximos a vencer</a>
												 //    	 	</li>
												 //    	 	<li>
												 //    	 		<a href="'.base_url().'TodoPolizas"><i class=""></i>Todas las Pólizas</a>
												 //    	 	</li>
												 //    	 </ul>
													 // </li>
											'</ul>
											   
										</li>

										<li><a href="'.base_url().'PolizaDigital"><i class="fa fa-upload"></i>Póliza digital</a></li>
						
										

										';

		}

		 // menu para clientes

		else{ 

			$dataMenu = '<ul class="list-sidebar bg-defoult">
						<li>
							<a href="'.base_url().'PolizaDigitalCliente" class="selecionado">
								<i class="fa fa-list-alt"></i>Póliza digital
							</a>
						</li></ul>';
						// <li>
						// 	<a href="'.base_url().'Descargas"><i class="fa fa-download"></i>Descargas</a>
						// </li>
						// <li>
						// 	<a href="'.base_url().'Descargas"><i class="fa fa-download"></i>Hola mundo</a>
						// </li>
					//'</ul> ';

		}

		
		// $this->load->model('Home/Menu');

		// $datosMenu = $this->Menu->getElmentosMenu($this->session->userdata('id_rol'));

		// $dataMenu = $this->buildMenu($datosMenu,false,false);

		$datos["rowsMenu"] = $dataMenu;

		echo json_encode($datos);

	}


	public function cargarClientes()
	{

		//$this->session->userdata('id_usuario');

		$id_usuario = $this->session->userdata('id_usuario');


		$this->load->model('PolizaDigitalCliente/Model_PolizaDigitalCliente');
		$datosClientes = $this->Model_PolizaDigitalCliente->cargarClientes($_REQUEST,$id_usuario);

		echo json_encode($datosClientes);

	}


	public function getDatosPolizasCliente()
	{

		$id_usuario = $this->session->userdata('id_usuario');

		$this->load->model('PolizaDigitalCliente/Model_PolizaDigitalCliente'); 
        $resultado_query = $this->Model_PolizaDigitalCliente->getDatosPolizasCliente($id_usuario);

        $resultado_query["nombre"] = $id_usuario = $this->session->userdata('nombre');

		//$datosUsuario["aa"] = $datosUsuario;

		 echo json_encode($resultado_query);
		//var_dump($datosUsuario); 
	}




	// function buildMenu($datosMenu1,$is_sub,$descripcion)
	// {

	// 	$menu = "";
	// 	$attr = "";

	// 	if($is_sub)
	// 	{
	// 		$attr = "class='sub-menu collapse' id='".$descripcion."'";
	// 		$menu = "<ul $attr >";
	// 	}
	// 	else
	// 	{
	// 		 $attr = 'id="menu"';
	// 	}


	// 	  foreach($datosMenu1 as $id => $properties) 
	// 	  {


	// 		  	$datosMenu2 = $this->Menu->getHijosElmentosMenu($properties->id_elemento_menu,$this->session->userdata('id_rol'));
			  	
	// 		  	if(!empty($datosMenu2)) 
	// 		  	{

 //                	$sub = $this->buildMenu($datosMenu2, TRUE,$properties->descripcion);

	//             }		           
	//             else {

	//                 $sub = NULL;                

	//             }	

	//             if ($sub != NULL)
	//             {
	            	
	            	
	//             	 $menu .= "<li class='active' >
	// 				            	 <a href='#' data-toggle='collapse' data-target='#".$properties->descripcion."' class='collapse active'>
	// 					            	 <i class='$properties->icono'></i>
	// 					            	 <span class='nav-label'>$properties->descripcion</span>
	// 					            	 <i class='fa fa-chevron-left pull-right'></i>
	// 				            	 </a>
	// 				            	 $sub
	//             	 		   </li>";
	            	
	//             }
	//             else
	//             {

	//             	if($properties->controlador != "" )
	//             	{
	//             		$url = base_url().$properties->controlador;
	//             	}
	//             	else
	//             	{
	//             		$url = "#";
	//             	}

	//             	$menu .= "<li><a href='".$url."'><i class='".$properties->icono."'></i>$properties->descripcion</a></li>";
	//             }
            		
            		     			                          

	// 	  }
		

	// 	return $menu . "</ul>";

	// }



}

?>