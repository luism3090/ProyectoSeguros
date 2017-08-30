<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Póliza Digital</title>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/estiloHomeMenu.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/estiloBarraSuperior.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/estiloTablasBootstrap.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
	 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.2/css/select.dataTables.min.css">
	
</head>
<body data-base-url="<?php echo base_url();?>" data-id-rol = "<?php echo $this->session->userdata('id_rol'); ?>" >


	
	<div id="contenedor-principal" >
					
		<div class="navbar navbar-default navbar-fixed-top" role="navigation">

						    <div class="container-fluid"> 

						        <div class="navbar-header">
						        
						        </div>

						        <div class="collapse navbar-collapse">
						            
						            <ul class="nav navbar-nav navbar-right">
						                <li class="dropdown">
						                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
						                        <span class="glyphicon glyphicon-user"></span> 
						                        <strong><?php echo $this->session->userdata('nombre'); ?></strong>
						                        <span class="glyphicon glyphicon-chevron-down"></span>
						                    </a>
						                    <ul class="dropdown-menu">
						                        <li>
						                            <div class="navbar-login">
						                                <div class="row">
						                                    <div class="col-lg-4">
						                                        <p class="text-center">
						                                            <img src="<?php echo base_url();?>public/uploads/<?php echo $this->session->userdata('foto')?>" alt="" width="100px" height="100px">
						                                        </p>
						                                    </div>
						                                    <div class="col-lg-8">
						                                        <p class="text-left"><strong><?php echo $this->session->userdata('nombre'); ?></strong></p>
						                                        <p class="text-left small"><?php echo $this->session->userdata('email');?></p>
						                                        <p class="text-left">
						                                            <a href="#" class="btn btn-primary btn-block btn-sm" id="btnUpdateMyData">Actualizar Datos</a>
						                                        </p>
						                                    </div>
						                                </div>
						                            </div>
						                        </li>
						                        <li class="divider"></li>
						                        <li>
						                            <div class="navbar-login navbar-login-session">
						                                <div class="row">
						                                    <div class="col-lg-12">
						                                        <p>
						                                            <a href="#" class="btn btn-danger btn-block" id="btnCerrarSesion">Cerrar Sesion</a>
						                                        </p>
						                                    </div>
						                                </div>
						                            </div>
						                        </li>
						                    </ul>
						                </li>
						            </ul>
						        </div>

						    </div>
		</div>

		<div class="sidebar left" >

			  <ul class="list-sidebar bg-defoult" >

			  </ul>
		</div>
		
        <div style="margin-left:22%;width:75%" class="container-fluid" >
					
					<div class="row">
						<div class="col-xs-12 text-center">
							
							<h3>Póliza Digital</h3>	
						
						</div>
					</div>
					<br>
					
					<div class="row">
				<div class="col-xs-12">
						
						<div class="table-responsive">
								<table class="table table-bordered table-hover" id="tblDetallePolizasClientes" cellspacing="0"  width="100%" style="text-align: center;">
										<caption style="text-align: center"><h4><strong>Usuarios dados de alta</strong></h4></caption>
										<thead>
							                    <tr>
								                      <th>Código</th>
								                      <th>#Póliza</th>
								                      <th>Tipo de Póliza</th>
								                      <th>Cliente</th>
								                      <th>Vencimiento</th>
								                      <th>Aseguradora</th>
								                      <th>Enviar Email</th>
							                    </tr>
							            </thead>
					                    <tbody>
					                    	<tr>
					                    		<td>Datos</td>
					                    		<td>Datos</td>
					                    		<td>Datos</td>
					                    		<td>Datos</td>
					                    		<td>Datos</td>
					                    		<td>Datos</td>
					                    		<td><button  type="button" class="btn btn-success DownloadPoliza"> <span class="glyphicon glyphicon-download-alt"></span> Descargar póliza</button></td>
					                    	</tr>
					                    	<tr>
					                    		<td>Datos</td>
					                    		<td>Datos</td>
					                    		<td>Datos</td>
					                    		<td>Datos</td>
					                    		<td>Datos</td>
					                    		<td>Datos</td>
					                    		<td><button  type="button" class="btn btn-success DownloadPoliza"> <span class="glyphicon glyphicon-download-alt"></span> Descargar póliza</button></td>
					                    	</tr>
					                    	<tr>
					                    		<td>Datos</td>
					                    		<td>Datos</td>
					                    		<td>Datos</td>
					                    		<td>Datos</td>
					                    		<td>Datos</td>
					                    		<td>Datos</td>
					                    		<td><button  type="button" class="btn btn-success DownloadPoliza"> <span class="glyphicon glyphicon-download-alt"></span> Descargar póliza</button></td>
					                    	</tr>
					                    	<tr>
					                    		<td>Datos</td>
					                    		<td>Datos</td>
					                    		<td>Datos</td>
					                    		<td>Datos</td>
					                    		<td>Datos</td>
					                    		<td>Datos</td>
					                    		<td><button  type="button" class="btn btn-success DownloadPoliza"> <span class="glyphicon glyphicon-download-alt"></span> Descargar póliza</button></td>
					                    	</tr>
					                    	<tr>
					                    		<td>Datos</td>
					                    		<td>Datos</td>
					                    		<td>Datos</td>
					                    		<td>Datos</td>
					                    		<td>Datos</td>
					                    		<td>Datos</td>
					                    		<td><button  type="button" class="btn btn-success DownloadPoliza"> <span class="glyphicon glyphicon-download-alt"></span> Descargar póliza</button></td>
					                    	</tr>
					                    </tbody>
						                
						        </table>
						</div>
				</div>
			</div>


	<br><br><br><br><br>




	<script src="<?php echo base_url(); ?>public/libreriasJS/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>public/libreriasJS/bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/select/1.2.2/js/dataTables.select.min.js" ></script>
	<script src="<?php echo base_url(); ?>public/libreriasJS/bootstrapValidator.js"></script>
	<script src="<?php echo base_url(); ?>public/js/cargarTablaPolizasClientes.js"></script>
	<script src="<?php echo base_url(); ?>public/js/cargarMenu.js"></script>
	<script src="<?php echo base_url(); ?>public/js/cerrarSesion.js"></script>



</body>
</html>