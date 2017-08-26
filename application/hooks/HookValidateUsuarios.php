<?php 

class HookValidarDatosUsuario
{

	function __construct()
	{
		$this->ci =& get_instance();
	}


	 function validarUsuarios()
	{
	
		$controlador = $this->ci->router->class;
		$funcion = $this->ci->router->method;

		//echo $controlador;
		//echo $this->ci->session->userdata('logueado');
		
		// primero verificamos si el usuario esta logueado 

		if($controlador == 'Login')
		{
			if($this->ci->session->userdata('logueado') === true)
			{
				echo "entro a home";
				//exit();
				redirect('Home');
				exit();
			
			}
		}
		else
		{
			//exit();
			if($this->ci->session->userdata('logueado') === null)
			{
				if( $this->ci->input->is_ajax_request())
				{

					$datos["baja"]=true;
					$datos["url"]= base_url()."Login";

					echo json_encode($datos);

					//redirect(, 'location', 302);
					
					exit();
					
				}
				else
				{
					redirect('Login');
					exit();
					
				}
				
			}
	
		}


		// Verificar si el usuario esta dado de alta 

		// if($controlador != 'Login' && $this->ci->session->userdata('logueado') === true)
		// {
		// 	$this->ci->load->model('Home/VerificarUsuarioActivo');

		// 	$datosMenu = $this->ci->VerificarUsuarioActivo->verificarUserActivo($this->ci->session->userdata('id_usuario'));

		// 	if($datosMenu == 0)
		// 	{
		// 		if( $this->ci->input->is_ajax_request())
		// 		{
		// 			$this->ci->session->sess_destroy();

		// 			$datos["baja"]=true;
		// 			$datos["url"]= base_url()."Login";
		// 			echo json_encode($datos);
					
		// 			exit();
		// 		}
		// 		else
		// 		{
					
		// 			$this->ci->session->sess_destroy();
		// 			redirect('/Login');
		// 			exit();
		// 		}


				
		// 	}
			



		// }

		

		// verificar si el usuario tiene permisos de acuerdo a su rol para visualizar tales elementos del menú

		if($this->ci->session->userdata('id_rol') != null)
		{

			$id_rol = $this->ci->session->userdata('id_rol');
			$controladores_rol ="";
			$controladorPermitido = false;

			$this->ci->load->model('Home/VerificarControladoresRol');

			$datos = $this->ci->VerificarControladoresRol->VerifyControlesRol($this->ci->session->userdata('id_rol'));

			// echo var_dump($datos);
			// exit();

			if($datos["msjCantidadRegistros"] > 0)
			{
				$controladores_rol = explode(",", $datos["controllers"][0]->controladores);
				$controladorPermitido = in_array($controlador,$controladores_rol);
			}
			else
			{
				$controladores_rol = array();
				$controladorPermitido = in_array($controlador,$controladores_rol);
			}
			//var_dump($datos["controllers"][0]->controladores);
			
			 //exit();

		
			if($controlador != "AccesoDenegado")
			{
				if($controladorPermitido==false)
				{
					redirect('/AccesoDenegado',$datosControles);
				}
			}
			
		
		}
		
		
	



	}
}


?>