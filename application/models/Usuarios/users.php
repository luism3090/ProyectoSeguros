<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Users extends CI_Model
	{
		public function __construct()
		{
			parent::__construct();
		}


		public function obtenerUsuariosAlta($request,$id_usuario)
		{

					$requestData= $request;

					$columna = $requestData['order'][0]["column"]+1;
					$ordenacion = $requestData['order'][0]["dir"];

					


					
					$sqlUsuariosAlta =	"select 
											usu.id_usuario,
											rol.id_rol,
											usu.nombre,
											usu.apellidos,
											usu.email,
											usu.fecha_registro,
											rol.descripcion as tipoUsuario,
											'<button  type=''button'' class=''btn btn-primary updateUsersAlta''> <span class=''glyphicon glyphicon-pencil''></span> </button>' as modificar,
											'<button  type=''button'' class=''btn btn-danger bajaUsersAlta''> <span class=''glyphicon glyphicon-circle-arrow-down''></span> </button>' as eliminar,
											'<button  type=''button'' class=''btn btn-success sendEmailUser''> <span class=''glyphicon glyphicon-envelope''></span> </button>' as EnviarEmail 
											from usuarios usu
											join usuarios_roles usu_ro on (usu.id_usuario = usu_ro.id_usuario)
											join roles rol on (usu_ro.id_rol = rol.id_rol) 
											where usu.id_usuario not in(".$id_usuario.",1) and usu.estado = 1 
											order by ".$columna." ".$ordenacion." ";

					

					//$query1 = $this->db->query($sql1,array($id_usuario));
					$query = $this->db->query($sqlUsuariosAlta);

					//$this->db->query($sql, array(array(3, 6), 'live', 'Rick') );

					$totalData = $query->num_rows();
					$totalFiltered = $totalData;

					if( !empty($requestData['search']['value']) ) 
					{   

						

						$sqlUsuariosAlta = "select 
													usu.id_usuario,
													rol.id_rol,
													usu.nombre,
													usu.apellidos,
													usu.email,
													usu.fecha_registro,
													usu.fecha_actualizacion,
													rol.descripcion as tipoUsuario,
													'<button  type=''button'' class=''btn btn-primary updateUsersAlta''> <span class=''glyphicon glyphicon-pencil''></span> </button>' as modificar,
												    '<button  type=''button'' class=''btn btn-danger bajaUsersAlta''> <span class=''glyphicon glyphicon-circle-arrow-down''></span> </button>' as eliminar,
												    '<button  type=''button'' class=''btn btn-success sendEmailUser''> <span class=''glyphicon glyphicon-envelope''></span> </button>' as EnviarEmail 
													from usuarios usu
													join usuarios_roles usu_ro on (usu.id_usuario = usu_ro.id_usuario)
													join roles rol on (usu_ro.id_rol = rol.id_rol)
													 where usu.id_usuario not in(".$id_usuario.",1) and usu.estado = 1  and 
													 ( 
																		 usu.nombre like '%".$this->db->escape_str($requestData['search']['value'])."%' or  
																		 usu.apellidos like '%".$this->db->escape_str($requestData['search']['value'])."%' or 
																		 usu.email like '%".$this->db->escape_str($requestData['search']['value'])."%' or 
																		 usu.fecha_registro like '%".$this->db->escape_str($requestData['search']['value'])."%' or
																		 rol.descripcion like '%".$this->db->escape_str($requestData['search']['value'])."%' 
													 ) order by ".$columna." ".$ordenacion." ";

					

						$query = $this->db->query($sqlUsuariosAlta);


						$totalFiltered = $query->num_rows(); 
						

					}

					$limit = " LIMIT ".$this->db->escape_str($requestData['start'])." ,".$this->db->escape_str($requestData['length'])." ";
		            $sqlUsuariosAlta .= $limit;
		                
		            $query = $this->db->query($sqlUsuariosAlta);



		            $data = array();

							foreach ($query->result_array() as $row)
							{ 
								$nestedData=array();

							    $nestedData[] = $row["id_usuario"];
							    $nestedData[] = $row["id_rol"];
								$nestedData[] = $row["nombre"];
								$nestedData[] = $row["apellidos"];
								$nestedData[] = $row["email"];
								$nestedData[] = $row["fecha_registro"];
								$nestedData[] = $row["tipoUsuario"];
								$nestedData[] = $row["modificar"];
								$nestedData[] = $row["eliminar"];
								$nestedData[] = $row["EnviarEmail"];

								$data[] = $nestedData;
							}


				$json_data = array(
					"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
					"recordsTotal"    => intval( $totalData ),  // total number of records
					"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
					"data"            => $data  // total data array
					);


				return $json_data;


			
		}



		public function obtenerUsuariosBaja($request,$id_usuario)
		{

					$requestData= $request;


					$columna = $requestData['order'][0]["column"]+1;
					$ordenacion = $requestData['order'][0]["dir"];
					
					$sqlUsuariosBaja =	"select 
											usu.id_usuario,
											rol.id_rol,
											usu.nombre,
											usu.apellidos,
											usu.email,
											usu.fecha_registro,
											rol.descripcion as tipoUsuario,
											'<button  type=''button'' class=''btn btn-primary usersBajaAlta''> <span class=''glyphicon glyphicon-circle-arrow-up''></span> </button>' as alta 
											from usuarios usu
											join usuarios_roles usu_ro on (usu.id_usuario = usu_ro.id_usuario)
											join roles rol on (usu_ro.id_rol = rol.id_rol) 
											where usu.id_usuario not in(".$id_usuario.",1) and usu.estado = 0
											order by ".$columna." ".$ordenacion." ";

					$query = $this->db->query($sqlUsuariosBaja);
					$totalData = $query->num_rows();
					$totalFiltered = $totalData;

					if( !empty($requestData['search']['value']) ) 
					{   

						$sqlUsuariosBaja = "select 
													usu.id_usuario,
													rol.id_rol,
													usu.nombre,
													usu.apellidos,
													usu.email,
													usu.fecha_registro,
													rol.descripcion as tipoUsuario,
													'<button  type=''button'' class=''btn btn-primary usersBajaAlta''> <span class=''glyphicon glyphicon-circle-arrow-up''></span> </button>' as alta
													from usuarios usu
													join usuarios_roles usu_ro on (usu.id_usuario = usu_ro.id_usuario)
													join roles rol on (usu_ro.id_rol = rol.id_rol)
													 where usu.id_usuario not in(".$id_usuario.",1) and usu.estado = 0 and 
													 ( 
																		 usu.nombre like '%".$this->db->escape_str($requestData['search']['value'])."%' or  
																		 usu.apellidos like '%".$this->db->escape_str($requestData['search']['value'])."%' or 
																		 usu.email like '%".$this->db->escape_str($requestData['search']['value'])."%' or 
																		 usu.fecha_registro like '%".$this->db->escape_str($requestData['search']['value'])."%' or
																		 rol.descripcion like '%".$this->db->escape_str($requestData['search']['value'])."%' 
													 ) order by ".$columna." ".$ordenacion." ";


											
						$query = $this->db->query($sqlUsuariosBaja);
						$totalFiltered = $query->num_rows(); 
						

					}

					$limit = " LIMIT ".$this->db->escape_str($requestData['start'])." ,".$this->db->escape_str($requestData['length'])." ";
		            $sqlUsuariosBaja .= $limit;
		                
		            $query = $this->db->query($sqlUsuariosBaja);



		            $data = array();

							foreach ($query->result_array() as $row)
							{ 
								$nestedData=array();

							    $nestedData[] = $row["id_usuario"];
							    $nestedData[] = $row["id_rol"];
								$nestedData[] = $row["nombre"];
								$nestedData[] = $row["apellidos"];
								$nestedData[] = $row["email"];
								$nestedData[] = $row["fecha_registro"];
								$nestedData[] = $row["tipoUsuario"];
								$nestedData[] = $row["alta"];

								$data[] = $nestedData;
							}


				$json_data = array(
					"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
					"recordsTotal"    => intval( $totalData ),  // total number of records
					"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
					"data"            => $data  // total data array
					);


				return $json_data;


			
		}



		public function obtenerDatosUsuario($id_usuario)
		{
			$sql = "select 
					usu.id_usuario,
					rol.id_rol,
					usu.nombre,
					usu.apellidos,
					usu.email,
					usu.password,
					usu.fecha_registro,
					usu.fecha_actualizacion,
					rol.descripcion as tipoUsuario,
					usu.foto
					from usuarios usu
					join usuarios_roles usu_ro on (usu.id_usuario = usu_ro.id_usuario)
					join roles rol on (usu_ro.id_rol = rol.id_rol)
					where usu.id_usuario = ? and usu.estado = '1'";


			$query = $this->db->query($sql,array($id_usuario));


			$datos = array("msjCantidadRegistros" => 0, "msjNoHayRegistros" => '',"usuario" => array(), "base_url" => base_url()."public/uploads/");

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



		public function actualizarUsuario($id_usuario,$id_rol,$nombre,$apellidos,$email,$password,$cambioImagen,$files)
		{


			$sql1 = "select foto from usuarios where id_usuario = ? and estado = '1' ";

			$query1 = $this->db->query($sql1,array($id_usuario));

			$foto = $query1->result()[0]->foto;

		    if( $cambioImagen == 'SI' && $foto != "default_avatar.png" )
			{
				$rutaFileEliminar = "./public/uploads/".$foto;

				unlink($rutaFileEliminar);

				$foto = "default_avatar.png";

			}

			
			if(!empty($files))
			{
					$nombreAleatorio = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',50)),0,50);

					$ruta = $_SERVER['DOCUMENT_ROOT']."/PhpCodeigniterPractica/public/uploads/";

					$nombreOriginal = "";

					// return $files;
					// exit();

					foreach ( $files as $key) 
					{

						if($key['error'] == UPLOAD_ERR_OK)
						{
							//$nombreOriginal = $key["name"];
							$tipoImage = explode("/", $key['type']);
							$nombreMejorado = $nombreAleatorio.".".$tipoImage[1];
							$temporal = $key["tmp_name"];
							//$temporal = $nombreAleatorio;
							$destino = $ruta.$nombreMejorado;

							//return $destino;

							$subir = move_uploaded_file($temporal, $destino);


						}


					}

					
					
				    $foto = $nombreMejorado;
				

			}

			$this->db->trans_begin();


			$sql1 = "update usuarios set 
						nombre = ?, 
						apellidos = ?,
						email = ? ,
						password = ?,
						fecha_actualizacion = now(),
						foto = ?
					where id_usuario = ? and estado = '1'";


			$query1 = $this->db->query($sql1,array($nombre,$apellidos,$email,$password,$foto,$id_usuario));


			$sql2 = "update usuarios_roles set 
						id_rol = ?
					where id_usuario = ?";


			$query2 = $this->db->query($sql2,array($id_rol,$id_usuario));

			$datos = array("msjConsulta" => '');

					if ($this->db->trans_status() === FALSE)
					{
							$datos["msjConsulta"] = "Falló al actualizar los datos del usuario intente de nuevo";

					        $this->db->trans_rollback();
					}
					else
					{
						$datos["msjConsulta"] = "El usuario ha sido modificado correctamente";


					    $this->db->trans_commit();
					}

				return $datos;

		}



		public function actualizarUsuarioCabecera($id_usuario,$id_rol,$nombre,$apellidos,$email,$password,$cambioImagen,$files)
		{


			$sql1 = "select foto from usuarios where id_usuario = ? and estado = '1' ";

			$query1 = $this->db->query($sql1,array($id_usuario));

			$foto = $query1->result()[0]->foto;

		    if( $cambioImagen == 'SI' && $foto != "default_avatar.png" )
			{
				$rutaFileEliminar = "./public/uploads/".$foto;

				unlink($rutaFileEliminar);

				$foto = "default_avatar.png";

			}

			
			if(!empty($files))
			{
					$nombreAleatorio = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',50)),0,50);

					$ruta = $_SERVER['DOCUMENT_ROOT']."/PhpCodeigniterPractica/public/uploads/";

					$nombreOriginal = "";

					// return $files;
					// exit();

					foreach ( $files as $key) 
					{

						if($key['error'] == UPLOAD_ERR_OK)
						{
							//$nombreOriginal = $key["name"];
							$tipoImage = explode("/", $key['type']);
							$nombreMejorado = $nombreAleatorio.".".$tipoImage[1];
							$temporal = $key["tmp_name"];
							//$temporal = $nombreAleatorio;
							$destino = $ruta.$nombreMejorado;

							//return $destino;

							$subir = move_uploaded_file($temporal, $destino);


						}


					}

					
					
				    $foto = $nombreMejorado;
				

			}


			$this->db->trans_begin();


			$sql1 = "update usuarios set 
						nombre = ?, 
						apellidos = ?,
						email = ? ,
						password = ?,
						fecha_actualizacion = now(),
						foto = ?
					where id_usuario = ? and estado = '1'";


			$query1 = $this->db->query($sql1,array($nombre,$apellidos,$email,$password,$foto,$id_usuario));


			$sql2 = "update usuarios_roles set 
						id_rol = ?
					where id_usuario = ?";


			$query2 = $this->db->query($sql2,array($id_rol,$id_usuario));

			$datos = array("msjConsulta" => '');

					if ($this->db->trans_status() === FALSE)
					{
							$datos["msjConsulta"] = "Falló al actualizar los datos del usuario intente de nuevo";

					        $this->db->trans_rollback();
					}
					else
					{
						$datos["msjConsulta"] = "El usuario ha sido modificado correctamente";

							$this->session->set_userdata('nombre',$nombre);
							$this->session->set_userdata('apellidos',$apellidos);
							$this->session->set_userdata('email',$email);
							$this->session->set_userdata('foto',$foto);

					    $this->db->trans_commit();
					}

				return $datos;

		}



		public function verificarEmail($email,$id_usuario)
		{
			$sql = "select * from usuarios
					where email = ? and id_usuario != ? and estado = '1'";


			$query = $this->db->query($sql,array($email,$id_usuario));


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



		public function obtenerDatosBajaUsuario($id_usuario)
		{
			$sql = "select 
					usu.id_usuario,
					rol.id_rol,
					usu.nombre,
					usu.apellidos,
					usu.email,
					usu.password,
					usu.fecha_registro,
					usu.fecha_actualizacion,
					rol.descripcion as tipoUsuario
					from usuarios usu
					join usuarios_roles usu_ro on (usu.id_usuario = usu_ro.id_usuario)
					join roles rol on (usu_ro.id_rol = rol.id_rol)
					where usu.id_usuario = ? and usu.estado = '1'";


			$query = $this->db->query($sql,array($id_usuario));


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

		public function darDeBajaUsuario($id_usuario)
		{


			$sql = "update usuarios set estado = '0' where id_usuario = ? and estado = '1' ";


			$query = $this->db->query($sql,array($id_usuario));


			$datos = array("msjConsulta" => 0);

			if($query == true)
			{
				$datos["msjConsulta"] = "El usuario ha sido dado de baja correctamente";
			}
			else
			{
				$datos["msjConsulta"] = "Ha ocurrido un error al dar de baja al usuario ";
			}

				return $datos;


		}


		public function obtenerDatosAltaUsuario($id_usuario)
		{
			$sql = "select 
					usu.id_usuario,
					rol.id_rol,
					usu.nombre,
					usu.apellidos,
					usu.email,
					usu.password,
					usu.fecha_registro,
					usu.fecha_actualizacion,
					rol.descripcion as tipoUsuario
					from usuarios usu
					join usuarios_roles usu_ro on (usu.id_usuario = usu_ro.id_usuario)
					join roles rol on (usu_ro.id_rol = rol.id_rol)
					where usu.id_usuario = ? and usu.estado = '0'";


			$query = $this->db->query($sql,array($id_usuario));


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


		public function darDeAltaUsuario($id_usuario)
		{


			$sql = "update usuarios set estado = '1' where id_usuario = ? and estado = '0' ";


			$query = $this->db->query($sql,array($id_usuario));


			$datos = array("msjConsulta" => 0);

			if($query == true)
			{
				$datos["msjConsulta"] = "El usuario ha sido dado de alta correctamente";
			}
			else
			{
				$datos["msjConsulta"] = "Ha ocurrido un error al dar de alta al usuario ";
			}

				return $datos;


		}


	}
?>