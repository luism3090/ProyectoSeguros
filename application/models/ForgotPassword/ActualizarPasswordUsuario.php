<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class ActualizarPasswordUsuario extends CI_Model
	{
		public function __construct()
		{
			parent::__construct();
		}


		public function updatePasswordUsuario($password,$token)
		{

			$this->db->trans_begin();

			$sql1 =	"select 
							id_usuario,
							token 
					from users_forgot_passwords where token = ? ";

				$query = $this->db->query($sql1,array($token));


				$CantRows = $query->num_rows(); 

				$id_usuario = "";

				if($CantRows > 0)
				{
					
					$id_usuario = $query->result()[0]->id_usuario;

					$sql2 =	"update usuarios set password = ? where id_usuario = ? ";

					$query = $this->db->query($sql2,array($password,$id_usuario));

					$sql3 =	"delete from users_forgot_passwords where id_usuario = ? ";

					$query = $this->db->query($sql3,array($id_usuario));

					
				}


				if ($this->db->trans_status() === FALSE)
				{	
					$datos = array( "msjConsulta" => 'Error',
									"msjUsuario" => 'Ocurrio un error al cambiar tu contraseña, por favor intenta de nuevo',
									"id_usuario" => $id_usuario, 
									"token" => $token);

				        $this->db->trans_rollback();
				}
				else
				{
					
					$datos = array( "msjConsulta" => 'OK',
									"msjUsuario" => 'Tu contraseña ha sido cambiada correctamente',
									"id_usuario" => $id_usuario, 
									"base_url" => base_url()."index.php/Login",
									"token" => $token);

				    $this->db->trans_commit();
				}
				
					
				return $datos;


		}



	}
?>