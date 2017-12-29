<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Model_FechasPagosPolizas extends CI_Model
	{

		public function __construct()
		{
			parent::__construct();
		}

		public function colocarFechasPagos($fecha_inicial,$IdFormaDePago)
		{

			if($IdFormaDePago == '1')  // anual
			{
				$sql = "select 	DATE_FORMAT( DATE_ADD('".$fecha_inicial."', INTERVAL +1 MONTH) , '%d/%m/%Y') AS fechaPago0,
								DATE_FORMAT( DATE_ADD('".$fecha_inicial."', INTERVAL +2 MONTH) , '%d/%m/%Y') AS fechaPago1,
								DATE_FORMAT( DATE_ADD('".$fecha_inicial."', INTERVAL +3 MONTH) , '%d/%m/%Y') AS fechaPago2,
								DATE_FORMAT( DATE_ADD('".$fecha_inicial."', INTERVAL +4 MONTH) , '%d/%m/%Y') AS fechaPago3,
						        DATE_FORMAT( DATE_ADD('".$fecha_inicial."', INTERVAL +5 MONTH) , '%d/%m/%Y') AS fechaPago4,
						        DATE_FORMAT( DATE_ADD('".$fecha_inicial."', INTERVAL +6 MONTH) , '%d/%m/%Y') AS fechaPago5,
						        DATE_FORMAT( DATE_ADD('".$fecha_inicial."', INTERVAL +7 MONTH) , '%d/%m/%Y') AS fechaPago6,
						        DATE_FORMAT( DATE_ADD('".$fecha_inicial."', INTERVAL +8 MONTH) , '%d/%m/%Y') AS fechaPago7,
						        DATE_FORMAT( DATE_ADD('".$fecha_inicial."', INTERVAL +9 MONTH) , '%d/%m/%Y') AS fechaPago8,
						        DATE_FORMAT( DATE_ADD('".$fecha_inicial."', INTERVAL +10 MONTH) , '%d/%m/%Y') AS fechaPago9,
						        DATE_FORMAT( DATE_ADD('".$fecha_inicial."', INTERVAL +11 MONTH) , '%d/%m/%Y') AS fechaPago10,
						        DATE_FORMAT( DATE_ADD('".$fecha_inicial."', INTERVAL +12 MONTH) , '%d/%m/%Y') AS fechaPago11" ;


									        
			}
			else if($IdFormaDePago == '2')  // semestral
			{

				$sql = "select 	DATE_FORMAT( DATE_ADD('".$fecha_inicial."', INTERVAL +6 MONTH) , '%d/%m/%Y') AS fechaPago0,
								DATE_FORMAT( DATE_ADD('".$fecha_inicial."', INTERVAL +12 MONTH) , '%d/%m/%Y') AS fechaPago1 ";

			}
			else  // trimestral
			{
				$sql = "select 	DATE_FORMAT( DATE_ADD('".$fecha_inicial."', INTERVAL +3 MONTH) , '%d/%m/%Y') AS fechaPago0,
								DATE_FORMAT( DATE_ADD('".$fecha_inicial."', INTERVAL +6 MONTH) , '%d/%m/%Y') AS fechaPago1, 
								DATE_FORMAT( DATE_ADD('".$fecha_inicial."', INTERVAL +9 MONTH) , '%d/%m/%Y') AS fechaPago2, 
								DATE_FORMAT( DATE_ADD('".$fecha_inicial."', INTERVAL +12 MONTH) , '%d/%m/%Y') AS fechaPago3 ";
			}

			

			$query = $this->db->query($sql);		


			$resultado_query = array(
											'msjCantidadRegistros'=> 0,
											'fechaPagos'=> array(),
											 'status' => '',
											 'mensaje' => ''
										);


			if($query)
			{

				if($query->num_rows()>0)
				{
					$resultado_query['msjCantidadRegistros'] = $query->num_rows();
					$resultado_query['fechaPagos'] = $query->result(); 
					$resultado_query['status'] = 'OK'; 
					$resultado_query['mensaje'] = 'información obtenida';

			
				}
				else
				{
					$resultado_query['msjCantidadRegistros'] = $query->num_rows();
					$resultado_query['fechaPagos'] = $query->result(); 
					$resultado_query['status'] = 'Sin datos';
					$resultado_query['mensaje'] = 'No hay registros'; 
				}

			}
			else{
					$resultado_query['status'] = 'ERROR'; 
					$resultado_query['mensaje'] = 'Ocurrió un error en la base de datos porfavor recargue la pagina e intente de nuevo'; 
			}
			
			
			return $resultado_query;

		}


	}