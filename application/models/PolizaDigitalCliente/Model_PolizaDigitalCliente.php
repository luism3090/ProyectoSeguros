<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Model_PolizaDigitalCliente extends CI_Model
	{
		public function __construct()
		{
			parent::__construct();
		}



		public function cargarClientes($request,$id_usuario)
		{

					$requestData= $request;

					$columna = $requestData['order'][0]["column"]+1;
					$ordenacion = $requestData['order'][0]["dir"];


					$sqlClientes =	"select 
										  usu.id_usuario,
										  CONCAT(usu.nombre , ' ', usu.apellido_paterno,' ',usu.apellido_materno) as nombreCompleto,
										  usu.correo,
										  usu.telefono,
										  rfc.nombre rfc,
										  est.nombre as estado,
										  muni.nombre as municipio,
										  loca.nombre as localidad,
										  '<button  type=''button'' class=''btn btn-primary btnVerPolizas''> <span class=''glyphicon glyphicon-eye-open''></span> </button>' as VerPolizas
										  from usuarios usu
												  join rel_usuarios_roles usu_ro on (usu.id_usuario = usu_ro.id_usuario)
												  join cat_roles rol on (usu_ro.id_rol = rol.id_rol) 
											        join cat_estados est on (usu.id_estado = est.id_estado)
											        join cat_municipios muni on (usu.id_municipio = muni.id_municipio)
											        join cat_localidades loca on (usu.id_localidad = loca.id_localidad)
											        join cat_rfc rfc on (usu.id_rfc = rfc.id_rfc)
											  where usu.estado = 1 and rol.id_rol=3 and usu.id_usuario = ".$id_usuario."
											order by ".$columna." ".$ordenacion." ";

					

					//$query1 = $this->db->query($sql1,array($id_usuario));
					$query = $this->db->query($sqlClientes);

					//$this->db->query($sql, array(array(3, 6), 'live', 'Rick') );

					$totalData = $query->num_rows();
					$totalFiltered = $totalData;

					if( !empty($requestData['search']['value']) ) 
					{   

						

						$sqlClientes = "select 
										id_usuario,
										nombreCompleto,
										correo,
										telefono,
										rfc ,
										estado,
										municipio,
										localidad,
										VerPolizas
										FROM (
										select 
										usu.id_usuario,
										CONCAT(usu.nombre , ' ', usu.apellido_paterno,' ',usu.apellido_materno) as nombreCompleto,
										  usu.correo,
										  usu.telefono,
										  rfc.nombre rfc,
										  est.nombre as estado,
										  muni.nombre as municipio,
										  loca.nombre as localidad,
										  '<button  type=''button'' class=''btn btn-primary btnVerPolizas''> <span class=''glyphicon glyphicon-eye-open''></span> </button>' as VerPolizas
										from usuarios usu
										join rel_usuarios_roles usu_ro on (usu.id_usuario = usu_ro.id_usuario)
										join cat_roles rol on (usu_ro.id_rol = rol.id_rol) 
										join cat_estados est on (usu.id_estado = est.id_estado)
										join cat_municipios muni on (usu.id_municipio = muni.id_municipio)
										join cat_localidades loca on (usu.id_localidad = loca.id_localidad)
										join cat_rfc rfc on (usu.id_rfc = rfc.id_rfc)
										where usu.estado = 1 and rol.id_rol= 3 and usu.id_usuario = ".$id_usuario."
										)AS myTable
										where  
											 ( 
												 nombreCompleto like '%".$this->db->escape_str($requestData['search']['value'])."%' or  
												 correo like '%".$this->db->escape_str($requestData['search']['value'])."%' or 
												 telefono like '%".$this->db->escape_str($requestData['search']['value'])."%' or 
												 rfc like '%".$this->db->escape_str($requestData['search']['value'])."%' or
												 estado like '%".$this->db->escape_str($requestData['search']['value'])."%'  or
												 municipio like '%".$this->db->escape_str($requestData['search']['value'])."%'  or
												 localidad like '%".$this->db->escape_str($requestData['search']['value'])."%'  
										     ) order by ".$columna." ".$ordenacion." ";

					

						$query = $this->db->query($sqlClientes);


						$totalFiltered = $query->num_rows(); 
						

					}

					$limit = " LIMIT ".$this->db->escape_str($requestData['start'])." ,".$this->db->escape_str($requestData['length'])." ";
		            $sqlClientes .= $limit;
		                
		            $query = $this->db->query($sqlClientes);



		            $data = array();

							foreach ($query->result_array() as $row)
							{ 
								$nestedData=array();

							    $nestedData[] = $row["id_usuario"];
							    $nestedData[] = $row["nombreCompleto"];
								$nestedData[] = $row["correo"];
								$nestedData[] = $row["telefono"];
								$nestedData[] = $row["rfc"];
								$nestedData[] = $row["estado"];
								$nestedData[] = $row["municipio"];
								$nestedData[] = $row["localidad"];
								$nestedData[] = $row["VerPolizas"];

								$data[] = $nestedData;
							}


					$json_data = array(
						"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
						"recordsTotal"    => intval( $totalData ),  // total number of records
						"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
						"data"            => $data  // total data array
						);


					return $json_data;


			
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