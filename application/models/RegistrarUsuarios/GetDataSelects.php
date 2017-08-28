<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class GetDataSelects extends CI_Model
	{
		public function __construct()
		{
			parent::__construct();
		}


		public function getDataSelectRFC()
		{

			$sql = "select * from cat_RFC";

			$query = $this->db->query($sql);		
			
			return $query->result();

		}

		public function getDataSelectEstado()
		{

			$sql = "select id_estado,clave,nombre from cat_estados order by nombre";

			$query = $this->db->query($sql);		
			
			return $query->result();

		}

		public function getDataSelectMunicipios($id_estado)
		{


			$sql = "select id_municipio,id_estado,nombre from cat_municipios where id_estado = ? order by nombre";

			$query = $this->db->query($sql,array($id_estado));		
			
			return $query->result();

		}

		public function getDataSelectLocalidades($id_municipio)
		{


			$sql = "select id_localidad,id_municipio,clave,nombre from cat_localidades where id_municipio = ? order by nombre";

			$query = $this->db->query($sql,array($id_municipio));		
			
			return $query->result();

		}

		public function getDataSelectUsuarios()
		{

			$sql = "select id_rol,descripcion as nombre FROM cat_roles order by id_rol desc";

			$query = $this->db->query($sql);		
			
			return $query->result();

		}



	}

	


?>