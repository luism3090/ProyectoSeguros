<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class RegistrarUsers extends CI_Model
	{
		public function __construct()
		{
			parent::__construct();
		}


		public function verificarEmail($correo)
		{

			
			$sql = "select * from usuarios
					where correo = ? ";


			$query = $this->db->query($sql,array($correo));



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


		public function insertUsers($nombre,$apellido_paterno,$apellido_materno,$id_rfc,$telefono,$celular,$id_estado,$id_municipio,$id_localidad,$domicilio,$colonia,$numero,$correo,$correo_corporativo,$password,$id_rol)
		{
		
			$this->db->trans_begin();

			
			$sql_insert_usuario = "insert into usuarios ( 
											id_usuario,
											nombre,
											apellido_paterno,
											apellido_materno,
											id_rfc,
											telefono,
											celular,
											id_estado,
											id_municipio,
											id_localidad,
											domicilio,
											colonia,
											numero,
											correo,
											correo_corporativo,
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
											?,
											?,
											?,
											?,
											?,
											?,
											?,
											?,
											?,
											?,
											?,
											now(),
											null,
											1,
											'default.png'
										)
				   ";

			$query_insert_usuario = $this->db->query($sql_insert_usuario,array($nombre,$apellido_paterno,$apellido_materno,$id_rfc,$telefono,$celular,$id_estado,$id_municipio,$id_localidad,$domicilio,$colonia,$numero,$correo,$correo_corporativo,$password));


			$sql_get_Id_ultimo_usuario = "select id_usuario from 
															usuarios 
										   order by fecha_registro desc limit 0,1";

			$query_Id_ultimo_usuario = $this->db->query($sql_get_Id_ultimo_usuario);


			$id_usuario = "";

			foreach ($query_Id_ultimo_usuario->result_array() as $row)
			{
			    $id_usuario = $row['id_usuario'];
			}


			$sql_insert_usuarios_roles = "insert into rel_usuarios_roles( 
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



			$datos = array("msjConsulta" => '' , "base_url" => base_url()."Usuarios");


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