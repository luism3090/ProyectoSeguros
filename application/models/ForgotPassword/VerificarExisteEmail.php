<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class VerificarExisteEmail extends CI_Model
	{
		public function __construct()
		{
			parent::__construct();
		}


		public function verifyExistsEmail($email)
		{


			$sql1 =	"select 
							id_usuario,
							email 
					from usuarios 
							where email = ? ";

					$query = $this->db->query($sql1,array($email));


			   $datos = array("msjCantidadRegistros" => 0, "msjNoHayRegistros" => '' ,"usuario" => array());


				$datos["msjCantidadRegistros"] = $query->num_rows(); 

				if($datos["msjCantidadRegistros"] > 0)
				{
					$datos["usuario"] = $query->result();
					$datos["msjNoHayRegistros"] = "Correcto.";
				}
				else
				{
					$datos["msjNoHayRegistros"] = "<p>No existe una cuenta de usuario con ese email</p>";
				}


				return $datos;


		}



	}
?>