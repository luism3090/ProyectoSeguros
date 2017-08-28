$(document).ready(function()
{

var base_url = $("body").attr("data-base-url");

  validaFormRegistrarUsuario();

  $("body").on("submit","#formRegistrarUsuario",function(event)
  {
   //alert();
  		event.preventDefault();

    $("#formRegistrarUsuario").bootstrapValidator();

  });


  $('#modalUsuarioRegistrado').on('hide.bs.modal', function (e) 
    {
         location.reload();
    });


  // $("body").on("click","#btnIrAUsuarios",function(event)
  // {
    
  // 		$("#modalUsuarioRegistrado").modal("hide");
  // 		location.href = $("#modalUsuarioRegistrado #base_url").val();

  // });


  $("body").on("change","#slEstado",function(event)
  {
      
     cargarSelectMunicipios();

  });

  $("body").on("change","#slMunicipio",function(event)
  {
      
     cargarSelectLocalidades();

  });



function cargarSelectRFC()
{
    $.ajax(
    {
      
      type: "POST",
      url: base_url+"RegistrarUsuarios/getDataSelectRFC",
      dataType:"json",
      data: '',
      async: true,
        success: function(result)
            {

                if(result.length > 0)
                {
                  let options ="";
                   result.forEach(function(elemento,index) 
                   {
  
                       options += '<option value="'+elemento.rfc+'">'+elemento.nombre+'</option>';
                      

                  });


                   $("#slRFC").append(options);

                }
              
            },
       error:function(result)
          {
            alert("Error");
           console.log(result.responseText);
            
          }
    });

}
cargarSelectRFC();

function cargarSelectEstado()
{
    $.ajax(
    {
      
      type: "POST",
      url: base_url+"RegistrarUsuarios/cargarSelectEstado",
      dataType:"json",
      data: '',
      async: true,
        success: function(result)
            {

                if(result.length > 0)
                {
                  let options ="";
                   result.forEach(function(elemento,index) 
                   {
  
                       options += '<option value="'+elemento.id_estado+'">'+elemento.nombre+'</option>';
                      

                  });


                   $("#slEstado").append(options);

                }
              
            },
       error:function(result)
          {
            alert("Error");
           console.log(result.responseText);
            
          }
    });

}
cargarSelectEstado();

function cargarSelectMunicipios()
{
   var datosEstado = { id_estado: $("#slEstado").val() }

    $.ajax(
    {
      
      type: "POST",
      url: base_url+"RegistrarUsuarios/cargarSelectMunicipios",
      dataType:"json",
      data: datosEstado,
      async: true,
        success: function(result)
            {

                if(result.length > 0)
                {
                  let options ="<option selected disabled >Elija una opción</option>";
                   result.forEach(function(elemento,index) 
                   {
  
                       options += '<option value="'+elemento.id_municipio+'">'+elemento.nombre+'</option>';
                      

                  });

                   $("#formRegistrarUsuario").data("bootstrapValidator").resetField("slMunicipio",true);
                   $("#formRegistrarUsuario").data("bootstrapValidator").resetField("slLocalidad",true);
                   $("#slLocalidad").empty().append("<option selected disabled >Elija una opción</option>");
                   $("#slMunicipio").empty().append(options);

                }
              
            },
       error:function(result)
          {
            alert("Error");
           console.log(result.responseText);
            
          }
    });

}

function cargarSelectLocalidades()
{
   var datosMunicipio = { id_municipio: $("#slMunicipio").val() }

    $.ajax(
    {
      
      type: "POST",
      url: base_url+"RegistrarUsuarios/cargarSelectLocalidades",
      dataType:"json",
      data: datosMunicipio,
      async: true,
        success: function(result)
            {

                if(result.length > 0)
                {
                  let options ="<option selected disabled >Elija una opción</option>";
                   result.forEach(function(elemento,index) 
                   {
  
                       options += '<option value="'+elemento.id_localidad+'">'+elemento.nombre+'</option>';
                      

                  });

                   // $("#formRegistrarUsuario").data("bootstrapValidator").resetField("slMunicipio",true);
                   $("#formRegistrarUsuario").data("bootstrapValidator").resetField("slLocalidad",true);
                   // $("#slLocalidad").empty().append("<option selected disabled >Elija una opción</option>");
                   $("#slLocalidad").empty().append(options);

                }
              
            },
       error:function(result)
          {
            alert("Error");
           console.log(result.responseText);
            
          }
    });

}





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
                        txtApellidoPa: {
                            group: '.form-group',
                            validators: {
                                notEmpty: {
                                    message: 'Este campo es requerido'
                                },
                                
                            }
                        },
                         txtApellidoMa: {
                            group: '.form-group',
                            validators: {
                                notEmpty: {
                                    message: 'Este campo es requerido'
                                },
                                
                            }
                        },
                        slRFC: {
                            group: '.form-group',
                            validators: {
                                notEmpty: {
                                    message: 'Selecciona el tipo de RFC'
                                },
                                
                            }
                        },
                        txtTelefono: {
                            group: '.form-group',
                            validators: {
                                notEmpty: {
                                    message: 'Este campo es requerido'
                                },
                                regexp: {
                                      regexp: /^\+?\d{1,3}?[- .]?\(?(?:\d{2,3})\)?[- .]?\d\d\d[- .]?\d\d\d\d$/,

                                      message: 'Solo números y debe contener entre 10 y 13 dígitos',

                                  },
                                
                            }
                        },
                        txtCelular: {
                            group: '.form-group',
                            validators: {
                                notEmpty: {
                                    message: 'Este campo es requerido'
                                },
                                regexp: {
                                      regexp: /^(\d{10})$/,

                                      message: 'Solo números y debe contener 10 digitos',

                                  },
                                
                            }
                        },
                        slEstado: {
                            group: '.form-group',
                            validators: {
                                notEmpty: {
                                    message: 'Selecciona el estado'
                                },
                                
                            }
                        },
                        slMunicipio: {
                            group: '.form-group',
                            validators: {
                                notEmpty: {
                                    message: 'Seleciona el municipio'
                                },
                                
                            }
                        },
                         slLocalidad: {
                            group: '.form-group',
                            validators: {
                                notEmpty: {
                                    message: 'selecciona la localidad'
                                },
                                
                            }
                        },
                        txtDomicilio: {
                            group: '.form-group',
                            validators: {
                                notEmpty: {
                                    message: 'Este campo es requerido'
                                },
                                
                            }
                        },
                         txtColonia: {
                            group: '.form-group',
                            validators: {
                                notEmpty: {
                                    message: 'Este campo es requerido'
                                },
                                
                            }
                        },
                        txtNumero: {
                            group: '.form-group',
                            validators: {
                                notEmpty: {
                                    message: 'Este campo es requerido'
                                },
                                
                            }
                        },
                        txtCorreo: {
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
                                                            correo:$("#txtCorreo").val()
                                                          }


                                                  $.ajax(
                                                  {
                                                      type: "POST",
                                                      url: base_url+"RegistrarUsuarios/checkEmail",
                                                    dataType:"json",
                                                      data: datosUsuario,
                                                       async: false,
                                                      success: function(result)
                                                          {

                                                              if(result.msjCantidadRegistros > 0)
                                                              {
                                                                 valida = false;
                                                              }
                                                              else
                                                              {
                                                                valida = true;
                                                              }
                                                           
                                                          },
                                                     error:function(result)
                                                        {
                                                          alert("Error");
                                                         console.log(result.responseText);
                                                          
                                                        }
                                                        
                                                  });

                                                  return valida;

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

                      var datosUsuario = {
                                            nombre:$("#txtNombre").val(),
                                            apellido_pa:$("#txtApellidoPa").val(),
                                            apellido_ma:$("#txtApellidoMa").val(),
                                            rfc:$("#slRFC").val(),
                                            telefono:$("#txtTelefono").val(),
                                            celular:$("#txtCelular").val(),
                                            id_estado:$("#slEstado").val(),
                                            id_municipio:$("#slMunicipio").val(),
                                            id_localidad:$("#slLocalidad").val(),
                                            domicilio:$("#txtDomicilio").val(),
                                            colonia:$("#txtColonia").val(),
                                            numero:$("#txtNumero").val(),
                                            correo:$("#txtCorreo").val(),
                                            correoCorp:$("#txtCorreoCorp").val(),
                                            password:$("#txtPassword").val(),
                                            id_rol:$("#slTipoUsuario").val(),
                                         }

                      $.ajax(
                                {
                                    type: "POST",
                                    url: base_url+"RegistrarUsuarios/insertarUsuario",
                                    dataType:"json",
                                    data: datosUsuario,
                                    async: true,
                                    success: function(result)
                                        {
                                          
                                          // $("#modalUsuarioRegistrado #base_url").val(result.base_url);
                                          $("#modalUsuarioRegistrado").modal("show");

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