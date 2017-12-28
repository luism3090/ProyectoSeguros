$(document).ready(function()
{

	var base_url = $("body").attr("data-base-url");	


     var hoy = new Date();
     var dd = hoy.getDate();
     var mm = hoy.getMonth()+1; 
     var yyyy = hoy.getFullYear();

     if(dd<10) {
         dd='0'+dd
     } 

     if(mm<10) {
         mm='0'+mm
     } 

     hoy = yyyy +'-' +mm+'-'+dd;


     $("#dateInicia").val(hoy);

     let masUnAnio = parseInt(yyyy) + 1; 

     hoyMaunAnio = masUnAnio +'-' +mm+'-'+dd;

     $("#dateFinaliza").val(hoyMaunAnio);


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


  $('#modalSuccessRegistroPoliza').on('hide.bs.modal', function (e) 
    {
          location.reload();
    });

  $("body").on("change","#slFormaPago",function()
  {
         
          let fechaInicial = "";
          let fechaFinaliza = "";
          let vector = [];

          vector = $("#dateInicia").val().split("-");
          fechaInicial = vector[2] + "/" +vector[1] + "/" +vector[0];

          $("#strFechaInicial").text(fechaInicial);

          vector = $("#dateFinaliza").val().split("-");
          fechaFinaliza = vector[2] + "/" +vector[1] + "/" +vector[0];

          $("#strFechaFinaliza").text(fechaFinaliza);


          let IdFormaDePago = $(this).val();
          let formaDePago =  $("#slFormaPago option:selected").text();

          let pagos = 0;
          let tempPagos = "";

          switch(IdFormaDePago)
          {
               case '1':

               $("#modalFormaDePago #tblFormaDePago tbody").html("");

                         for(let x=1 ; x<=4; x++)
                         {
                              tempPagos =    `
                                                   <tr >
                                                       <td>
                                                            <strong class='pagos'></strong>
                                                            <input type='text' class="form-control" name="pagoPoliza" class='pagoPoliza' readonly="readonly"/>
                                                       </td>
                                                       <td>
                                                            <strong class='pagos'></strong>
                                                            <input type='text' class="form-control" name="pagoPoliza" class='pagoPoliza' readonly="readonly"/>
                                                       </td>
                                                       <td>
                                                            <strong class='pagos'></strong>
                                                            <input type='text' class="form-control" name="pagoPoliza" class='pagoPoliza' readonly="readonly"/>
                                                       </td>
                                                   </tr>
          
                                             `;

                             $("#modalFormaDePago #tblFormaDePago tbody").append(tempPagos);
                         }

                           $("#modalFormaDePago .modal-body label").text(formaDePago);
                         

                           colocarFechasPagos(IdFormaDePago);

                           $("#modalFormaDePago").modal("show");

               break;


          } 
     

     

  });

  function colocarFechasPagos(IdFormaDePago)
  {

      var vector = $("#dateInicia").val().split("-");
      var fecha_inicial = vector[0] + "-" +vector[1] + "-" +vector[2]

      

          $.ajax(
                  {
                      type: "POST",
                      url: base_url+"Polizas/colocarFechasPagos",
                      dataType:"json",
                      data: {fecha_inicial: fecha_inicial, IdFormaDePago : IdFormaDePago},
                      async: true,
                      success: function(result)
                          {
                            
                            debugger;

                            if(result.status=="OK")
                            {

                                   if(IdFormaDePago == '1')
                                   {
                                        
                                        var fechaPago0 = result.fechaPagos[0].fechaPago0;


                                        $("#modalFormaDePago #tblFormaDePago tbody tr .pagos").eq(0).text(result.fechaPagos[0].fechaPago0);
                                        $("#modalFormaDePago #tblFormaDePago tbody tr .pagos").eq(1).text(result.fechaPagos[0].fechaPago1);
                                        $("#modalFormaDePago #tblFormaDePago tbody tr .pagos").eq(2).text(result.fechaPagos[0].fechaPago2);
                                        $("#modalFormaDePago #tblFormaDePago tbody tr .pagos").eq(3).text(result.fechaPagos[0].fechaPago3);
                                        $("#modalFormaDePago #tblFormaDePago tbody tr .pagos").eq(4).text(result.fechaPagos[0].fechaPago4);
                                        $("#modalFormaDePago #tblFormaDePago tbody tr .pagos").eq(5).text(result.fechaPagos[0].fechaPago5);
                                        $("#modalFormaDePago #tblFormaDePago tbody tr .pagos").eq(6).text(result.fechaPagos[0].fechaPago6);
                                        $("#modalFormaDePago #tblFormaDePago tbody tr .pagos").eq(7).text(result.fechaPagos[0].fechaPago7);
                                        $("#modalFormaDePago #tblFormaDePago tbody tr .pagos").eq(8).text(result.fechaPagos[0].fechaPago8);
                                        $("#modalFormaDePago #tblFormaDePago tbody tr .pagos").eq(9).text(result.fechaPagos[0].fechaPago9);
                                        $("#modalFormaDePago #tblFormaDePago tbody tr .pagos").eq(10).text(result.fechaPagos[0].fechaPago10);
                                        $("#modalFormaDePago #tblFormaDePago tbody tr .pagos").eq(11).text(result.fechaPagos[0].fechaPago11);
                                        
                                   }


                                   $("#modalSuccessRegistroPoliza .modal-body").html("<h4>La poliza de autos fue registra correctamente.<h4>");
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

  $("body").on("keyup","#txtPagoTotalPoliza",function()
  { 
         let formaPago = $("#tblFormaDePago tbody tr input").length;

         let pagoTotal = $("#txtPagoTotalPoliza").val().trim();

         if( !isNaN(pagoTotal) && pagoTotal != "" )
         {
          

               pagoTotal = parseInt($("#txtPagoTotalPoliza").val());

              let pagos = 0;

               switch(formaPago)
               {
                    case 12:

                         pagos = pagoTotal / 12;

                         $("#tblFormaDePago tbody tr input").val(pagos);

                    break;


               } 



         }
         else
         {
               $("#tblFormaDePago tbody tr input").val("");
         }

         


  });


     $("body").on("change","#dateInicia",function()
     {

          let  vector = [];
          let fecha_inicia = $("#dateInicia").val();

          vector = fecha_inicia.split("-");
          
          let anio =  parseInt(vector[0]) + 1;

          let fecha_fin = anio + "-" +vector[1] + "-" + vector[2];

          $("#dateFinaliza").val(fecha_fin);

     });

  $("body").on("click",'#chkSumaAsegurada',function()
  {
           let temp = '';

           if($(this).is(":checked"))
           {
               temp = `<label for="txtValorComercial">Valor comercial:</label>
                       <input type="text" id="txtValorComercial" name="txtValorComercial"  class="form-control" placeholder="Valor comercial" value="20" >`;                      

               $("#contValorComercial .form-group").html(temp);
           }
           else
           {
               $("#contValorComercial .form-group").html("");
           }
           


           $('#formRegistrarPolizaAutos').bootstrapValidator('addField','txtValorComercial',{
                    group: '.form-group',
                    validators: {
                    notEmpty: {
                        message: 'Este campo es requerido'
                    }

                }
          });



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
                        // slStatus: {
                        //    group: '.form-group',
                        //     validators: 
                        //     {
                        //         notEmpty: {
                        //             message: 'Este campo es requerido'
                        //         },
                                

                        //     }
                        // },
                        // slTipo: {
                        //     group: '.form-group',
                        //     validators: {
                        //         notEmpty: {
                        //             message: 'Este campo es requerido'
                        //         },
                                


                        //     }
                        // },
                        
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
                      // ,
                      //  txtEmision: {
                      //   group: '.form-group',
                      //     validators: {
                      //         notEmpty: {
                      //             message: 'Este campo es requerido.'
                      //         }
                      //     }
                      // }
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
                      //  ,
                      //  txtValorComercial: {
                      //   group: '.form-group',
                      //     validators: {
                      //         notEmpty: {
                      //             message: 'Este campo es requerido.'
                      //         }
                      //     }
                      // }
                      // 
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
				              			// id_status:$("#slStatus").val(),
				              			// id_tipo :$("#slTipo").val(),
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
									$("#modalSuccessRegistroPoliza .modal-body").html("<h4>La poliza de autos fue registra correctamente.<h4>");
              							$("#modalAlert").modal("show");
                                      }
                                      else
                                      {
                                             $("#modalSuccessRegistroPoliza .modal-body").html("<h4>Ocurrio un error al registrar la poliza de autos.<h4>");
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
              		$("#modalAlertValidaCliente .modal-body").html("<h4>Debe seleccionar un cliente de la tabla <h4>");
              		$("#modalAlertValidaCliente").modal("show");
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