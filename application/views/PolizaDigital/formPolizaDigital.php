<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Póliza de Vida de Grupo</title>


	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/fileInput/fileinput.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/estiloHomeMenu.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/estiloBarraSuperior.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/dataTables.bootstrap.min.css"> 
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/select.dataTables.min.css">

	
	
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
							
							<h3>Póliza Digital</h3>	
						
						</div>
					</div>
					<br>
					
					<form action="" id="formPolizaDigital">
					
						<fieldset>
							<legend>Seleccionar cliente:</legend>
							<div class="row">
								<div class="col-xs-12 ">
									<div class="table-responsive">
										<table class="table table-bordered table-hover" id="tblClientes" cellspacing="0"  width="100%" style="text-align: center;">
												<caption style="text-align: center"><h4><strong>Clientes</strong></h4></caption>
												<thead>
									                    <tr>
										                      <th>id_usuario</th>
										                      <th>Nombre</th>
										                      <th>Correo</th>
										                      <th>Teléfono</th>
										                      <th>Rfc</th>
										                      <th>Estado</th>
										                      <th>Municipio</th>
										                      <th>Localidad</th>
										                      <th>Subir Polizas</th>
									                    </tr>
								                </thead>
								        </table>
									</div>
								</div>
							</div>
						</fieldset>
						<br><br><br><br><br><br><br>
							
							<fieldset id="contMsCliente" style ="display:none">
								<legend>Datos del cliente:</legend>
								
								<div class="row">
									<div class="col-xs-12 " >
										<h4 id="nombreClienteSelecionado" class="center-block text-center">
											
										</h4>
									</div>
								</div>
								<br><br>
								<div class="row">
									<div class="col-xs-12 ">
										<h4 id="msjClienteSelecionado" class="center-block text-center">
											¿Desea avisar al cliente seleccionado con 10 dias de anticipación su próxima fecha a vencer?
										</h4>
									</div>

								</div>
<br><br>
								<div class="row">
									<div class="col-xs-12 ">
											<button type="submit" class="btn btn-primary center-block text-center" id="btnEnviar" >Enviar</button>
									</div>
								</div>
							</fieldset>

					</form>

	    </div>

	</div>

	<br><br><br><br><br>


	<!-- Modal -->
<div id="modalCargarFilesPolizasUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Alerta</h4>
      </div>
      <div class="modal-body">
        	
        <div class="row">
			<div class="col-xs-12 ">
	        	 <div class="form-group">
				 	<label for="elegir" class="center-block text-center" >Subir Poliza:</label> 
					<div class="kv-avatar center-block text-center" style="width:200px">
		                <input id="filePoliza" name="avatar-2" type="file" class="file-loading" >
		            </div>

		          </div>

	         </div>

	     </div>

      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal" id="btnGuardarFilesPolizasUsuarios" >Guardar</button>
      <button type="button" class="btn btn-primary" data-dismiss="modal" id="btnCancelarFilesPolizasUsuarios">Cancelar</button>
      <input type="hidden" id="base_url" >
      </div>
    </div>

  </div>
</div>



	<script src="<?php echo base_url();?>public/libreriasJS/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>public/libreriasJS/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>public/libreriasJS/fileInput/fileinput.min.js"></script>
	<script src="<?php echo base_url(); ?>public/libreriasJS/fileInput/es.js"></script>
	<script src="<?php echo base_url(); ?>public/libreriasJS/bootstrapValidator.js"></script>

	<script src="<?php echo base_url(); ?>public/libreriasJS/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>public/libreriasJS/dataTables.bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>public/libreriasJS/dataTables.select.min.js"></script>



	<script src="<?php echo base_url(); ?>public/js/cargarTablaClientes.js"></script>
	<script src="<?php echo base_url(); ?>public/js/msjClientesPolizaDigital.js"></script>
	<script src="<?php echo base_url(); ?>public/js/cargarMenu.js"></script>
	<script src="<?php echo base_url(); ?>public/js/cerrarSesion.js"></script>



		<script>
		
		  $("#filePoliza").fileinput({
        overwriteInitial: true,
        maxFileSize: 5000,
        showClose: false,
        showCaption: false,
        maxFileCount:1,
        showBrowse: false,
        browseOnZoneClick: true,
        language: "es",
        removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
        removeTitle: 'Cancelar',
        defaultPreviewContent: '<img src="<?php echo base_url(); ?>public/uploads/default.png" alt="Your Avatar" style="width:200px"><h6 class="text-muted">Clic para subir tu foto</h6>',
        layoutTemplates: {main2: '{preview} {remove} {browse}'},
        allowedFileExtensions: ["jpg", "png", "gif","pdf"]
    });
		
</script>
	



</body>
</html>