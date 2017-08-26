<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Inicio Login</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/estiloLogin.css">
    <style type="text/css" media="screen">
        #modalAlerta .modal-body p
        {
          font-size: 18px;
          font-weight: bold;
        }
        #modalAlerta .modal-body h3
        {
          text-align: center;
          font-weight: bold;
        }
    </style>
  </head>
  <body>
    
<!--     <div class="container">
      <div class="card card-container"> -->
        <br><br><br>
               <div class="form-gap"></div>
              <div class="container">
                <div class="row">
                  <div class="col-md-4 col-md-offset-4">
                          <div class="panel panel-default">
                            <div class="panel-body">
                              <div class="text-center">
                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Olvidaste tu contraseña?</h2>
                                <br><br>
                                <p>Por favor ingresa tu email y te enviaremos las instrucciones para restablecer tu contraseña.</p>
                                <br><br>
                                <div class="panel-body">
                  
                                  <form id="formForgotPassword">
                  
                                    <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                        <input id="email" name="email" placeholder="Escribe tu Email" class="form-control"  type="email">
                                      </div>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                      <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit"  >Enviar</button>
                                    </div>
                                    <br><br>
                                    <a href="<?php echo base_url();?>index.php/Login" class="forgot-password" >
                                      Iniciar sesión
                                    </a>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                </div>
              </div>
<!-- 
      </div>
    </div> -->
    <!-- Modal -->
    <div id="modalAlerta" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
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
            <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
          </div>
        </div>
      </div>
    </div>
    <script src="<?php echo base_url(); ?>public/libreriasJS/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>public/libreriasJS/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>public/libreriasJS/bootstrapValidator.js"></script>
    <script src="<?php echo base_url(); ?>public/js/olvidarContrasena.js"></script>
  </body>
</html>