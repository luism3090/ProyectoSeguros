<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class CargarSelectsPolizas extends CI_Model
	{
		public function __construct()
		{
			parent::__construct();
		}


		public function cargarSelectStatus()
		{

			$sql = "select id_status,nombre from cat_status order by nombre";

			$query = $this->db->query($sql);		
			
			return $query->result();

		}

		public function cargarSelectTipo()
		{

			$sql = "select id_tipo,nombre from cat_tipo order by nombre";

			$query = $this->db->query($sql);		
			
			return $query->result();

		}

		public function cargarSelectAseguradora()
		{

			$sql = "select id_aseguradora,nombre from cat_aseguradoras order by nombre";

			$query = $this->db->query($sql);		
			
			return $query->result();

		}



	}

	


?>