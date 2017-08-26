<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class VerificarUsuarioActivo extends CI_Model
	{
		public function __construct()
		{
			parent::__construct();
		}


		public function verificarUserActivo($id_usuario)
		{

			

			$sql =	"select * from usuarios 
					where id_usuario = ? and estado = 1";

					$query = $this->db->query($sql,array($id_usuario));


			return $query->num_rows();


		}



	}
?>