<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class EnviarEmailForgotPassword extends CI_Model
	{
		public function __construct()
		{
			parent::__construct();
		}


		public function enviarMailUsuario($email,$id_usuario)
		{

			$this->db->trans_begin();

			$sql1 =	"select 
							ufp.id_usuario,
							token 
					from usuarios usu
						join users_forgot_passwords ufp on(usu.id_usuario = ufp.id_usuario)
						where usu.id_usuario = ? ";

				$query = $this->db->query($sql1,array($id_usuario));


				$CantRows = $query->num_rows(); 

				if($CantRows > 0)
				{
					
					$sql2 =	"delete from users_forgot_passwords where id_usuario = ? ";

					$query = $this->db->query($sql2,array($id_usuario));

					
				}

				$token = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',80)),0,80);

					
					$sql3 =	"insert into users_forgot_passwords (id_usuario,token) 
								 			values (?,?)";

					$query = $this->db->query($sql3,array($id_usuario,$token));


				
					if ($this->db->trans_status() === FALSE)
					{	
						$datos = array( "msjCantidadRegistros" => 1, 
										"msjConsulta" => 'Error',
										"id_usuario" => $id_usuario, 
										"email" => $email, 
										"token" => $token);

					        $this->db->trans_rollback();
					}
					else
					{
						
						$datos = array( "msjCantidadRegistros" => 1, 
										"msjConsulta" => 'OK',
										"id_usuario" => $id_usuario,
										"email" => $email,  
										"token" => $token);

					    $this->db->trans_commit();
					}

				return $datos;


		}



	}
?>