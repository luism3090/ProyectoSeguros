$(document).ready(function()
{

	
	 $("body").on("submit","#formForgotPassword",function(event)
    {

         event.preventDefault();

         validaFormForgotPassword();

    });


	 validaFormForgotPassword();

	function validaFormForgotPassword()
    {


          $('#formForgotPassword').bootstrapValidator(
          {

                message: 'This value is not valid',
                container: 'tooltip',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    email: {
                      group: '.form-group',
                      validators: 
                      {
                          notEmpty: {
                              message: 'Este campo es requerido'
                          },
                           regexp: {
                                  regexp: /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/,

                                  message: 'La dirección de email no es válida',

                              },

                      }
                  },
          
          }
          }).on('success.form.bv', function (e,data) 
          {

            e.preventDefault();

          	var datos = { email: $("#email").val() } 
               
                  $.ajax(
                  {
                      type: "POST",
                      url: "OlvidarPassword/enviarEmailUserOlvidarPassword",
                      dataType:"json",
                      data: datos,
                      async: true,
                      success: function(result)
                          {
                            // debugger;

                           	//console.log(result);

                             if(result.msjCantidadRegistros==0)
                             {
                                $("#modalAlerta .modal-body").html(result.msjNoHayRegistros);
                                $("#modalAlerta").modal("show");

                                 $('#formForgotPassword').bootstrapValidator('destroy', true);
                                 validaFormForgotPassword();

                             }
                             else
                             {
                                 if(result.msjConsulta=='OK')
                                { 
                                   let mensaje = "<h3>¡Éxito!</h3><hr>"+
                                                  "<br><p>Te enviamos las instrucciones para restablecer tu contraseña al correo "+result.email+". Por favor revisa tu email.</p><br>"+
                                                  "<br><p>Si no recibiste un email, por favor revisa la carpeta de correo no deseado o ponte en contacto con el administrador .</p><br><br>";

                                  $("#modalAlerta .modal-body").html(mensaje);
                                  $("#modalAlerta").modal("show");
                                  $('#formForgotPassword').bootstrapValidator('destroy', true);
                                  $('#formForgotPassword #email').val("");
                                   validaFormForgotPassword();
                                }
                                else
                                {
                                  $("#modalAlerta .modal-body").text("Ocurrió un error a la hora de enviar las instrucciones para el cambio de contraseña.");
                                  $("#modalAlerta").modal("show");
                                  $('#formForgotPassword').bootstrapValidator('destroy', true);
                                  validaFormForgotPassword();
                                }
                             }


                          },
                     error:function(result)
                        {
                          alert("Error");
                         console.log(result.responseText);
                          
                        }
                        
                  });


          });


    }



});