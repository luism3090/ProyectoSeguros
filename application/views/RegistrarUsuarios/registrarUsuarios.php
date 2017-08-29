<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Usuarios</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/bootstrap.min.css">
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/fileInput/fileinput.min.css"> -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/estiloHomeMenu.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/estiloBarraSuperior.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/estiloTablasBootstrap.css">
	<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css"> -->
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
							
							<h3>Registrar Usuarios</h3>	
						
						</div>
					</div>
					<br><br><br>
					
					<form action="" id="formRegistrarUsuario">
						<div class="row">
							<div class="col-xs-6">
									<div class="form-group">
										<label for="txtNombre">Nombre:</label>
										<input type="text" id="txtNombre" name="txtNombre"  class="form-control" placeholder="Nombre">
									</div>
									
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label for="txtApellidoPa">Apellido paterno:</label>
									<input type="text" id="txtApellidoPa" name="txtApellidoPa"  class="form-control" placeholder="Apellido paterno">
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label for="txtApellidoMa">Apellido materno:</label>
									<input type="text" id="txtApellidoMa" name="txtApellidoMa"  class="form-control" placeholder="Apellido materno">
								</div>
							</div>
							<div class="col-xs-6">
									<div class="form-group">
										<label for="slRFC">RFC:</label> 
										<select id="slRFC" class="form-control" name="slRFC">											
										</select> 
									</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group">
										<label for="txtTelefono">Teléfono:</label>
										<input type="text" id="txtTelefono" name="txtTelefono"  class="form-control" placeholder="Teléfono" maxlength='13'>
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group">
										<label for="txtCelular">Celular:</label>
										<input type="text" id="txtCelular" name="txtCelular"  class="form-control" placeholder="Celular" maxlength='10'>
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label for="slEstado">Estado:</label> 
									<select id="slEstado" class="form-control" name="slEstado">
									  
									</select> 
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label for="slMunicipio">Municipio:</label> 
									<select id="slMunicipio" class="form-control" name="slMunicipio">
									
									</select> 
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label for="slLocalidad">Localidad:</label> 
									<select id="slLocalidad" class="form-control" name="slLocalidad">
									
									</select> 
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label for="txtDomicilio">Domicilio:</label>
									<input type="text" id="txtDomicilio" name="txtDomicilio"  class="form-control" placeholder="Domicilio">
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label for="txtColonia">Colonia:</label>
									<input type="text" id="txtColonia" name="txtColonia"  class="form-control" placeholder="Colonia">
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label for="txtNumero">Número:</label>
									<input type="text" id="txtNumero" name="txtNumero"  class="form-control" placeholder="Número">
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label for="txtCorreo">Correo:</label>
									<input type="text" id="txtCorreo" name="txtCorreo"  class="form-control" placeholder="Correo">
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label for="txtCorreoCorp">Correo corporativo:</label>
									<input type="text" id="txtCorreoCorp" name="txtCorreoCorp"  class="form-control" placeholder="Correo corporativo">
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label for="txtPassword">Password:</label>
									<input type="text" id="txtPassword" name="txtPassword"  class="form-control" placeholder="Password" minlength="5"  maxlength="20" >
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label for="elegir">Tipo de usuario:</label> 
									<select id="slTipoUsuario" class="form-control" name="slTipoUsuario">
									    <option value="3" selected >Cliente</option>
										<option value="2">Administrador</option> 
										<option value="1">Super Usuario</option>
									</select> 
								</div>
							</div>

						</div>
						<div class="row">
							<div class="col-xs-12 ">
									<!--  <div class="form-group">
									 <label for="elegir" class="center-block text-center" >Foto:</label> 
										<div class="kv-avatar center-block text-center" style="width:200px">
							                <input id="fileFoto" name="avatar-2" type="file" class="file-loading" >
							            </div>

							          </div> -->
									<br><br>
									<button type="submit" class="btn btn-primary center-block text-center"  >Guardar</button>
							</div>
						</div>
							

					</form>

	    </div>

	</div>

	<br><br><br><br><br>


<!-- Modal -->
<div id="modalUsuarioRegistrado" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Alerta</h4>
      </div>
      <div class="modal-body">
        <h4>El Usuario ha sido registrado correctamente</h4>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal" id="btnAceptarUsuarioRegistrado" >Registrar nuevo usuario</button>
      <!-- <button type="button" class="btn btn-primary" id="btnIrAUsuarios">Ir a usuarios</button> -->
      <input type="hidden" id="base_url" >
      </div>
    </div>

  </div>
</div>

	<script src="<?php echo base_url(); ?>public/libreriasJS/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>public/libreriasJS/bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>public/libreriasJS/bootstrapValidator.js"></script>

	<script src="<?php echo base_url(); ?>public/js/registrarUsuarios.js"></script>
	<script src="<?php echo base_url(); ?>public/js/cargarMenu.js"></script>
	<script src="<?php echo base_url(); ?>public/js/cerrarSesion.js"></script>
	

	

</body>
</html>