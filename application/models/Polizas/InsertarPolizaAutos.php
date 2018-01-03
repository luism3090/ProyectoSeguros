<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class InsertarPolizaAutos extends CI_Model
	{
		public function __construct()
		{
			parent::__construct();
		}


		public function insertPolizaAutos($datosPoliza,$datosPolizaAuto,$datosPolizaPrima,$datosPagos)
		{

			$this->db->trans_begin();


			// guardar datos en la tabla general de polizas

			$sql1 = "insert into polizas (
											id_poliza,
											id_aseguradora,
											id_usuario,
											id_tipo_poliza,
											no_poliza,
											descripcion,
											fecha_inicia,
											fecha_finaliza,
											suma_asegurada,
											valor_comercial,
											fecha_registro
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
											now()
										)
										
					";

			$query = $this->db->query($sql1,array(
												 $datosPoliza["id_aseguradora"],
												 $datosPoliza["id_usuario"],
												 $datosPoliza["id_tipo_poliza"],
												 $datosPoliza["no_poliza"],
												 $datosPoliza["descripcion"],
												 $datosPoliza["fecha_inicia"],
												 $datosPoliza["fecha_finaliza"],
												 $datosPoliza["suma_asegurada"],
												 $datosPoliza["valor_comercial"]
												 )
									  );



			// obtener el ultimo id insertado de poliza 

			$sql2 = "select id_poliza FROM polizas order by fecha_registro desc limit 0,1" ;
			$query = $this->db->query($sql2);

			$id_poliza = $query->result()[0]->id_poliza;


			// insertando en la tabla de polizas de autos 

			$sql3 = "insert into poliza_datos_autos (
														id_poliza_datos_autos,
														id_poliza,
														marca,
														modelo,
														anio,
														no_serie,
														placas
													) 
													values 
													(
													 	null,
													 	?,
													 	?,
													 	?,
													 	?,
													 	?,
													 	?
													)

					"; 

			$query = $this->db->query($sql3,array($id_poliza,
												 $datosPolizaAuto["marca"],
												 $datosPolizaAuto["modelo"],
												 $datosPolizaAuto["anio"],
												 $datosPolizaAuto["no_serie"],
												 $datosPolizaAuto["placas"]
												 )
									  );



			$sql3 = "insert into poliza_datos_prima (
														id_poliza_datos_prima,
														id_poliza,
														id_forma_pago,
														pago_total,
														id_moneda,
														id_medio_pago,
														prima_neta_anual,
														descuento,
														iva,
														pago_prima_descuento
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
													 	?
													)

					"; 

			$query = $this->db->query($sql3,array($id_poliza,
												 $datosPolizaPrima["id_forma_pago"],
												 $datosPolizaPrima["pago_total"],
												 $datosPolizaPrima["id_moneda"],
												 $datosPolizaPrima["id_medio_pago"],
												 $datosPolizaPrima["prima_neta_anual"],
												 $datosPolizaPrima["descuento"],
												 $datosPolizaPrima["iva"],
												 $datosPolizaPrima["pago_prima_descuento"]
												 )
									  );


			for($x = 0; $x < count($datosPagos); $x++)
			{
				

				$sql3 = "insert into poliza_datos_forma_pagos (
															
															id_poliza,
															cantidad_pago,
															pagado
															
														) 
														values 
														(
														 	?,
														 	?,
														 	null
														)

						"; 

				$query = $this->db->query($sql3,array($id_poliza,
													 	$datosPagos[$x]["cantidad_pago"]
													 )
										  );
				
			}


				
			if ($this->db->trans_status() === FALSE)
				{
						$datos["msjConsulta"] = "Error";

				        $this->db->trans_rollback();
				}
				else
				{
					$datos["msjConsulta"] = "OK";

				    $this->db->trans_commit();
				}

			return $datos;

		}


	}

	


?>