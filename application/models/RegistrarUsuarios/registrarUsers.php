<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class RegistrarUsers extends CI_Model
	{
		public function __construct()
		{
			parent::__construct();
		}


		public function verificarEmail($email)
		{

			
			$sql = "select * from usuarios
					where email = ? ";


			$query = $this->db->query($sql,array($email));



			$datos = array("msjCantidadRegistros" => 0, "msjNoHayRegistros" => '',"usuario" => array());

			$datos["msjCantidadRegistros"] = $query->num_rows(); 

				if($datos["msjCantidadRegistros"] > 0)
				{
					$datos["usuario"] = $query->result(); 
				}
				else{
					$datos["msjNoHayRegistros"] = "No hay registros";
				}


				return $datos;


		}


		public function insertUsers($nombre,$apellidos,$email,$password,$id_rol,$files)
		{

			$nombreAleatorio = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',80)),0,80);

			$ruta = $_SERVER['DOCUMENT_ROOT']."/PhpCodeigniterPractica/public/uploads/";

			$nombreOriginal = "";

			foreach ( $files as $key) 
			{

			 //    return $files;
				// exit();

				if($key['error'] == UPLOAD_ERR_OK)
				{
					//$nombreOriginal = $key["name"];
					$tipoImage = explode("/", $key['type']);
					$nombreOriginal = $nombreAleatorio.".".$tipoImage[1];
					$temporal = $key["tmp_name"];
					//$temporal = $nombreAleatorio;
					$destino = $ruta.$nombreOriginal;

					//return $destino;



					$subir = move_uploaded_file($temporal, $destino);

					

				}


			}

			$foto = "default_avatar.png";

			if($nombreOriginal != "")
			{
				$foto = $nombreOriginal;
			}
			
		
			$this->db->trans_begin();

			
			$sql_insert_usuario = "insert into usuarios ( 
											id_usuario,
											nombre,
											apellidos,
											email,
											password,
											fecha_registro,
											fecha_actualizacion,
											estado,
											foto
										) 
										values 
										(
											null,
											?,
											?,
											?,
											?,
											now(),
											null,
											1,
											'".$foto."'
										)
				   ";

			$query_insert_usuario = $this->db->query($sql_insert_usuario,array($nombre,$apellidos,$email,$password));




			$sql_get_Id_ultimo_usuario = "select id_usuario from 
															usuarios 
										   order by fecha_registro desc limit 0,1";

			$query_Id_ultimo_usuario = $this->db->query($sql_get_Id_ultimo_usuario);


			$id_usuario = "";

				foreach ($query_Id_ultimo_usuario->result_array() as $row)
				{
				        $id_usuario = $row['id_usuario'];
				       
				}


			$sql_insert_usuarios_roles = "insert into usuarios_roles( 
																		id_usuario,
																		id_rol
																	) 
																	values 
																	(
																		?,
																		?
																	)
				  						 ";

			$query_insert_usuarios_roles = $this->db->query($sql_insert_usuarios_roles,array($id_usuario,$id_rol));



			$datos = array("msjConsulta" => '' , "base_url" => base_url()."index.php/Usuarios");


			if ($this->db->trans_status() === FALSE)
				{
						$datos["msjConsulta"] = "Falló al ingresar el usuario intente de nuevo";

				        $this->db->trans_rollback();
				}
				else
				{
					$datos["msjConsulta"] = "El usuario ha sido registrado correctamente";

				    $this->db->trans_commit();
				}

			return $datos;


		}






	}

	


?>