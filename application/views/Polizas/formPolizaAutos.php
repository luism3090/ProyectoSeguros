<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Póliza de Autos</title>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/estiloHomeMenu.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/estiloBarraSuperior.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/estiloTablasBootstrap.css">
	
</head>
<body data-base-url="<?php echo base_url();?>">


	
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
							
							<h3>Registro de Póliza de Autos</h3>	
						
						</div>
					</div>
					<br><br><br>
					
					<form action="" id="formRegistrarPolizaAutos">
						
						<fieldset>
							<legend>Datos de póliza:</legend>
							<div class="row">

								<div class="col-xs-6">
										<div class="form-group">
											<label for="slStatus">Status:</label> 
											<select id="slStatus" class="form-control" name="slStatus">									
											</select> 
										</div>
								</div>
								<div class="col-xs-6">
										<div class="form-group">
											<label for="slTipo">Tipo:</label> 
											<select id="slTipo" class="form-control" name="slTipo">											
											</select> 
										</div>
								</div>
								<div class="col-xs-6">
									<div class="form-group">
										<label for="txtNoPoliza">No de póliza:</label>
										<input type="text" id="txtNoPoliza" name="txtNoPoliza"  class="form-control" placeholder="Número de póliza">
									</div>
								</div>

								<div class="col-xs-6">
									<div class="form-group">
										<label for="slAseguradora">Aseguradora:</label> 
										<select id="slAseguradora" class="form-control" name="slAseguradora">											
										</select> 
									</div>
								</div>
								
								<div class="col-xs-6">
									<div class="form-group">
											<label for="txtEmision">Emisión:</label>
											<input type="text" id="txtEmision" name="txtEmision"  class="form-control" placeholder="Emision" >
									</div>
								</div>
								
								<div class="col-xs-6">
									<div class="form-group">
											<label for="dateInicia">Fecha inicia:</label>
											<input type="date" id="dateInicia" name="dateInicia"  class="form-control"  >
									</div>
								</div>

								<div class="col-xs-6">
									<div class="form-group">
											<label for="dateFinaliza">Fecha finaliza:</label>
											<input type="date" id="dateFinaliza" name="dateFinaliza"  class="form-control"  >
									</div>
								</div>

								<div class="col-xs-6">
									<div class="form-group">
											<label for="chkSumaAsegurada">Suma asegurada:</label>
											<input type="checkbox" id="chkSumaAsegurada" name="chkSumaAsegurada"  class="form-control" style="width: 20px;margin: auto;" >
									</div>
								</div>


    

									<div class="col-xs-6">
									<div class="form-group">
										<label for="txtValorComercial">Valor comercial:</label>
										<input type="text" id="txtValorComercial" name="txtValorComercial"  class="form-control" placeholder="Domicilio">
									</div>
								</div>
								<div class="col-xs-6">
										<div class="form-group">
											<label for="txtDescripcion">Descripción:</label>
											<textarea id="txtDescripcion" cols="10" rows="5" name="txtDescripcion"  class="form-control" placeholder="Descripción"></textarea>            
										</div>
										
								</div>
							</div>
						</fieldset>
						<br><br><br>
						<fieldset>
							<legend>Seleccionar cliente:</legend>
							<div class="row">
								<div class="col-xs-12 ">
									<h3>tabla clientes</h3>
								</div>
							</div>
						</fieldset>
						<br><br><br>
						<fieldset>
							<legend>Datos del auto:</legend>
							
							<div class="row">

								<div class="col-xs-6">
									<div class="form-group">
										<label for="txtMarca">Marca:</label> 
										<input type="text" id="txtMarca" class="form-control" name="txtMarca" placeholder="Marca" >									
									</div>
								</div>
								<div class="col-xs-6">
									<div class="form-group">
										<label for="txtModelo">Modelo:</label> 
										<input type="text" id="txtModelo" class="form-control" name="txtModelo" placeholder="Modelo"  />									
									</div>
								</div>
								<div class="col-xs-6">
									<div class="form-group">
										<label for="txtAnio">Año:</label> 
										<input type="text" id="txtAnio" class="form-control" name="txtAnio" placeholder="Año"  />									
									</div>
								</div>
								<div class="col-xs-6">
									<div class="form-group">
										<label for="txtNoSerie">No de serie:</label> 
										<input type="text" id="txtNoSerie" class="form-control" name="txtNoSerie" placeholder="No de serie" />									
									</div>
								</div>
								<div class="col-xs-6">
									<div class="form-group">
										<label for="txtPlacas">Placas:</label> 
										<input type="text" id="txtPlacas" class="form-control" name="txtPlacas" placeholder="Placas"  />									
									</div>
								</div>
							</div>
						</fieldset>
						<br><br><br>
						<fieldset>

							<legend>Prima:</legend>

							<div class="row">

								<div class="col-xs-6">
									<div class="form-group">
										<label for="slFormaPago">Forma de pago:</label> 
										<select id="slFormaPago" class="form-control" name="slFormaPago">											
										</select> 
									</div>
								</div>
								
								<div class="col-xs-6">
									<div class="form-group">
										<label for="slFormaPago">Moneda:</label> 
										<select id="slFormaPago" class="form-control" name="slFormaPago">											
										</select> 
									</div>
								</div>

								<div class="col-xs-6">
									<div class="form-group">
										<label for="slMedioPago">Medio de pago:</label> 
										<select id="slMedioPago" class="form-control" name="slMedioPago">											
										</select> 
									</div>
								</div>

								<div class="col-xs-6">
									<div class="form-group">
										<label for="txtPrimaAnual">Prima neta anual:</label> 
										<input type="text" id="txtPrimaAnual" class="form-control" name="txtPrimaAnual" placeholder="Prima neta anual"  />									
									</div>
								</div>

								<div class="col-xs-6">
									<div class="form-group">
										<label for="txtDescuento">Descuento:</label> 
										<input type="text" id="txtDescuento" class="form-control" name="txtDescuento" placeholder="Descuento"  />									
									</div>
								</div>

								<div class="col-xs-6">
									<div class="form-group">
										<label for="txtRecargos">Recargos:</label> 
										<input type="text" id="txtRecargos" class="form-control" name="txtRecargos" placeholder="Recargos"  />									
									</div>
								</div>

								<div class="col-xs-6">
									<div class="form-group">
										<label for="slIva">Iva:</label> 
										<select id="slIva" class="form-control" name="slIva">
										<option value="1">10%</option>
										<option value="2">16%</option>											
										</select> 
									</div>
								</div>

								<div class="col-xs-6">
									<div class="form-group">
									<label for="slIva">Iva:</label> 
										<input type="text" id="txtIva" class="form-control" name="txtIva" placeholder="$0.00"  />									
									</div>
								</div>

								<div class="col-xs-6">
									<div class="form-group">
										<label for="txtDerechoPoliza">Derecho de póliza:</label> 
										<input type="text" id="txtDerechoPoliza" class="form-control" name="txtDerechoPoliza" placeholder="Derecho de póliza"  />									
									</div>
								</div>

								<div class="col-xs-6">
									<div class="form-group">
										<label for="txtPrima">Prima:</label> 
										<input type="text" id="txtPrima" class="form-control" name="txtPrima" placeholder="Prima"  />									
									</div>
								</div>
	

							</div>
						</fieldset>

							<div class="row">
								<div class="col-xs-12 ">
										<br><br>
										<button type="submit" class="btn btn-primary center-block text-center"  >Guardar</button>
								</div>
							</div>
							

					</form>

	    </div>

	</div>

	<br><br><br><br><br>




	<script src="<?php echo base_url(); ?>public/libreriasJS/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>public/libreriasJS/bootstrap.min.js"></script>

	<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>


	<script src="<?php echo base_url(); ?>public/libreriasJS/bootstrapValidator.js"></script>
	
	<script src="<?php echo base_url(); ?>public/js/cargarMenu.js"></script>
	<script src="<?php echo base_url(); ?>public/js/cerrarSesion.js"></script>

	

	

</body>
</html>