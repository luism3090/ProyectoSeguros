<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Model_Polizas extends CI_Model
	{
		public function __construct()
		{
			parent::__construct();
		}


		public function cargarDetallePolizas($request)
		{

					$requestData= $request;

					$columna = $requestData['order'][0]["column"]+1;
					$ordenacion = $requestData['order'][0]["dir"];

					
					$sqlQuery =	"select distinct
											po.id_poliza,
											cfp.nombre as formaPago,
											po.no_poliza, 
											ctp.nombre as tipoPoliza, 
											CONCAT(usu.nombre , ' ', usu.apellido_paterno,' ',usu.apellido_materno) as cliente,
										    DATE_FORMAT(po.fecha_inicia,'%d/%m/%Y') as fecha_inicia, 
    										DATE_FORMAT(po.fecha_finaliza,'%d/%m/%Y') as fecha_finaliza,
										    ca.nombre as aseguradora,
										    '<td><button  type=''button'' class=''btn btn-success sendPagos''> <span class=''glyphicon glyphicon-envelope''></span> Pagos</button></td>' as pagos,
											case 
												when 
													(
														(
															select count(*) as NoHaPagado from 
															polizas po2  
															join poliza_datos_forma_pagos pdf2 on (pdf2.id_poliza = po2.id_poliza)
															where pdf2.id_poliza =  po.id_poliza and 
																 (pdf2.pagado =  0 or pdf2.pagado is null ) and 
																 DATE_FORMAT(now(), '%Y-%m-%d') > pdf2.fecha_pago 
														) >= 1
											        ) 
												then 
													'<td></td>'
												when 
													(
														(
															select count(*) dias_faltantes from 
															polizas po2  
															join poliza_datos_forma_pagos pdf2 on (pdf2.id_poliza = po2.id_poliza)
															where pdf2.id_poliza =  po.id_poliza and 
																( pdf2.pagado =  0 or pdf2.pagado is null ) and 
																DATEDIFF(pdf2.fecha_pago , DATE_FORMAT(now(), '%Y-%m-%d')) >= 0 and
																DATEDIFF(pdf2.fecha_pago , DATE_FORMAT(now(), '%Y-%m-%d')) <= 10
														) = 1
												  ) 
												then 
													'<td><button style=''color: white;'' type=''button'' class=''btn btn-primary enviarEmail''>Enviar Email</button></td>'
												else 
											       '<td></td>'
											end as enviar_email,
										    case 
										    	when 
										    		(
										    			(
										    				select count(*) as NoHaPagado from 
										    				polizas po2  
										    				join poliza_datos_forma_pagos pdf2 on (pdf2.id_poliza = po2.id_poliza)
										    				where pdf2.id_poliza =  po.id_poliza and 
										    					 (pdf2.pagado =  0 or pdf2.pagado is null ) and 
										    					 DATE_FORMAT(now(), '%Y-%m-%d') > pdf2.fecha_pago 
										    			) >= 1
										            ) 
										    	then 
										    		'<td><button  type=''button'' class=''btn btn-danger btn-lg pago''></button></td>'
										    	when 
										    		(
										    			(
										    				select count(*) dias_faltantes from 
										    				polizas po2  
										    				join poliza_datos_forma_pagos pdf2 on (pdf2.id_poliza = po2.id_poliza)
										    				where pdf2.id_poliza =  po.id_poliza and 
										    					( pdf2.pagado =  0 or pdf2.pagado is null ) and 
										    					DATEDIFF(pdf2.fecha_pago , DATE_FORMAT(now(), '%Y-%m-%d')) >= 0 and
										    					DATEDIFF(pdf2.fecha_pago , DATE_FORMAT(now(), '%Y-%m-%d')) <= 10
										    			) = 1
										    	  ) 
										    	then 
										    		'<td><button  type=''button'' class=''btn btn-warning btn-lg pago''></button></td>'
										    	else 
										           '<td><button  type=''button'' class=''btn btn-dark btn-lg pago''></button></td>'
										    end as color_pago
											from polizas po 
										    join poliza_datos_prima pdp on (po.id_poliza = pdp.id_poliza)
										    join poliza_datos_forma_pagos pdf on (po.id_poliza = pdf.id_poliza) 
										    join cat_forma_pago cfp on (pdp.id_forma_pago = cfp.id_forma_pago)
										    left join poliza_datos_autos pda on (po.id_poliza = pda.id_poliza)
										    left join poliza_datos_empresarial pde on (po.id_poliza = pde.id_poliza)
										    join usuarios usu on (po.id_usuario = usu.id_usuario)
										    join rel_usuarios_roles rur on (rur.id_usuario = usu.id_usuario and rur.id_rol = 3)
										    join cat_tipo_poliza ctp on (po.id_tipo_poliza = ctp.id_tipo_poliza)
										    join cat_aseguradoras ca on (po.id_aseguradora = ca.id_aseguradora)
											order by ".$columna." ".$ordenacion." ";

					

					//$query1 = $this->db->query($sql1,array($id_usuario));
					$query = $this->db->query($sqlQuery);

					//$this->db->query($sql, array(array(3, 6), 'live', 'Rick') );

					$totalData = $query->num_rows();
					$totalFiltered = $totalData;

					if( !empty($requestData['search']['value']) ) 
					{   

						

						$sqlQuery = "select 
										id_poliza,
										formaPago,
										no_poliza,
										tipoPoliza,
										cliente,
										fecha_inicia,
										fecha_finaliza,
										aseguradora,
										pagos,
										enviar_email,
										color_pago
										FROM (
										select distinct
											po.id_poliza,
											cfp.nombre as formaPago,
											po.no_poliza, 
											ctp.nombre as tipoPoliza, 
											CONCAT(usu.nombre , ' ', usu.apellido_paterno,' ',usu.apellido_materno) as cliente,
										    DATE_FORMAT(po.fecha_inicia,'%d/%m/%Y') as fecha_inicia, 
    										DATE_FORMAT(po.fecha_finaliza,'%d/%m/%Y') as fecha_finaliza,  
										    ca.nombre as aseguradora,
										    '<td><button  type=''button'' class=''btn btn-success sendPagos''> <span class=''glyphicon glyphicon-envelope''></span> Pagos</button></td>' as pagos,
										    case 
												when 
													(
														(
															select count(*) as NoHaPagado from 
															polizas po2  
															join poliza_datos_forma_pagos pdf2 on (pdf2.id_poliza = po2.id_poliza)
															where pdf2.id_poliza =  po.id_poliza and 
																 (pdf2.pagado =  0 or pdf2.pagado is null ) and 
																 DATE_FORMAT(now(), '%Y-%m-%d') > pdf2.fecha_pago 
														) >= 1
											        ) 
												then 
													'<td></td>'
												when 
													(
														(
															select count(*) dias_faltantes from 
															polizas po2  
															join poliza_datos_forma_pagos pdf2 on (pdf2.id_poliza = po2.id_poliza)
															where pdf2.id_poliza =  po.id_poliza and 
																( pdf2.pagado =  0 or pdf2.pagado is null ) and 
																DATEDIFF(pdf2.fecha_pago , DATE_FORMAT(now(), '%Y-%m-%d')) >= 0 and
																DATEDIFF(pdf2.fecha_pago , DATE_FORMAT(now(), '%Y-%m-%d')) <= 10
														) = 1
												  ) 
												then 
													'<td><button style=''color: white;'' type=''button'' class=''btn btn-primary enviarEmail''>Enviar Email</button></td>'
												else 
											       '<td></td>'
											end as enviar_email,
										    case 
										    	when 
										    		(
										    			(
										    				select count(*) as NoHaPagado from 
										    				polizas po2  
										    				join poliza_datos_forma_pagos pdf2 on (pdf2.id_poliza = po2.id_poliza)
										    				where pdf2.id_poliza =  po.id_poliza and 
										    					 (pdf2.pagado =  0 or pdf2.pagado is null ) and 
										    					 DATE_FORMAT(now(), '%Y-%m-%d') > pdf2.fecha_pago 
										    			) >= 1
										            ) 
										    	then 
										    		'<td><button  type=''button'' class=''btn btn-danger btn-lg pago''></button></td>'
										    	when 
										    		(
										    			(
										    				select count(*) dias_faltantes from 
										    				polizas po2  
										    				join poliza_datos_forma_pagos pdf2 on (pdf2.id_poliza = po2.id_poliza)
										    				where pdf2.id_poliza =  po.id_poliza and 
										    					( pdf2.pagado =  0 or pdf2.pagado is null ) and 
										    					DATEDIFF(pdf2.fecha_pago , DATE_FORMAT(now(), '%Y-%m-%d')) >= 0 and
										    					DATEDIFF(pdf2.fecha_pago , DATE_FORMAT(now(), '%Y-%m-%d')) <= 10
										    			) = 1
										    	  ) 
										    	then 
										    		'<td><button  type=''button'' class=''btn btn-warning btn-lg pago''></button></td>'
										    	else 
										           '<td><button  type=''button'' class=''btn btn-dark btn-lg pago''></button></td>'
										    end as color_pago
											from polizas po 
										    join poliza_datos_prima pdp on (po.id_poliza = pdp.id_poliza)
										    join poliza_datos_forma_pagos pdf on (po.id_poliza = pdf.id_poliza) 
										    join cat_forma_pago cfp on (pdp.id_forma_pago = cfp.id_forma_pago)
										    left join poliza_datos_autos pda on (po.id_poliza = pda.id_poliza)
										    left join poliza_datos_empresarial pde on (po.id_poliza = pde.id_poliza)
										    join usuarios usu on (po.id_usuario = usu.id_usuario)
										    join rel_usuarios_roles rur on (rur.id_usuario = usu.id_usuario and rur.id_rol = 3)
										    join cat_tipo_poliza ctp on (po.id_tipo_poliza = ctp.id_tipo_poliza)
										    join cat_aseguradoras ca on (po.id_aseguradora = ca.id_aseguradora) 
										)AS myTable
										where  
											 ( 
												 no_poliza like '%".$this->db->escape_str($requestData['search']['value'])."%' or
												 tipoPoliza like '%".$this->db->escape_str($requestData['search']['value'])."%' or 
												 cliente like '%".$this->db->escape_str($requestData['search']['value'])."%' or 
												 fecha_inicia like '%".$this->db->escape_str($requestData['search']['value'])."%' or
												 fecha_finaliza like '%".$this->db->escape_str($requestData['search']['value'])."%'  or
												 aseguradora like '%".$this->db->escape_str($requestData['search']['value'])."%' 

										     ) order by ".$columna." ".$ordenacion." ";

					
					 

						$query = $this->db->query($sqlQuery);


						$totalFiltered = $query->num_rows(); 
						

					}

					$limit = " LIMIT ".$this->db->escape_str($requestData['start'])." ,".$this->db->escape_str($requestData['length'])." ";
		            $sqlQuery .= $limit;
		                
		            $query = $this->db->query($sqlQuery);



		            $data = array();

							foreach ($query->result_array() as $row)
							{ 
								$nestedData=array();

							    $nestedData[] = $row["id_poliza"];
							    $nestedData[] = $row["no_poliza"];
								$nestedData[] = $row["tipoPoliza"];
								$nestedData[] = $row["cliente"];
							    $nestedData[] = $row["formaPago"];
								$nestedData[] = $row["fecha_inicia"];
								$nestedData[] = $row["fecha_finaliza"];
								$nestedData[] = $row["aseguradora"];
								$nestedData[] = $row["pagos"];
								$nestedData[] = $row["color_pago"];
								$nestedData[] = $row["enviar_email"];

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


		public function getPagosPoliza($id_poliza)
		{


				// $sql =	" SET @row_number = 0";

				// $this->db->query($sql);

				$sql =	" select 	DATE_FORMAT(fecha_pago, '%d/%m/%Y') fecha_pago,
									cantidad_pago,
									pagado,
									pago_total,
									id_datos_forma_pago
							from polizas po
							join poliza_datos_forma_pagos dfp on (po.id_poliza = dfp.id_poliza )
							join poliza_datos_prima pdp on (po.id_poliza = pdp.id_poliza )
							where po.id_poliza = ?";



							
				// $sql =	" select
				//       		    DATE_FORMAT( DATE_ADD(fecha_inicia, INTERVAL + (@row_number:=@row_number + 1) MONTH) , '%d/%m/%Y') fecha_pago,
				// 					cantidad_pago,
				// 					pagado 
				// 			from polizas po
				// 			join poliza_datos_forma_pagos dfp on (po.id_poliza = dfp.id_poliza )
				// 			where po.id_poliza = ?";

					

				$query = $this->db->query($sql,array($id_poliza));

					if($query)
					{
						if($query->num_rows()>0)
						{
							$resultado_query['numRegistros'] = $query->num_rows();
							$resultado_query['pagos'] = $query->result(); 
							$resultado_query['status'] = 'OK'; 
							$resultado_query['mensaje'] = 'información obtenida';

					
						}
						else
						{
							$resultado_query['numRegistros'] = $query->num_rows();
							$resultado_query['status'] = 'Sin datos';
							$resultado_query['mensaje'] = 'No hay registros'; 
						}
					}
					else
					{
						$resultado_query['status'] = 'ERROR'; 
						$resultado_query['mensaje'] = 'Ocurrió un error en la base de datos porfavor recargue la pagina e intente de nuevo'; 
					}


				return $resultado_query;


		}



		public function hacerPagosPoliza($id_datos_forma_pago,$pagado,$fecha)
		{


				$sql =	"update poliza_datos_forma_pagos set pagado = ? where id_datos_forma_pago = ? ";

				$query = $this->db->query($sql,array($pagado,$id_datos_forma_pago));

				if($query)
				{
					if($pagado == '1')
					{
						$resultado_query['status'] = 'OK'; 
						$resultado_query['mensaje'] = 'El pago de la poliza para la fecha <strong>'.$fecha.'</strong>  fue realizado correctamente';
					}
					else
					{
						$resultado_query['status'] = 'OK'; 
						$resultado_query['mensaje'] = 'El pago de la poliza para la fecha <strong>'.$fecha.'</strong> fue eliminado correctamente';
					}
						
				}
				else
				{
					$resultado_query['status'] = 'ERROR'; 
					$resultado_query['mensaje'] = 'Ocurrió un error en la base de datos porfavor recargue la pagina e intente de nuevo'; 
				}


				return $resultado_query;
					


		}



		public function getDatosPagoEmailCliente($id_poliza)
		{


				$sql =	"select    DATE_FORMAT(fecha_pago, '%d/%m/%Y') fecha_pago,
								   cantidad_pago, 
							       ca.nombre as aseguradora,
							       ctp.nombre as tipo_poliza,
							       po2.no_poliza,
								   CONCAT(usu.nombre , ' ', usu.apellido_paterno,' ',usu.apellido_materno) as cliente,
								   usu.correo
							       from 
						polizas po2  
						join poliza_datos_forma_pagos pdf2 on (pdf2.id_poliza = po2.id_poliza)
						join usuarios usu on (po2.id_usuario = usu.id_usuario)
						join cat_tipo_poliza ctp on (po2.id_tipo_poliza = ctp.id_tipo_poliza )
						join cat_aseguradoras ca on (po2.id_aseguradora = ca.id_aseguradora )
						where pdf2.id_poliza = ? and 
							( pdf2.pagado =  0 or pdf2.pagado is null ) and 
							DATEDIFF(pdf2.fecha_pago , DATE_FORMAT(now(), '%Y-%m-%d')) >= 0 and
							DATEDIFF(pdf2.fecha_pago , DATE_FORMAT(now(), '%Y-%m-%d')) <= 10;";

				$query = $this->db->query($sql,array($id_poliza));

				if($query)
				{
					if($query->num_rows()>0)
					{
						$resultado_query['numRegistros'] = $query->num_rows();
						$resultado_query['datosPagoCliente'] = $query->result(); 
						$resultado_query['status'] = 'OK'; 
						$resultado_query['mensaje'] = 'información obtenida';

				
					}
					else
					{
						$resultado_query['numRegistros'] = $query->num_rows();
						$resultado_query['datosPagoCliente'] = $query->result(); 
						$resultado_query['status'] = 'Sin datos';
						$resultado_query['mensaje'] = 'No hay registros'; 
					}
				}
				else
				{
					$resultado_query['status'] = 'ERROR'; 
					$resultado_query['mensaje'] = 'Ocurrió un error en la base de datos porfavor recargue la pagina e intente de nuevo'; 
				}


				return $resultado_query;
					


		}


	}
?>