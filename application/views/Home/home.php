<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/estiloHomeMenu.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/estiloBarraSuperior.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/dataTables.bootstrap.min.css"> 
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/select.dataTables.min.css"> -->

	
	

	
</head>

<body data-base-url="<?php echo base_url();?>">
	
	<div class="navbar navbar-default navbar-fixed-top" role="navigation">

	    <div class="container-fluid"> 

	        <div class="navbar-header">
	        
	        </div>

	        <div class="collapse navbar-collapse">
	            
	            <ul class="nav navbar-nav navbar-right">
	                <li class="dropdown">
	                	
	                	<img src="<?php echo base_url();?>public/images/actise2.png" alt="actise"  class="img-responsive" width='130px' height='130px' style='display: inline-block;' >
	                    
	                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style='display: inline-block;'>

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
	                                            <img src="<?php echo base_url();?>public/uploads/<?php echo $this->session->userdata('foto'); ?>" alt="" width="100px" height="100px">
	                                        </p>
	                                    </div>
	                                    <div class="col-lg-8">
	                                        <p class="text-left"><strong><?php echo $this->session->userdata('nombre'); ?></strong></p>
	                                        <p class="text-left small"><?php echo $this->session->userdata('correo')?></p>
	                                        <p class="text-left">
	                                            <!-- <a href="#" class="btn btn-primary btn-block btn-sm" id="btnUpdateMyData">Actualizar Datos</a> -->
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
	

	<div class="container" style="margin-left:17.5%;width:78%;" >
						
			<div class="row">
				<div class="col-xs-12">
					<h2 style="text-align: center;">Control de Pólizas</h2>
				</div>
			</div>
			<br><br><br>
			<div class="row">
				<div class="col-xs-12">
						
						<div class="table-responsive">
							
								<table class="table table-bordered table-hover" id="tblDetallePolizas" cellspacing="0"  style="text-align: center;width:800px">
										<caption style="text-align: center"><h4><strong>Usuarios dados de alta</strong></h4></caption>
										<thead>
							                    <tr>
								                      <th>id_poliza</th>
								                      <th style='width:150px' >#Póliza</th>
								                      <th style='width:200px'>Tipo de Póliza</th>
								                      <th style='width:150px'>Cliente</th>
								                      <th style='width:100px'>Forma de Pago</th>
								                      <th style='width:100px'>Fecha inicio</th>
								                      <th style='width:100px'>Fecha vencimiento</th>
								                      <th style='width:150px'>Aseguradora</th>
								                      <th style='width:100px'>Pagos</th>
								                      <th style='width:50px'></th>
								                      <th style='width:50px'>Mail</th>
							                    </tr>
							            </thead>

						        </table>
						</div>
				</div>
			</div>

	</div>


<!-- Modal -->
<div id="modalPagosPoliza" class="modal fade" role="dialog" class="modal fade" role="dialog"  data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" style='width: 800px'>
      <div class="modal-header">
       <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
        <h4 class="modal-title">Pago de póliza </h4>
      </div>
      

		      <div class="modal-body">

		      	<div>
					<strong>Fecha inicial:</strong>
					<strong id='strFechaInicial' style='font-weight: bold;' ></strong>	
						
					<strong style='margin-left: 40px'>Fecha Final:</strong>
					<strong id='strFechaFinaliza' style='font-weight: bold;'></strong>	
				</div>
				
				<br>

		      	<h4 style='width: 200px; margin:0px auto'>Exhibición de pagos </h4>
				
				<br>
			    <div class="form-group">
					<label for="txtPagoTotalPoliza">Forma de pago:</label> <label id='lblFormaPago'></label> 
			      	<label for="txtPagoTotalPoliza" style="margin-left: 55px";>Pago total:</label> <strong>$</strong><strong id='txtPagoTotalPoliza'></strong>	
				</div>
				<br>
		        <table id='tblFormaDePago' style='width: 768px;height: 285px' >
		        	<tbody>
		        	</tbody>
		        </table>
		      </div>
		      <div class="modal-footer">
		      				<button type="button" class="btn btn-primary"  data-dismiss="modal" id="btnAceptarPagos">Aceptar</button>
		      </div>
	

    </div>

  </div>
</div>



<div id="modalSuccessPagoPoliza" class="modal fade" role="dialog">
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
      <button type="button" class="btn btn-primary" data-dismiss="modal" >Aceptar</button>
      </div>
    </div>

  </div>
</div>


<div id="modalEnviarEmailCliente" class="modal fade" role="dialog">
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
      <button type="button" class="btn btn-primary" data-dismiss="modal" id='btnEnviarEmailCliente' >Aceptar</button>
      <button type="button" class="btn btn-default" data-dismiss="modal" >Cancelar</button>
      </div>
    </div>

  </div>
</div>


<div id="modalMensajeEmailCliente" class="modal fade" role="dialog">
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
      <button type="button" class="btn btn-primary" data-dismiss="modal" >Aceptar</button>
      <button type="button" class="btn btn-default" data-dismiss="modal" >Cancelar</button>
      </div>
    </div>

  </div>
</div>



	<br><br><br><br><br><br>

	
	<script src="<?php echo base_url(); ?>public/libreriasJS/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>public/libreriasJS/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>public/libreriasJS/bootstrapValidator.js"></script>


	<script src="<?php echo base_url(); ?>public/libreriasJS/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>public/libreriasJS/dataTables.bootstrap.min.js"></script>

	<script src="http://momentjs.com/downloads/moment.min.js"></script>

	
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/locale/es-us.js">  </script>	 -->


	<!-- <script src="<?php echo base_url(); ?>public/libreriasJS/dataTables.select.min.js"></script> -->
	
	<script src="<?php echo base_url(); ?>public/js/cargarTablaPolizas.js"></script>
	<script src="<?php echo base_url(); ?>public/js/cargarMenu.js"></script>
	<script src="<?php echo base_url(); ?>public/js/cerrarSesion.js"></script> 


</body>
</html>