$(document).ready(function()
{

  validaFormRegistrarUsuario();





  $("body").on("submit","#formRegistrarUsuario",function(event)
  {
  		event.preventDefault();
  		validaFormRegistrarUsuario();

  });

  $('#modalUsuarioRegistrado').on('hide.bs.modal', function (e) 
    {
         location.reload();
    });


  $("body").on("click","#btnIrAUsuarios",function(event)
  {
  		
  		$("#modalUsuarioRegistrado").modal("hide");
  		location.href = $("#modalUsuarioRegistrado #base_url").val();


  });




 function validaFormRegistrarUsuario()
  {             
                          


              $('#formRegistrarUsuario').bootstrapValidator(
              {

                    message: 'This value is not valid',
                    container: 'tooltip',
                    feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {
                        txtNombre: {
                           group: '.form-group',
                            validators: 
                            {
                                notEmpty: {
                                    message: 'Este campo es requerido'
                                },
                                

                            }
                        },
                        txtApellidos: {
                            group: '.form-group',
                            validators: {
                                notEmpty: {
                                    message: 'Este campo es requerido'
                                },
                                


                            }
                        },
                        txtEmail: {
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
                                  callback: {
                                  message: 'El Email ingresado no esta disponible',
                                  callback: function(value, validator) {
                                      // Get the selected options

                                      var valida = true;

                                      var datosUsuario = {
                                                            email:$("#txtEmail").val()
                                                          }


                                                  $.ajax(
                                                  {
                                                      type: "POST",
                                                      url: "RegistrarUsuarios/checkEmail",
                                                    dataType:"json",
                                                      data: datosUsuario,
                                                       async: false,
                                                      success: function(result)
                                                          {

                                                            if(typeof(result.baja) == "undefined") 
                                                            {
                                                              if(result.msjCantidadRegistros > 0)
                                                              {
                                                                 valida = false;
                                                              }
                                                              else
                                                              {
                                                                valida = true;
                                                              }
                                                            }
                                                            else
                                                            {
                                                              window.location = result.url;
                                                            }
                                                        
                                                          },
                                                     error:function(result)
                                                        {
                                                          alert("Error");
                                                         console.log(result.responseText);
                                                          
                                                        }
                                                        
                                                  });

                                                  return valida;

                                      // var options = validator.getFieldElements('colors').val();
                                      // return (options != null && options.length >= 2 && options.length <= 4);
                                  }
                              },

                          }
                      },
                      txtPassword: {
                          group: '.form-group',
                          validators: {
                              notEmpty: {
                                  message: 'Este campo es requerido'
                              },
                              stringLength: {
                                  enabled: true,
                                  min: 5,
                                  max: 20,
                                  message: 'El password debe contener como mínimo 5 caracteres y 20 como máximo'
                              },

                          }
                      },
                       slTipoUsuario: {
                        group: '.form-group',
                          validators: {
                              notEmpty: {
                                  message: 'Seleciona un tipo de usuario.'
                              }
                          }
                      }


                }
              }).on('success.form.bv', function (e) {

                               // debugger;

                       var datosUsuarioUrl = "?nombre="+$("#txtNombre").val()+
                            "&apellidos="+$("#txtApellidos").val()+
                            "&email="+$("#txtEmail").val()+
                            "&password="+$("#txtPassword").val()+
                            "&id_rol="+$("#slTipoUsuario").val();


                      var archivos = document.getElementById("fileFoto");  

                        var archivo = archivos.files;
                        var archivos = new FormData();
                        for(i=0; i<archivo.length;i++)
                        {
                          archivos.append('archivo',archivo[i])
                        }


                      $.ajax(
                            {
                                type: "POST",
                                url: "RegistrarUsuarios/insertarUsuario"+datosUsuarioUrl,
                                dataType:"json",
                                contentType:false,
                                processData:false,
                                data: archivos,
                                async: true,
                                success: function(result)
                                    {
                                      
                                      if(typeof(result.baja) == "undefined") 
                                      {
                                        $("#modalUsuarioRegistrado #base_url").val(result.base_url);
                                         $("#modalUsuarioRegistrado").modal("show");
                                      }
                                      else
                                      {
                                        window.location = result.url;
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