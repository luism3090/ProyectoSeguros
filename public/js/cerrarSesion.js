$(document).ready(function()
{

  //validaFormUpdateUsuarioCab();

    $("#btnCerrarSesion").on("click",function()
    {

       $.ajax(
        {
              type: "POST",
              dataType: "json",
              url: "Home/cerrarSesion",
              data: "",
               async: true,
              success: function(result)
                  {
                    
                    if(!result.sesion)
                    {
                      location.href = result.base_url;
                    }
                  

                  },
           error:function(result)
              {
                
                console.log(result.responseText);
                //$("#error").html(data.responseText); 
              }
              
        });

    });

    // $("#btnUpdateMyData").on("click",function()
    // {
  
      
    //    $.ajax(
    //     {
    //           type: "POST",
    //           dataType: "json",
    //           url: "Home/actualizarDatosUsuario",
    //           data: "",
    //            async: true,
    //           success: function(result)
    //               {

    //                 if(typeof(result.baja) == "undefined") 
    //                 {

    //                     $("#modalUpdateUsuarioCabecera #txtNombreCab").val(result.usuario[0].nombre);
    //                     $("#modalUpdateUsuarioCabecera #txtApellidosCab").val(result.usuario[0].apellidos);
    //                     $("#modalUpdateUsuarioCabecera #txtEmailCab").val(result.usuario[0].email);
    //                     $("#modalUpdateUsuarioCabecera #txtIdUsuarioCab").val(result.usuario[0].id_usuario);
    //                     $("#modalUpdateUsuarioCabecera #txtPasswordCab").val(result.usuario[0].password);
    //                     $("#modalUpdateUsuarioCabecera #slTipoUsuarioCab option[value="+result.usuario[0].id_rol+"]").prop('selected', 'selected');
    //                     var urlFoto = "";

    //                     if(result.usuario[0].foto!="default_avatar.png")
    //                     {
    //                         urlFoto = result.base_url+result.usuario[0].foto;
    //                     }
                        
                          
    //                       var urlFotoDefault = result.base_url+"default_avatar.png";

    //                       loadFilesCab(urlFoto,urlFotoDefault);

    //                     $("#modalUpdateUsuarioCabecera .kv-file-remove.btn.btn-xs.btn-default , #modalUpdateUsuarioCabecera .file-upload-indicator").remove();
    //                     $("#modalUpdateUsuarioCabecera .file-drag-handle.drag-handle-init.text-info").remove();
    //                     $("#modalUpdateUsuarioCabecera .file-preview-image.kv-preview-data").css("width","160px");
    //                     $("#modalUpdateUsuarioCabecera .file-input.theme-explorer button").css("margin","10px");
    //                     $("#modalUpdateUsuarioCabecera #btnModificarUsuarioCab").prop("imagen",result.usuario[0].foto);
    //                     $("#modalUpdateUsuarioCabecera").modal("show");
                      
    //                 }
    //                 else
    //                 {
    //                    window.location = result.url;
                     
    //                 }
                  

    //               },
    //        error:function(result)
    //           {
                
    //             console.log(result.responseText);
    //             //$("#error").html(data.responseText); 
    //           }
              
    //      });

    // });


    //  function loadFilesCab(urlFoto,urlFotoDefault)
    //  {

    //    $('#fileFotoCab').fileinput('destroy');

    //     if( urlFoto.split(".")[1] === "pdf")
    //     {
    //        $('#fileFotoCab').fileinput({
    //                              showUpload: false,
    //                              browseOnZoneClick: true,              
    //                              language: 'es',
    //                              maxFileCount: 1,
    //                              showClose: false,
    //                              showCaption: false,
    //                              maxFileSize: 5000,
    //                              theme: 'explorer',                
    //                              allowedFileExtensions: ['jpg','png','gif','pdf'],
    //                              initialPreview: urlFoto,
    //                              initialPreviewAsData: true,
    //                              initialPreviewConfig: [
                                                 
    //                                              {type: "pdf", size: 5000, caption: "Archivo", url: urlFoto},
                                                 
    //                                          ],
    //                             defaultPreviewContent: '<img src="'+urlFotoDefault+'" alt="Tu Avatar" style="width:160px"><h6 class="text-muted">Clic para subir tu foto</h6>',
    //                              removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
    //                            removeTitle: 'Remover archivo',
    //                          }); 
    //     }
    //     else
    //     {
    //        $('#fileFotoCab').fileinput({
    //                              showUpload: false,
    //                              browseOnZoneClick: true,              
    //                              language: 'es',
    //                              maxFileCount: 1,
    //                              showClose: false,
    //                              showCaption: false,
    //                              maxFileSize: 5000,
    //                              theme: 'explorer',                
    //                              allowedFileExtensions: ['jpg','png','gif','pdf'],
    //                              initialPreview: urlFoto,
    //                              initialPreviewAsData: true,
    //                              initialPreviewConfig: [
                                                 
    //                                              {type: "image", size: 5000, caption: "imagen", url: urlFoto },
                                                 
    //                                          ],
    //                             defaultPreviewContent: '<img src="'+urlFotoDefault+'" alt="Tu Avatar" style="width:160px"><h6 class="text-muted">Clic para subir tu foto</h6>',
    //                              removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
    //                            removeTitle: 'Remover archivo',
    //                          }); 
    //     }

        
    //  }


    //  $("body").on("submit","#FormUpdateUsuarioCabecera",function(event)
    // {

    //   event.preventDefault();

    //   validaFormUpdateUsuarioCab();

    // });

    //  function validaFormUpdateUsuarioCab()
    // {


    //       $('#FormUpdateUsuarioCabecera').bootstrapValidator(
    //       {

    //             message: 'This value is not valid',
    //             container: 'tooltip',
    //             feedbackIcons: {
    //                 valid: 'glyphicon glyphicon-ok',
    //                 invalid: 'glyphicon glyphicon-remove',
    //                 validating: 'glyphicon glyphicon-refresh'
    //             },
    //             fields: {
    //                 txtNombreCab: {
    //                    group: '.form-group',
    //                     validators: 
    //                     {
    //                         notEmpty: {
    //                             message: 'Este campo es requerido'
    //                         },
                            

    //                     }
    //                 },
    //                 txtApellidosCab: {
    //                     group: '.form-group',
    //                     validators: {
    //                         notEmpty: {
    //                             message: 'Este campo es requerido'
    //                         },
                            


    //                     }
    //                 },
    //                 txtEmailCab: {
    //                   group: '.form-group',
    //                   validators: 
    //                   {
    //                       notEmpty: {
    //                           message: 'Este campo es requerido'
    //                       },
    //                        regexp: {
    //                               regexp: /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/,

    //                               message: 'La dirección de email no es válida',

    //                           },
    //                           callback: {
    //                           message: 'El Email ingresado no esta disponible',
    //                           callback: function(value, validator) {
    //                               // Get the selected options

    //                               var valida = true;

    //                               var datosUsuario = {
    //                                                     id_usuario : $("#txtIdUsuarioCab").val(),
    //                                                     email:$("#txtEmailCab").val()
    //                                                   }


    //                                           $.ajax(
    //                                           {
    //                                               type: "POST",
    //                                               url: "Usuarios/checkEmail",
    //                                               dataType:"json",
    //                                               data: datosUsuario,
    //                                                async: false,
    //                                               success: function(result)
    //                                                   {

    //                                                     if(typeof(result.baja) == "undefined") 
    //                                                     {
    //                                                       if(result.msjCantidadRegistros > 0)
    //                                                       {
    //                                                          valida = false;
    //                                                       }
    //                                                       else
    //                                                       {
    //                                                         valida = true;
    //                                                       }

    //                                                     }
    //                                                     else
    //                                                     {
    //                                                       window.location = result.url;
    //                                                     }
                                                        
    //                                                   },
    //                                              error:function(result)
    //                                                 {
    //                                                   alert("Error");
    //                                                  console.log(result.responseText);
                                                      
    //                                                 }
                                                    
    //                                           });

    //                                           return valida;

    //                               // var options = validator.getFieldElements('colors').val();
    //                               // return (options != null && options.length >= 2 && options.length <= 4);
    //                           }
    //                       },

    //                   }
    //               },
    //               txtPasswordCab: {
    //                   group: '.form-group',
    //                   validators: {
    //                       notEmpty: {
    //                           message: 'Este campo es requerido'
    //                       },
    //                       stringLength: {
    //                           enabled: true,
    //                           min: 5,
    //                           max: 20,
    //                           message: 'El password debe contener como mínimo 5 caracteres y 20 como máximo'
    //                       },

    //                   }
    //               },
    //                slTipoUsuarioCab: {
    //                 group: '.form-group',
    //                   validators: {
    //                       notEmpty: {
    //                           message: 'Seleciona un tipo de usuario.'
    //                       }
    //                   }
    //               }


    //         }
    //       }).on('success.form.bv', function (e) {
                

    //             var imagenBD = $("#modalUpdateUsuarioCabecera #btnModificarUsuarioCab").prop("imagen");

    //             var imagenLoad = "";

    //             if($("body .file-preview img").length > 0 )
    //             {
    //               imagenLoad = $("body .file-preview img").attr("src").split("/")[6];
    //             }
    //             if($("body .kv-file-content embed").length>0)
    //             {
    //               imagenLoad = $("body .kv-file-content embed").attr("src").split("/")[3]
    //             }

                

    //             var cambioImagen = "NO";

    //             if(imagenBD!=imagenLoad)
    //             {
    //                 cambioImagen = "SI";
    //             }

    //              var datosUsuarioUrl = "?id_usuario="+ $("#txtIdUsuarioCab").val()+
    //                                    "&id_rol= "+$("#slTipoUsuarioCab").val()+
    //                                    "&nombre="+$("#txtNombreCab").val()+
    //                                    "&apellidos="+$("#txtApellidosCab").val()+
    //                                    "&email="+$("#txtEmailCab").val()+
    //                                    "&password="+$("#txtPasswordCab").val()+
    //                                    "&cambioImagen="+cambioImagen;



    //                        var archivos = document.getElementById("fileFotoCab");  

    //                         var archivo = archivos.files;
    //                         var archivos = new FormData();
    //                         for(i=0; i<archivo.length;i++)
    //                         {
    //                           archivos.append('archivo',archivo[i])
    //                         }

    //                           $.ajax(
    //                           {
    //                               type: "POST",
    //                               url: "Usuarios/updateUsuarioCabecera"+datosUsuarioUrl,
    //                               dataType:"json",
    //                               contentType:false,
    //                               processData:false,
    //                               data: archivos,
    //                                async: true,
    //                               success: function(result)
    //                                   {
    //                                     //console.log(result);

    //                                     if(typeof(result.baja) == "undefined") 
    //                                     {
    //                                         $('#modalUpdateUsuarioCabecera').modal('hide');
    //                                         $("#modalAlertaUsuarioCabecera .modal-body").html(result.msjConsulta);
    //                                         $("#modalAlertaUsuarioCabecera").modal("show");
    //                                     }
    //                                     else
    //                                     {
    //                                         window.location = result.url;
    //                                     }
                                        

    //                                   },
    //                              error:function(result)
    //                                 {
    //                                   alert("Error");
    //                                  console.log(result.responseText);
                                      
    //                                 }
                                    
    //                           });



    //         });


    // }


    //  $('#modalUpdateUsuarioCabecera').on('hide.bs.modal', function (e) 
    // {
    //      $("#FormUpdateUsuarioCabecera").bootstrapValidator('resetForm', true);


    // })


    //  $('#modalAlertaUsuarioCabecera').on('hide.bs.modal', function (e) 
    // {
    //      location.reload();
    // });

      
    
});


  