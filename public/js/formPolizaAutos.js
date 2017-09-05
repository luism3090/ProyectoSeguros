$(document).ready(function()
{

	var base_url = $("body").attr("data-base-url");	


   validaFormRegistrarPolizaAutos();


   	    tablaClientes = $('#tblClientes').DataTable( 
      {
        "processing": true,
        "serverSide": true,
        "ordering": true,
         "select": 'single',
         "language": {
                        "url": base_url+"public/libreriasJS/Spanish.json"
                      },
                  "scrollY":        "500px",
                  "scrollCollapse": true,
        "ajax":{
          url :base_url+"Polizas/cargarClientes", 
          type: "post",  
          error: function(d){ 
            $(".employee-grid-error").html("");
            $("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No se encontraron datos</th></tr></tbody>');
            $("#employee-grid_processing").css("display","none");
            
          }
          // ,
          // success:function(d)
          // {
          //  console.log(d);
          // }
        },
        "columnDefs": [
                      {
                          "targets": [ 0 ],
                          "visible": false,
                          "searchable": false
                      }
                  ],
         
        

      } );



  $("body").on("submit","#formRegistrarPolizaAutos",function(event)
  {
   //alert();
  		event.preventDefault();

    $("#formRegistrarPolizaAutos").bootstrapValidator();

  });


  $('#modalAlert').on('hide.bs.modal', function (e) 
    {
         location.reload();
    });


  	function validaFormRegistrarPolizaAutos()
  	{



  			 $('#formRegistrarPolizaAutos').bootstrapValidator(
              {

                    message: 'This value is not valid',
                    container: 'tooltip',
                    feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {
                        slStatus: {
                           group: '.form-group',
                            validators: 
                            {
                                notEmpty: {
                                    message: 'Este campo es requerido'
                                },
                                

                            }
                        },
                        slTipo: {
                            group: '.form-group',
                            validators: {
                                notEmpty: {
                                    message: 'Este campo es requerido'
                                },
                                


                            }
                        },
                        
                      txtNoPoliza: {
                          group: '.form-group',
                          validators: {
                              notEmpty: {
                                  message: 'Este campo es requerido'
                              },

                          }
                      },
                       slAseguradora: {
                        group: '.form-group',
                          validators: {
                              notEmpty: {
                                  message: 'Este campo es requerido.'
                              }
                          }
                      }
                      ,
                       txtEmision: {
                        group: '.form-group',
                          validators: {
                              notEmpty: {
                                  message: 'Este campo es requerido.'
                              }
                          }
                      }
                       ,
                       dateInicia: {
                        group: '.form-group',
                          validators: {
                              notEmpty: {
                                  message: 'Este campo es requerido.'
                              }
                          }
                      }
                       ,
                       dateFinaliza: {
                        group: '.form-group',
                          validators: {
                              notEmpty: {
                                  message: 'Este campo es requerido.'
                              }
                          }
                      }
                       ,
                       txtValorComercial: {
                        group: '.form-group',
                          validators: {
                              notEmpty: {
                                  message: 'Este campo es requerido.'
                              }
                          }
                      }
                       ,
                       txtDescripcion: {
                        group: '.form-group',
                          validators: {
                              notEmpty: {
                                  message: 'Este campo es requerido.'
                              }
                          }
                      }

                      ,
                       txtMarca: {
                        group: '.form-group',
                          validators: {
                              notEmpty: {
                                  message: 'Este campo es requerido.'
                              }
                          }
                      }
                      ,
                       txtModelo: {
                        group: '.form-group',
                          validators: {
                              notEmpty: {
                                  message: 'Este campo es requerido.'
                              }
                          }
                      }
                      ,
                       txtAnio: {
                        group: '.form-group',
                          validators: {
                              notEmpty: {
                                  message: 'Este campo es requerido.'
                              }
                          }
                      }
                      ,
                       txtNoSerie: {
                        group: '.form-group',
                          validators: {
                              notEmpty: {
                                  message: 'Este campo es requerido.'
                              }
                          }
                      }
                      ,
                       txtPlacas: {
                        group: '.form-group',
                          validators: {
                              notEmpty: {
                                  message: 'Este campo es requerido.'
                              }
                          }
                      },


                       slFormaPago: {
                        group: '.form-group',
                          validators: {
                              notEmpty: {
                                  message: 'Este campo es requerido.'
                              }
                          }
                      }
                      ,
                       slMoneda: {
                        group: '.form-group',
                          validators: {
                              notEmpty: {
                                  message: 'Este campo es requerido.'
                              }
                          }
                      }
                      ,
                       slMedioPago: {
                        group: '.form-group',
                          validators: {
                              notEmpty: {
                                  message: 'Este campo es requerido.'
                              }
                          }
                      }
                      ,
                       txtPrimaAnual: {
                        group: '.form-group',
                          validators: {
                              notEmpty: {
                                  message: 'Este campo es requerido.'
                              }
                          }
                      }
                      ,
                       txtDescuento: {
                        group: '.form-group',
                          validators: {
                              notEmpty: {
                                  message: 'Este campo es requerido.'
                              }
                          }
                      }
                      ,
                       txtRecargos: {
                        group: '.form-group',
                          validators: {
                              notEmpty: {
                                  message: 'Este campo es requerido.'
                              }
                          }
                      }
                      ,
                       slIva: {
                        group: '.form-group',
                          validators: {
                              notEmpty: {
                                  message: 'Este campo es requerido.'
                              }
                          }
                      }
                      ,
                       txtDerechoPoliza: {
                        group: '.form-group',
                          validators: {
                              notEmpty: {
                                  message: 'Este campo es requerido.'
                              }
                          }
                      },

                      txtPrima: {
                        group: '.form-group',
                          validators: {
                              notEmpty: {
                                  message: 'Este campo es requerido.'
                              }
                          }
                      }
                      ,
                      txtObservaciones: {
                        group: '.form-group',
                          validators: {
                              notEmpty: {
                                  message: 'Este campo es requerido.'
                              }
                          }
                      }


                }
              }).on('success.form.bv', function (e) {

              	e.preventDefault();

              	if($("#tblClientes tbody tr").hasClass("selected"))
              	{

              		

              		datosPoliza = {
				              			id_status:$("#slStatus").val(),
				              			id_tipo :$("#slTipo").val(),
				              			id_aseguradora:$("#slAseguradora").val(),
				              			id_usuario: tablaClientes.rows($("#tblClientes tbody tr.selected").index()).data().pluck(0)[0],
				              			id_tipo_poliza:'1',
				              			no_poliza : $("#txtNoPoliza").val(),
				              			descripcion: $("#txtDescripcion").val(),
				              			emision: $("#txtEmision").val(), 
				              			fecha_inicia: $("#dateInicia").val(),
				              			fecha_finaliza:$("#dateFinaliza").val(),
				              			suma_asegurada:$("#chkSumaAsegurada").prop("checked"),
				              			valor_comercial:$("#txtValorComercial").val()

				              		}

			          // datosCompletosPoliza.push(poliza);

			          datosPolizaAuto = 
								          {
								          	marca: $("#txtMarca").val(),
								          	modelo: $("#txtModelo").val(),
								          	anio: $("#txtAnio").val(),
								          	no_serie: $("#txtNoSerie").val(),
								          	placas: $("#txtPlacas").val(),
								          }


			         // datosCompletosPoliza.push(polizaAuto);


			          datosPolizaPrima = 
								          {
								          	id_forma_pago: $("#slFormaPago").val(),
								          	id_moneda: $("#slMoneda").val(),
								          	id_medio_pago: $("#slMedioPago").val(),
								          	prima_neta_anual: $("#txtPrimaAnual").val(),
								          	descuento: $("#txtDescuento").val(),
								          	recargos: $("#txtRecargos").val(),
								          	iva: $("#txtIva").val(),
								          	derecho_poliza:  $("#txtDerechoPoliza").val(),
								          	prima: $("#txtPrima").val(),
								          	observaciones: $("#txtObservaciones").val()

								          }

              		// datosCompletosPoliza.push(polizaPrima);

              		 //console.log(datosCompletosPoliza);


              		$.ajax(
                            {
                                type: "POST",
                                url: base_url+"Polizas/registrarPolizaAutos",
                                dataType:"json",
                                data: {datosPoliza: datosPoliza , datosPolizaAuto :datosPolizaAuto , datosPolizaPrima : datosPolizaPrima},
                                async: true,
                                success: function(result)
                                    {
                                      
                                      if(result.msjConsulta=="OK")
                                      {
										$("#modalAlert .modal-body").html("<h4>La poliza de autos fue registra correctamente.<h4>");
              							$("#modalAlert").modal("show");
                                      }
                                      else
                                      {
                                      	$("#modalAlert .modal-body").html("<h4>Ocurrio un error al registrar la poliza de autos.<h4>");
              							$("#modalAlert").modal("show");
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
              		$("#btnGuardar").attr("disabled",false);
              		$("#modalAlert .modal-body").html("<h4>Debe seleccionar un cliente de la tabla <h4>");
              		$("#modalAlert").modal("show");
              		$(".form-control.input-sm").focus();
              		

              	}
                               // debugger;

                      //  var datosUsuarioUrl = "?nombre="+$("#txtNombre").val()+
                      //       "&apellidos="+$("#txtApellidos").val()+
                      //       "&email="+$("#txtEmail").val()+
                      //       "&password="+$("#txtPassword").val()+
                      //       "&id_rol="+$("#slTipoUsuario").val();


                      // var archivos = document.getElementById("fileFoto");  

                      //   var archivo = archivos.files;
                      //   var archivos = new FormData();
                      //   for(i=0; i<archivo.length;i++)
                      //   {
                      //     archivos.append('archivo',archivo[i])
                      //   }


                 //      $.ajax(
                 //            {
                 //                type: "POST",
                 //                url: "RegistrarUsuarios/insertarUsuario"+datosUsuarioUrl,
                 //                dataType:"json",
                 //                contentType:false,
                 //                processData:false,
                 //                data: archivos,
                 //                async: true,
                 //                success: function(result)
                 //                    {
                                      
                 //                      if(typeof(result.baja) == "undefined") 
                 //                      {
                 //                        $("#modalUsuarioRegistrado #base_url").val(result.base_url);
                 //                         $("#modalUsuarioRegistrado").modal("show");
                 //                      }
                 //                      else
                 //                      {
                 //                        window.location = result.url;
                 //                      }

                 //                    },
                 //               error:function(result)
                 //                  {
                 //                    alert("Error");
                 //                   console.log(result.responseText);
                                    
                 //                  }
                                  
                 // });          
                            



           });



  	}



});