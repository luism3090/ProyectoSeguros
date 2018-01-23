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
      
       		event.preventDefault();

         $("#formRegistrarPolizaAutos").bootstrapValidator();

       });


       $('#modalSuccessRegistroPoliza').on('hide.bs.modal', function (e) 
         {
               location.reload();
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


                                             if(IdFormaDePago == '2')
                                             {
                                                  
                                                  var fechaPago0 = result.fechaPagos[0].fechaPago0;


                                                  $("#modalFormaDePago #tblFormaDePago tbody tr .pagos").eq(0).text(result.fechaPagos[0].fechaPago0);
                                                  $("#modalFormaDePago #tblFormaDePago tbody tr .pagos").eq(1).text(result.fechaPagos[0].fechaPago1);
                                                  
                                                  
                                             }


                                              if(IdFormaDePago == '3')
                                             {
                                                  
                                                  var fechaPago0 = result.fechaPagos[0].fechaPago0;


                                                  $("#modalFormaDePago #tblFormaDePago tbody tr .pagos").eq(0).text(result.fechaPagos[0].fechaPago0);
                                                  $("#modalFormaDePago #tblFormaDePago tbody tr .pagos").eq(1).text(result.fechaPagos[0].fechaPago1);
                                                  $("#modalFormaDePago #tblFormaDePago tbody tr .pagos").eq(2).text(result.fechaPagos[0].fechaPago2);
                                                  $("#modalFormaDePago #tblFormaDePago tbody tr .pagos").eq(3).text(result.fechaPagos[0].fechaPago3);
                                                  
                                                  
                                             }


                                            
                                      }
                                      

                                    },
                               error:function(result)
                                  {
                                    alert("Error");
                                   console.log(result.responseText);
                                    
                                  }
                                  
                 });      
       }


       $("body").on("blur","#tblFormaDePago input:first",function()
       { 
              let formaPago = parseInt($("#tblFormaDePago tbody tr input").length);

              let pagoTotal = $("#txtPagoTotalPoliza").val().trim();

              let primerPago = $(this).val().trim();

              if( !isNaN(primerPago) && primerPago != "" )
              {
               
                    pagoTotal = parseFloat($("#txtPagoTotalPoliza").val());

                   let pagos = 0;

                    switch(formaPago)
                    {
                         case 12:

                              pagos = (pagoTotal - primerPago) / 11;

                              $("#tblFormaDePago tbody tr .pagoPoliza").val(Math.round(pagos * 100) / 100);

                         break;

                         case 2:

                              pagos = (pagoTotal - primerPago) / 1;

                              $("#tblFormaDePago tbody tr .pagoPoliza").val(Math.round(pagos * 100) / 100);

                         break;

                         case 4:

                              pagos = (pagoTotal - primerPago) / 3;

                              $("#tblFormaDePago tbody tr .pagoPoliza").val(Math.round(pagos * 100) / 100);

                         break;


                    } 



              }
              else
              {
                    $("#tblFormaDePago tbody tr input").val("");
              }

              


       });



       $("body").on("keyup","#tblFormaDePago input:first",function()
       { 
              let formaPago = parseInt($("#tblFormaDePago tbody tr input").length);

              let pagoTotal = $("#txtPagoTotalPoliza").val().trim();

              let primerPago = $(this).val().trim();

              if( !isNaN(primerPago) && primerPago != "" )
              {
               
                    pagoTotal = parseFloat($("#txtPagoTotalPoliza").val());

                   let pagos = 0;

                    switch(formaPago)
                    {
                         case 12:

                              pagos = (pagoTotal - primerPago) / 11;

                              $("#tblFormaDePago tbody tr .pagoPoliza").val(Math.round(pagos * 100) / 100);

                         break;

                         case 2:

                              pagos = (pagoTotal - primerPago) / 1;

                              $("#tblFormaDePago tbody tr .pagoPoliza").val(Math.round(pagos * 100) / 100);

                         break;

                         case 4:

                              pagos = (pagoTotal - primerPago) / 3;

                              $("#tblFormaDePago tbody tr .pagoPoliza").val(Math.round(pagos * 100) / 100);

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
                            <input type="text" id="txtValorComercial" name="txtValorComercial"  class="form-control" placeholder="Valor comercial" >`;                      

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
                         },
                         regexp: {
                            regexp: /^[0-9]+$/,

                            message: 'Solo debe ingresar números',

                        },

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
                                        },
                                        regexp: {
                                            regexp: /^[0-9.]+$/,

                                            message: 'Solo debe ingresar números',

                                        },
                                    }
                                }
                                ,
                                 txtDescuento: {
                                  group: '.form-group',
                                    validators: {
                                        notEmpty: {
                                            message: 'Este campo es requerido.'
                                        },
                                        regexp: {
                                            regexp: /^[0-9]+$/,

                                            message: 'Solo debe ingresar números',

                                        },
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
                                


                          }
                        }).on('success.form.bv', function (e) {

                             	e.preventDefault();

                              if($(".PrimerpagoPoliza").val().trim() !="")
                              {
                                        if($("#tblClientes tbody tr").hasClass("selected"))
                                        {

                                                  

                                                    let  datosPoliza = {
                                                                id_aseguradora:$("#slAseguradora").val(),
                                                                id_usuario: tablaClientes.rows($("#tblClientes tbody tr.selected").index()).data().pluck(0)[0],
                                                                id_tipo_poliza:'1',
                                                                no_poliza : $("#txtNoPoliza").val().trim(),
                                                                descripcion: $("#txtDescripcion").val().trim(),
                                                                fecha_inicia: $("#dateInicia").val(),
                                                                fecha_finaliza:$("#dateFinaliza").val(),
                                                                suma_asegurada: $("#chkSumaAsegurada").is(":checked") ? '1' : '0' ,
                                                                valor_comercial: $("#txtValorComercial").val() == undefined ? '' : $("#txtValorComercial").val().trim() 

                                                              }

                                                    // datosCompletosPoliza.push(poliza);

                                                   let datosPolizaAuto = 
                                                              {
                                                                marca: $("#txtMarca").val().trim(),
                                                                modelo: $("#txtModelo").val().trim(),
                                                                anio: $("#txtAnio").val().trim(),
                                                                no_serie: $("#txtNoSerie").val().trim(),
                                                                placas: $("#txtPlacas").val().trim(),
                                                              }


                                                   // datosCompletosPoliza.push(polizaAuto);


                                                  let datosPolizaPrima = 
                                                              {
                                                                id_forma_pago: $("#slFormaPago").val(),
                                                                pago_total: $("#txtPagoTotalPoliza").val().trim(),
                                                                id_moneda: $("#slMoneda").val(),
                                                                id_medio_pago: $("#slMedioPago").val(),
                                                                prima_neta_anual: $("#txtPrimaAnual").val().trim(),
                                                                descuento: $("#txtDescuento").val().trim(),
                                                                iva: $("#slIva").val(),
                                                                pago_prima_descuento:  $("#txtPago").val().trim()
                                                                

                                                              }


                                                    let datosPagos = [];


                                                    $("#tblFormaDePago tbody input").each(function(value,index)
                                                    {

                                                           let pagos = {

                                                                      fecha_pago:$(this).siblings().eq(0).text().split("/")[2] + "-" + $(this).siblings().eq(0).text().split("/")[1] + "-" + $(this).siblings().eq(0).text().split("/")[0],
                                                                      cantidad_pago : $(this).val().trim(),
                                                                      pagado : ''
                                                           }


                                                           datosPagos.push(pagos);

                                                    });

                                                      // datosCompletosPoliza.push(polizaPrima);

                                                       //console.log(datosPagos);


                                                      $.ajax(
                                                                {
                                                                    type: "POST",
                                                                    url: base_url+"Polizas/registrarPolizaAutos",
                                                                    dataType:"json",
                                                                    data: {datosPoliza: datosPoliza , datosPolizaAuto :datosPolizaAuto , datosPolizaPrima : datosPolizaPrima, datosPagos : datosPagos},
                                                                    async: true,
                                                                    success: function(result)
                                                                        {
                                                                          
                                                                          if(result.msjConsulta=="OK")
                                                                          {
                                                                                $("#modalSuccessRegistroPoliza .modal-body").html("<h4>La poliza de autos fue registra correctamente.<h4>");
                                                                                $("#modalSuccessRegistroPoliza").modal("show");
                                                                          }
                                                                          else
                                                                          {
                                                                                 $("#modalSuccessRegistroPoliza .modal-body").html("<h4>Ocurrio un error al registrar la poliza de autos.<h4>");
                                                                                  $("#modalSuccessRegistroPoliza").modal("show");
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
                              }
                              else
                              {
                                  $("#btnGuardar").attr("disabled",false);
                                  $("#modalAlertValidaCliente .modal-body").html("<h4>Debe seleccionar la forma de pago e ingresar el primer pago<h4>");
                                  $("#modalAlertValidaCliente").modal("show");
                                  $("#slFormaPago").focus();
                              }


                         });



       	}



          formValidaPagoTotal();

          function formValidaPagoTotal()
          {

                     $('#formValidaPagoTotal').bootstrapValidator(
                     {

                              message: 'This value is not valid',
                              container: 'tooltip',
                              feedbackIcons: {
                                  valid: 'glyphicon glyphicon-ok',
                                  invalid: 'glyphicon glyphicon-remove',
                                  validating: 'glyphicon glyphicon-refresh'
                              },
                              fields: {
                                  // txtPagoTotalPoliza: {
                                  //    group: '.form-group',
                                  //     validators: 
                                  //     {
                                  //         notEmpty: {
                                  //             message: 'Este campo es requerido'
                                  //         },
                                  //         regexp: {
                                  //           regexp: /^[0-9]+$/,

                                  //           message: 'Solo debe ingresar números',

                                  //       },

                                  //     }
                                  // },
                     }
                     }).on('success.form.bv', function (e) {

                              e.preventDefault();

                                 $("#modalFormaDePago").prop("formaPago",$("#slFormaPago option:selected").text());
                                 $("#modalFormaDePago").modal("hide");


                                 $("#datosSavePago").html("<input type='button' class='btn btn-primary btn-xs' id='btnInfoDatosPagos' value='Guardado' />");

                                 $("#datosSavePago").closest(".col-xs-6").css("height","65px");

                                 $("#datosSavePago").closest(".form-group").css("margin-top:","-5px");

                                 
                                 $('#btnAceptarPagos').attr('disabled',false);
                                 


                     });

          }


          $("body").on("click","#btnInfoDatosPagos",function()
          {
               let pago = $("#txtPago").val().trim();
               $("#txtPagoTotalPoliza").val(Math.round(pago * 100) / 100);
               
              
               $("#modalFormaDePago").modal("show");

               // $("#modalFormaDePago").css("display","block");

               // if($("#PrimerpagoPoliza").val()=="")
               // {
               //      $("#formValidaPagoTotal").bootstrapValidator('resetForm', true);

               // }
               
              
          });
          

         

          $("body").on("change","#slFormaPago",function()
          {
                   let pagoTotal = parseFloat($("#txtPago").val());

                   if(pagoTotal > 0 )
                   {

                         $("#txtPagoTotalPoliza").val(Math.round(pagoTotal * 100) / 100);

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

                                         var temp = '';

                                        for(let x=1 ; x<=4; x++)
                                        {

                                             if( x==1 )
                                             {
                                                

                                                  temp =  `<div class="form-group">
                                                           <strong class='pagos' style='margin-left:65px;' ></strong>
                                                           <input type='text' class="form-control PrimerpagoPoliza" name='PrimerpagoPoliza' />
                                                           </div>`;
                                             }
                                             else
                                             {
                                                  temp = `<strong class='pagos' style='margin-left:65px;'></strong>
                                                          <input type='text' class="form-control pagoPoliza" name='pagoPoliza' readonly="readonly"/>`;
                                             }


                                             tempPagos =    `
                                                                  <tr >
                                                                      <td>
                                                                           ${temp}
                                                                      </td>
                                                                      <td>
                                                                           <strong class='pagos' style='margin-left:65px;'></strong>
                                                                           <input type='text' class="form-control pagoPoliza" name='pagoPoliza' readonly="readonly"/>
                                                                      </td>
                                                                      <td>
                                                                           <strong class='pagos' style='margin-left:65px;'></strong>
                                                                           <input type='text' class="form-control pagoPoliza" name='pagoPoliza' readonly="readonly"/>
                                                                      </td>
                                                                  </tr>
                         
                                                            `;

                                            $("#modalFormaDePago #tblFormaDePago tbody").append(tempPagos);

                                   
                                        }


                                         $('#formValidaPagoTotal').bootstrapValidator('addField','PrimerpagoPoliza',{
                                                 group: '.form-group',
                                                 validators: {
                                                     notEmpty: {
                                                         message: 'Este campo es requerido'
                                                     },
                                                    regexp: {
                                                      regexp: /^[0-9.]+$/,

                                                      message: 'Solo debe ingresar números',

                                                  },
                                                  callback: 
                                                  {
                                                      message: 'El primer pago no puede ser mayor al Pago Total $'+$("#txtPagoTotalPoliza").val() ,
                                                      callback: function(value, validator) {

                                                          
                                                                 let primerPago =  parseFloat($(".PrimerpagoPoliza").val());

                                                                 let pagoTotalPoliza = parseFloat($("#txtPagoTotalPoliza").val());

                                                                 let valida = (primerPago > pagoTotalPoliza) ? false :  true ;
                                                                              
                                                                 return valida;

                                                            }
                                                       },


                                                 }
                                             });

                                         $("[data-bv-icon-for='PrimerpagoPoliza']").css('top','20px');

                                            $("[data-bv-icon-for='PrimerpagoPoliza']").closest(".form-group.has-feedback").css('margin-bottom','3px');

                                          $("#modalFormaDePago .modal-title label").text(formaDePago);

                                          $("#modalFormaDePago #tblFormaDePago").css("height","280px");
                                      
                                          colocarFechasPagos(IdFormaDePago);

                                          $("#modalFormaDePago").modal("show");
                                          
                                          $("#formValidaPagoTotal").data("bootstrapValidator").resetField("PrimerpagoPoliza",true);

                                         

                              break;

                              case '3':

                                   
                                   $("#modalFormaDePago #tblFormaDePago tbody").html("");

                                         
                                         var temp = '';

                                        for(let x=1 ; x<=2; x++)
                                        {

                                             if( x==1 )
                                             {
                                                  temp =  `<div class="form-group">
                                                                <strong class='pagos' style='margin-left:110px;' ></strong>
                                                                <input type='text' class="form-control PrimerpagoPoliza" name='PrimerpagoPoliza' />
                                                           </div>`;
                                             }
                                             else
                                             {
                                                  temp = `<strong class='pagos' style='margin-left:110px;'></strong>
                                                          <input type='text' class="form-control pagoPoliza" name='pagoPoliza' readonly="readonly"/>`;

                                             }

                                             tempPagos =    `
                                                                  <tr >
                                                                      <td>
                                                                           ${temp}
                                                                      </td>
                                                                      <td>
                                                                           <strong class='pagos' style='margin-left:110px;'></strong>
                                                                           <input type='text' class="form-control pagoPoliza" name='pagoPoliza' readonly="readonly"/>
                                                                      </td>
                                                                  </tr>`;

                                            $("#modalFormaDePago #tblFormaDePago tbody").append(tempPagos);

                                        

                                        }

                                        $('#formValidaPagoTotal').bootstrapValidator('addField','PrimerpagoPoliza',{
                                                 group: '.form-group',
                                                 validators: {
                                                     notEmpty: {
                                                         message: 'Este campo es requerido'
                                                     },
                                                    regexp: {
                                                      regexp: /^[0-9.]+$/,

                                                      message: 'Solo debe ingresar números',

                                                  },
                                                  callback: 
                                                  {
                                                      message: 'El primer pago no puede ser mayor al Pago Total $'+$("#txtPagoTotalPoliza").val() ,
                                                      callback: function(value, validator) {

                                                          
                                                                 let primerPago =  parseFloat($(".PrimerpagoPoliza").val());

                                                                 let pagoTotalPoliza = parseFloat($("#txtPagoTotalPoliza").val());

                                                                 let valida = (primerPago > pagoTotalPoliza) ? false :  true ;
                                                                              
                                                                 return valida;

                                                            }
                                                       },


                                                 }
                                             });
                                        

                                         $("[data-bv-icon-for='PrimerpagoPoliza']").css('top','20px');

                                        $("[data-bv-icon-for='PrimerpagoPoliza']").closest(".form-group.has-feedback").css('margin-bottom','3px');

                                          $("#modalFormaDePago .modal-title label").text(formaDePago);

                                          $("#modalFormaDePago #tblFormaDePago").css("height","130px");

                                          colocarFechasPagos(IdFormaDePago);

                                          $("#modalFormaDePago").modal("show");

                                          $("#formValidaPagoTotal").data("bootstrapValidator").resetField("PrimerpagoPoliza",true);


                              break;


                              case '2':

                                     

                                   $("#modalFormaDePago #tblFormaDePago tbody").html("");

                                             tempPagos =    `
                                                                  <tr >
                                                                      <td>
                                                                           <div class="form-group">
                                                                               <strong class='pagos' style='margin-left:110px;' ></strong>
                                                                               <input type='text' class="form-control PrimerpagoPoliza" name='PrimerpagoPoliza' />
                                                                           </div>
                                                                           
                                                                      </td>
                                                                      <td>
                                                                           <strong class='pagos' style='margin-left:110px;'></strong>
                                                                           <input type='text' class="form-control pagoPoliza" name='pagoPoliza' readonly="readonly"/>
                                                                      </td>
                                                                  </tr>`;

                                            $("#modalFormaDePago #tblFormaDePago tbody").append(tempPagos);
                                            
                                        
                                        $('#formValidaPagoTotal').bootstrapValidator('addField','PrimerpagoPoliza',{
                                                 group: '.form-group',
                                                 validators: {
                                                     notEmpty: {
                                                         message: 'Este campo es requerido'
                                                     },
                                                    regexp: {
                                                      regexp: /^[0-9.]+$/,

                                                      message: 'Solo debe ingresar números',

                                                  },
                                                  callback: 
                                                  {
                                                      message: 'El primer pago no puede ser mayor al Pago Total $'+$("#txtPagoTotalPoliza").val() ,
                                                      callback: function(value, validator) {

                                                          
                                                                 let primerPago =  parseFloat($(".PrimerpagoPoliza").val());

                                                                 let pagoTotalPoliza = parseFloat($("#txtPagoTotalPoliza").val());

                                                                 let valida = (primerPago > pagoTotalPoliza) ? false :  true ;
                                                                              
                                                                 return valida;

                                                            }
                                                       },


                                                 }
                                             });

                                        $("[data-bv-icon-for='PrimerpagoPoliza']").css('top','20px');

                                        $("[data-bv-icon-for='PrimerpagoPoliza']").closest(".form-group.has-feedback").css('margin-bottom','3px');

                                          $("#modalFormaDePago .modal-title label").text(formaDePago);

                                          $("#modalFormaDePago #tblFormaDePago").css("height","150px");
                                        
                                          colocarFechasPagos(IdFormaDePago);

                                          $("#modalFormaDePago").modal("show");

                                          $("#formValidaPagoTotal").data("bootstrapValidator").resetField("PrimerpagoPoliza",true);



                              break;

                              default :


                                         $("#modalFormaDePago #tblFormaDePago tbody").html("");

                                             tempPagos =    `
                                                                  <tr >
                                                                      <td>
                                                                           <strong class='pagos' style='margin-left:280px;' >${fechaFinaliza}</strong>
                                                                           <input type='text' class="form-control" name="pagoPoliza" class='pagoPoliza' readonly="readonly" value='${pagoTotal}'/>
                                                                      </td>
                                                                      <td>
                                                                  </tr>
                         
                                                            `;

                                            $("#modalFormaDePago #tblFormaDePago tbody").append(tempPagos);
                                            
                                   

                                          $("#modalFormaDePago .modal-title label").text(formaDePago);

                                          $("#modalFormaDePago").modal("show");

                                          $("#modalFormaDePago #tblFormaDePago").css("height","130px");


                              break;


                         } 


                   }
                   else
                   {
                         

                         $("#formRegistrarPolizaAutos").data("bootstrapValidator").resetField("slFormaPago",true);
                         $("#slFormaPago option[value='0']").removeAttr("selected");
                         $("#slFormaPago option[value='0']").attr("selected",true);
                         

                         $("#modalAlertValidaDatosPagos .modal-body").html("Antes de elegir la forma de pago genere el Pago Total: $")
                         $("#modalAlertValidaDatosPagos").modal("show");


                   }


          });


          

          $("body").on("click","#btnCancelarPagos",function()
          {

               $("#modalFormaDePago #tblFormaDePago tbody .pagoPoliza").val("");

               $("#formValidaPagoTotal").bootstrapValidator('resetForm', true);
               $("#btnInfoDatosPagos").remove();

          });


      $("body").on("keyup","#txtPrimaAnual, #txtDescuento",function()
      {

               if($("#txtPrimaAnual").val().trim() != '' && !isNaN($("#txtPrimaAnual").val().trim()) )
                {
                   if($("#txtDescuento").val().trim()!= '' && !isNaN($("#txtDescuento").val().trim()) )
                  {
                       let primaNetaAnual = parseFloat($("#txtPrimaAnual").val().trim());

                       let descuento = parseFloat($("#txtDescuento").val().trim());

                        let pago = 0;

                             if(descuento > 0)
                             {
                                 descuento =  descuento / 100;

                                 let primerDescuento =  primaNetaAnual * descuento;

                                 let iva = parseInt($("#slIva").val());

                                 iva =  iva / 100;

                                 let segundoDescuento = primerDescuento * iva;

                                  pago = primerDescuento + segundoDescuento;
                             }
                             else
                             {

                                 let iva = parseInt($("#slIva").val());

                                 iva =  iva / 100;

                                 let result = primaNetaAnual * iva;

                                 pago = primaNetaAnual + result;
                             }


                       $("#txtPago").val(Math.round(pago * 100) / 100);
                       $(".pagoPoliza").val("");
                       $("#modalFormaDePago").css("display","block");
                       $("#formValidaPagoTotal").bootstrapValidator('resetForm', true);
                       $("#modalFormaDePago").css("display","none");

                       
                  }
                  else
                  {
                     $("#txtPago").val("0");
                     $(".pagoPoliza").val("");
                     $("#modalFormaDePago").css("display","block");
                     $("#formValidaPagoTotal").bootstrapValidator('resetForm', true);
                     $("#modalFormaDePago").css("display","none");

                     
                  }

                }
                else
                {
                  $("#txtPago").val("0");
                  $(".pagoPoliza").val("");
                  $("#modalFormaDePago").css("display","block");
                  $("#formValidaPagoTotal").bootstrapValidator('resetForm', true);
                  $("#modalFormaDePago").css("display","none");
                  
                }

           

      });


      $("body").on("change","#txtDescuento,#txtPrimaAnual",function()
      {
              
                  if($("#txtPrimaAnual").val().trim() != '' && !isNaN($("#txtPrimaAnual").val().trim()) )
                   {
                         if($("#txtDescuento").val().trim()!= '' && !isNaN($("#txtDescuento").val().trim()) )
                        {
                       
                               let primaNetaAnual = parseFloat($("#txtPrimaAnual").val().trim());

                               let descuento = parseFloat($("#txtDescuento").val().trim());

                                let pago = 0;

                                 if(descuento > 0)
                                 {
                                     descuento =  descuento / 100;

                                     let primerDescuento =  primaNetaAnual * descuento;

                                     let iva = parseInt($("#slIva").val());

                                     iva =  iva / 100;

                                     let segundoDescuento = primerDescuento * iva;

                                      pago = primerDescuento + segundoDescuento;
                                 }
                                 else
                                 {

                                     let iva = parseInt($("#slIva").val());

                                     iva =  iva / 100;

                                     let result = primaNetaAnual * iva;

                                     pago = primaNetaAnual + result;
                                 }

                             

                             $("#txtPago").val(Math.round(pago * 100) / 100);
                             $(".pagoPoliza").val("");
                             $("#modalFormaDePago").css("display","block");
                             $("#formValidaPagoTotal").bootstrapValidator('resetForm', true);
                            $("#modalFormaDePago").css("display","none");
                             
                        }
                        else
                        {
                           $("#txtPago").val("0");
                           $(".pagoPoliza").val("");
                           $("#modalFormaDePago").css("display","block");
                           $("#formValidaPagoTotal").bootstrapValidator('resetForm', true);
                           $("#modalFormaDePago").css("display","none");
                           
                        }

                  }
                  else
                  {
                    $("#txtPago").val("0");
                    $(".pagoPoliza").val("");
                    $("#modalFormaDePago").css("display","block");
                    $("#formValidaPagoTotal").bootstrapValidator('resetForm', true);
                    $("#modalFormaDePago").css("display","none");
                    
                  }

              
          

      });





});