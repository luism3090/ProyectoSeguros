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

		public function cargarSelectFormaPago()
		{

			$sql = "select id_forma_pago,nombre FROM cat_forma_pago order by nombre";

			$query = $this->db->query($sql);		
			
			return $query->result();

		}


		public function cargarSelectMoneda()
		{

			$sql = "select id_moneda,nombre FROM cat_moneda order by id_moneda";

			$query = $this->db->query($sql);		
			
			return $query->result();

		}


		public function cargarSelectMedioPago()
		{

			$sql = "select id_medio_pago, nombre FROM cat_medio_pago order by id_medio_pago";

			$query = $this->db->query($sql);		
			
			return $query->result();

		}


		public function cargarSelectPais()
		{

			$sql = "select id_pais,nombre FROM cat_paises order by nombre";

			$query = $this->db->query($sql);		
			
			return $query->result();

		}



	}

	


?>