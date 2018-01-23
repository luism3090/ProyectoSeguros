<?php 
	class Model_PolizaDigital extends CI_Model
	{
		public function __construct()
		{
			parent::__construct();
		}


		public function uploadPolizaDigitalCliente($id_usuario,$id_poliza,$files)
		{

				$this->db->trans_begin();

				$sql = "select pdf_poliza from rel_polizas_pdf_clientes where id_usuario = ? and id_poliza = ? ";


				$query = $this->db->query($sql,array($id_usuario,$id_poliza));


						if(!empty($files))
						{
								$nombreAleatorio = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',20)),0,20);

								$ruta = $_SERVER['DOCUMENT_ROOT']."/Seguros/public/uploads/";

								$nombreOriginal = "";

								$nombreMejorado = "";

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
							

						}



					if($query->num_rows() > 0)
					{
						
						$pdf_poliza = $query->result()[0]->pdf_poliza;

						$rutaFileEliminar = "./public/uploads/".$pdf_poliza;

						unlink($rutaFileEliminar);

						$sql = "update rel_polizas_pdf_clientes 
													set pdf_poliza = ? 
										where 		id_usuario = ? 
													and id_poliza = ? ";

							$query = $this->db->query($sql,array($nombreMejorado,$id_usuario,$id_poliza));
					}
					else
					{
							$sql = "insert into rel_polizas_pdf_clientes 
																			(
																			  id_rel_polizas_pdf_clientes,
																			  id_usuario,
																			  id_poliza,
																			  pdf_poliza
																			)
																			values 
																			(
																			  null,
																			  ?,
																			  ?,
																			  ?
																			) ";

							$query = $this->db->query($sql,array($id_usuario,$id_poliza,$nombreMejorado));
					}

				

				if ($this->db->trans_status() === FALSE)
				{

						$datos["status"] = "ERROR";
						$datos["msjConsulta"] = "Falló al actualizar los datos del usuario intente de nuevo";

				        $this->db->trans_rollback();
				}
				else
				{
					$datos["status"] = "OK";
					$datos["msjConsulta"] = "La poliza digital del cliente fue subida correctamente";


				    $this->db->trans_commit();
				}

			    return $datos;

		}



		public function getDatosPolizasCliente($id_usuario)
		{
				
				$this->db->trans_begin();


				$sql = "select 	distinct
									po.id_poliza,
									po.no_poliza,
									cfp.nombre as formaPago,
									ctp.nombre as tipoPoliza, 
									DATE_FORMAT(po.fecha_inicia,'%d/%m/%Y') as fecha_inicia, 
									DATE_FORMAT(po.fecha_finaliza,'%d/%m/%Y') as fecha_finaliza,
									ca.nombre as aseguradora,
							        rpdc.pdf_poliza,
							        '<button  type=''button'' class=''btn btn-primary btnSubirPolizas''> <span class=''glyphicon glyphicon-upload''></span> </button>' as SubirPolizas,
							        CONCAT(usu.nombre, ' ', usu.apellido_paterno , ' ', usu.apellido_materno) as cliente
							from polizas po 
							join poliza_datos_prima pdp on (po.id_poliza = pdp.id_poliza)
							join poliza_datos_forma_pagos pdf on (po.id_poliza = pdf.id_poliza) 
							join cat_forma_pago cfp on (pdp.id_forma_pago = cfp.id_forma_pago)
							join usuarios usu on (po.id_usuario = usu.id_usuario)
							join cat_tipo_poliza ctp on (po.id_tipo_poliza = ctp.id_tipo_poliza)
							join cat_aseguradoras ca on (po.id_aseguradora = ca.id_aseguradora)
							left join rel_polizas_pdf_clientes rpdc on (rpdc.id_usuario = usu.id_usuario and po.id_poliza = rpdc.id_poliza)
							where usu.id_usuario = ? ";


				$query = $this->db->query($sql,array($id_usuario));

				if ($this->db->trans_status() === FALSE)
				{

						$datos["status"] = "ERROR";
						$datos["msjConsulta"] = "Falló al actualizar los datos del usuario intente de nuevo";

				        $this->db->trans_rollback();
				}
				else
				{
					$datos["polizasCliente"] = $query->result();
					$datos["status"] = "OK";
					$datos["msjConsulta"] = "Mostrando informacion de las polizas";


				    $this->db->trans_commit();
				}

			    return $datos;

		}

	}
?>