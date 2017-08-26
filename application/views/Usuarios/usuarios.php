<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Usuarios</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/fileInput/fileinput.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/estiloHomeMenu.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/estiloBarraSuperior.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/estiloTablasBootstrap.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
</head>
<body >
	
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
									                                        <p class="text-left"><strong><?php echo $this->session->userdata('nombre')." ".$this->session->userdata('apellidos') ?></strong></p>
									                                        <p class="text-left small"><?php echo $this->session->userdata('email')?></p>
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
										
										<h3>Modificar Usuarios</h3>	
									
									</div>
								</div>
								<br><br><br>
								<div class="row">
									<div class="col-xs-12">
										
												<div class="table-responsive">
														<table class="table table-bordered table-hover" id="tblUsuariosAlta" cellspacing="0"  width="100%" style="text-align: center;">
																<caption style="text-align: center"><h4><strong>Usuarios dados de alta</strong></h4></caption>
																<thead>
													                    <tr>
														                      <th>id_usuario</th>
														                      <th>id_rol</th>
														                      <th>Nombre</th>
														                      <th>Apellidos</th>
														                      <th>Email</th>
														                      <th>Fecha de registro</th>
														                      <th>Tipo de usuario</th>
														                      <th>Modificar</th>
														                      <th>Baja</th>
														                      <th>Enviar Email</th>
													                    </tr>
												                </thead>
												        </table>
												</div>
									</div>
								</div>
								
								<br><br><br><br><br><br>
								<div class="row">
									<div class="col-xs-12">
												
												<table class="table table-bordered table-hover" id="tblUsuariosBaja" cellspacing="0"  width="100%" style="text-align: center;">
														<caption style="text-align: center"><h4><strong>Usuarios dados de baja</strong></h4></caption>
														<thead>
															
											                    <tr>
											                      <th>id_usuario</th>
											                      <th>id_rol</th>
											                      <th>Nombre</th>
											                      <th>Apellidos</th>
											                      <th>Email</th>
											                      <th>Fecha de registro</th>
											                      <th>Tipo de usuario</th>
											                      <th>Alta</th>
											                    </tr>
										                </thead>
												</table>


									</div>
							   </div>

				</div>

	</div>

	<br><br><br><br><br>


   <!-- Modal -->
<div id="modalUpdateUsuario" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static" >
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
	      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Modificar usuario</h4>
	      </div>
	      <form id="FormUpdateUsuario">
		      <div class="modal-body">
			      	<div class="row">
			        	<div class="col-xs-12">
				        		
									<div class="form-group">
										<label for="txtNombre">Nombre:</label>
										<input type="text" id="txtNombre" name="txtNombre" class="form-control" placeholder="Nombre">
									</div>
									<div class="form-group">
										<label for="txtApellidos">Apellidos:</label>
										<input type="text" id="txtApellidos" name="txtApellidos" class="form-control" placeholder="Apellidos">
									</div>
									<div class="form-group">
										<label for="txtEmail">Email:</label>
										<input type="text" id="txtEmail" name="txtEmail"  class="form-control" placeholder="Email">
									</div>
									<div class="form-group">
										<label for="txtPassword">Password:</label>
										<input type="text" id="txtPassword" name="txtPassword"  class="form-control" placeholder="Password" minlength="5"  maxlength="20" >
									</div>
									<div class="form-group">
										<label for="elegir">Tipo de usuario:</label> 
										<select id="slTipoUsuario" class="form-control" name="slTipoUsuario">
											<option value="1">Super Usuario</option>
											<option value="2">Administrador</option> 
											<option value="3" selected>Cliente</option>
										</select> 
									</div>

									<div class="form-group">
											 <label for="elegir" class="center-block text-center" >Foto:</label> 
												<div class="kv-avatar center-block text-center" style="width:200px">
									                <input id="fileFoto" name="avatar-2" type="file" class="file-loading" >
									            </div>

									  </div>
											<br><br>
									<input type="hidden" id="txtIdUsuario" class="form-control">
									
								
			        	</div>
			        </div>
		      </div>
		      <div class="modal-footer">
				      <button type="submit" class="btn btn-primary"  id="btnModificarUsuario" >Modificar</button>
				      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
		      </div>
	      </form>
    </div>

  </div>
</div>


   <!-- Modal -->
<div id="modalAlertaUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Alerta</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal" id="btnMdlAlertaUpdateUsuario">Aceptar</button>
      </div>
    </div>

  </div>
</div>



       <!-- Modal -->
<div id="modalUpdateUsuarioCabecera" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static" >
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
	      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Modificar usuario</h4>
	      </div>
	      <form id="FormUpdateUsuarioCabecera">
		      <div class="modal-body">
			      	<div class="row">
			        	<div class="col-xs-12">
				        		
									<div class="form-group">
										<label for="txtNombreCab">Nombre:</label>
										<input type="text" id="txtNombreCab" name="txtNombreCab" class="form-control" placeholder="Nombre">
									</div>
									<div class="form-group">
										<label for="txtApellidosCab">Apellidos:</label>
										<input type="text" id="txtApellidosCab" name="txtApellidosCab" class="form-control" placeholder="Apellidos">
									</div>
									<div class="form-group">
										<label for="txtEmailCab">Email:</label>
										<input type="text" id="txtEmailCab" name="txtEmailCab"  class="form-control" placeholder="Email">
									</div>
									<div class="form-group">
										<label for="txtPasswordCab">Password:</label>
										<input type="text" id="txtPasswordCab" name="txtPasswordCab"  class="form-control" placeholder="Password" minlength="5"  maxlength="20" >
									</div>
									<div class="form-group">
										<label for="slTipoUsuarioCab">Tipo de usuario:</label> 
										<select id="slTipoUsuarioCab" class="form-control" name="slTipoUsuarioCab">
											<option value="1">Super Usuario</option>
											<option value="2">Administrador</option> 
											<option value="3" selected>Cliente</option>
										</select> 
									</div>

									<div class="form-group">
											 <label for="fileFotoCab" class="center-block text-center" >Foto:</label> 
												<div class="kv-avatar center-block text-center" style="width:200px">
									                <input id="fileFotoCab" name="avatar-2" type="file" class="file-loading" >
									            </div>

									  </div>
											<br><br>
									<input type="hidden" id="txtIdUsuarioCab" class="form-control">
									
								
			        	</div>
			        </div>
		      </div>
		      <div class="modal-footer">
				      <button type="submit" class="btn btn-primary"  id="btnModificarUsuarioCab" >Modificar</button>
				      <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
		      </div>
	      </form>
    </div>

  </div>
</div>

   <!-- Modal -->
<div id="modalAlertaUsuarioCabecera" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Alerta</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal" id="btnMdlAlertaUpdateUsuario">Aceptar</button>
      </div>
    </div>

  </div>
</div>



   <!-- Modal -->
<div id="modalBajaUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Alerta</h4>
      </div>
      <div class="modal-body">
        <p>¿Desea dar de baja al usuario <strong class="nombre_usuario"></strong> ?</p>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-primary" data-dismiss="modal" id="btnMdlBajaUsuario">Aceptar</button>
      <button type="button" class="btn btn-default" data-dismiss="modal" >Cancelar</button>
      <input type="hidden" class="txtMdlIdUsuario" >
      </div>
    </div>

  </div>
</div>


   <!-- Modal -->
<div id="modalAltaUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Alerta</h4>
      </div>
      <div class="modal-body">
        <p>¿Desea dar de alta al usuario <strong class="nombre_usuario"></strong> ?</p>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-primary" data-dismiss="modal" id="btnMdlAltaUsuario">Aceptar</button>
      <button type="button" class="btn btn-default" data-dismiss="modal" >Cancelar</button>
      <input type="hidden" class="txtMdlIdUsuario" >
      </div>
    </div>

  </div>
</div>


  <!-- Modal -->
<div id="modalEnviarEmailUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Alerta</h4>
      </div>
      <div class="modal-body">
        <p>¿Desea enviar un email al usuario <strong class="nombre_usuario"></strong> ?</p>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-primary" data-dismiss="modal" id="btnMdlEnviarEmailUsuario">Aceptar</button>
      <button type="button" class="btn btn-default" data-dismiss="modal" >Cancelar</button>
      <input type="hidden" class="txtMdlIdUsuario" >
      </div>
    </div>

  </div>
</div>


	<script src="<?php echo base_url(); ?>public/libreriasJS/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>public/libreriasJS/bootstrap.min.js"></script>
		<script src="<?php echo base_url(); ?>public/libreriasJS/fileInput/fileinput.min.js"></script>
	<script src="<?php echo base_url(); ?>public/libreriasJS/fileInput/es.js"></script>
	<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>

	<script src="<?php echo base_url(); ?>public/libreriasJS/bootstrapValidator.js"></script>
	<script src="<?php echo base_url(); ?>public/js/cargarUsuarios.js"></script>
	<script src="<?php echo base_url(); ?>public/js/cargarMenu.js"></script>
	<script src="<?php echo base_url(); ?>public/js/cerrarSesion.js"></script>
	
	

</body>
</html>