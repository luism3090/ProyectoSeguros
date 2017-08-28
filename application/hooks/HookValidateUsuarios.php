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
		$method = $this->ci->router->method;

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
		

		// verificar si el usuario tiene permisos de acuerdo a su rol para visualizar tales elementos del menú

		if($this->ci->session->userdata('id_rol') != null)
		{

			$id_rol = $this->ci->session->userdata('id_rol');
			$controladores_rol ="";
			$controladorPermitido = false;

			$this->ci->load->model('Home/VerificarControladoresRol');

			$datos = $this->ci->VerificarControladoresRol->VerifyControlesRol($this->ci->session->userdata('id_rol'));


			 // echo $method;
			 // exit();

			// if($controlador=="Polizas")
			// {
			// 	$controlador = $controlador."/".$method;
			// }
			 
			 

			if($datos["msjCantidadRegistros"] > 0)
			{

				//var_dump($datos["controllers"][0]->controladores);



				
				$controladores_rol = explode(",", $datos["controllers"][0]->controladores);

				foreach ($controladores_rol as $key => $controlBD)
				 {
					
					if(stripos($controlBD,"/"))
					{
						$indexDiagonal = stripos($controlBD,"/");
						$controladores_rol[$key] = substr($controlBD,0,$indexDiagonal);

					}
					else
					{
						$controladores_rol[$key] == $controlBD;
					}

				}

				// var_dump($controladores_rol);
				// exit();
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

				// var_dump($controladorPermitido);
				// var_dump($controlador);

				// exit();

				if($controladorPermitido===false)
				{
					// echo "b";
					// exit();
					redirect('/AccesoDenegado',$datosControles);
				}
				
				
			}
			
		
		}
		
		
	



	}
}


?>