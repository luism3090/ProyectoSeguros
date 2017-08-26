$(document).ready(function()
{


   $("body").on("submit","#formChangePassword",function(event)
    {

         event.preventDefault();

         validaFormChangePassword();

    });


validaFormChangePassword();


function validaFormChangePassword()
{

	$('#formChangePassword').bootstrapValidator(
          {

                message: 'This value is not valid',
                container: 'tooltip',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    password1: {
		                group: '.input-group',
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
		            password2: {
		                group: '.input-group',
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
          
          }
          }).on('success.form.bv', function (e,data) 
          {

            e.preventDefault();

            let $password1 = $("#password1").val();
            let $password2 = $("#password2").val();

            if($password1 == $password2)
            {

            	let datos = { password: $password1,
            				  token: window.location.href.split("=")[1]
            				} 
               
                  $.ajax(
                  {
                      type: "POST",
                      url: "actualizarPasswordUsuario",
                      dataType:"json",
                      data: datos,
                      async: true,
                      success: function(result)
                          {
                            // debugger;

                           	//console.log(result);

                            $("#modalAlertaCambioPasswordSuccess .modal-body p").text(result.msjUsuario);
                            $("#modalAlertaCambioPasswordSuccess").modal("show");

                             $('#formChangePassword').bootstrapValidator('destroy', true);
                             validaFormChangePassword();


                            if(result.msjConsulta=='OK')
                         	{
                         		$("#formChangePassword").prop("base_url",result.base_url);
                         	}



                          },
                     error:function(result)
                        {
                          alert("Error");
                         console.log(result.responseText);
                          
                        }
                        
                  });

            }
            else
            {

            	 $("#modalAlertaPasswordNocoinciden .modal-body p").text("Las contraseñas no coinciden");
            	 $("#modalAlertaPasswordNocoinciden").modal("show");
            	 $('#formChangePassword').bootstrapValidator('destroy', true);
                 validaFormChangePassword();
            }

          	


          });


}



 $('#modalAlertaCambioPasswordSuccess').on('hide.bs.modal', function (e) 
    {
         if( $("#formChangePassword").prop("base_url") != undefined)
         {
         	var base_url = $("#formChangePassword").prop("base_url");

         	window.location = base_url;

         }
         
    })


	// var datos = { token: window.location.href.split("=")[1] }

	// $.ajax(
 //                  {
 //                      type: "POST",
 //                      url: "verificarTokenChangePassword",
 //                      dataType:"json",
 //                      data: datos,
 //                      async: true,
 //                      success: function(result)
 //                          {
 //                            // debugger;

 //                           	// console.log(result);

 //                            //  if(result.msjCantidadRegistros>0)
 //                            //  {
                                

 //                            //  }
 //                            //  else
 //                            //  {
 //                            //     $(".container .panel-body").html('<h2 class="text-center">El formulario de cambio de contraseña ha caducado</h2>');
 //                            //  }


 //                          },
 //                     error:function(result)
 //                        {
 //                          alert("Error");
 //                         console.log(result.responseText);
                          
 //                        }
                        
 //                  });



});