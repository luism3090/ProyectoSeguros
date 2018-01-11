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



     var tblDetallePolizas = $('#tblDetallePolizas').DataTable( 
      {
        "processing": true,
        "serverSide": true,
        "ordering": true,
        "select": 'single',
          // "initComplete":function( settings, json){
             
          //    // $("#tblDetallePolizas tbody tr").each(function(index,value)
          //    //  {

          //    //      let no_ha_pagado = parseInt(tblDetallePolizas.rows($(this).closest("tr").index()).data().pluck(1)[0]);
          //    //      let dias_faltantes = parseInt(tblDetallePolizas.rows($(this).closest("tr").index()).data().pluck(2)[0]);

          //    //      debugger;

          //    //      if(no_ha_pagado >= 1)
          //    //      {
                    
          //    //        $(this).closest("tr").find(".colorButton").removeClass("btn btn-dark btn-lg colorButton").addClass("btn btn-danger btn-lg colorButton");
          //    //      }
          //    //      else
          //    //      {
          //    //        if(dias_faltantes == 1)
          //    //        {
                      
          //    //          $(this).closest("tr").find(".colorButton").removeClass("btn btn-dark btn-lg colorButton").addClass("btn btn-warning btn-lg colorButton");
          //    //        }
          //    //      }

          //    //  }); 


          // },
         "language": {
                        "url": base_url+"public/libreriasJS/Spanish.json"
                      },
                  "scrollY":        "500px",
                  "scrollCollapse": true,
        "ajax":{
          url :base_url+"Polizas/cargarDetallePolizas", 
          type: "post",  
          error: function(d){ 
            $(".employee-grid-error").html("");
            $("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No se encontraron datos</th></tr></tbody>');
            $("#employee-grid_processing").css("display","none");
            
          }
          // dataSrc: function (json) {
          //       //Make your callback here.

          //       console.log($("#tblDetallePolizas tbody tr").length);
          //       return json.data;

          //   }
        },
        "columnDefs": [
                      {
                          "targets": [ 0 ],
                          "visible": false,
                          "searchable": false
                      }
                     
                  ],
         
        

      } );



     $("body").on("click",".sendPagos",function()
      {


           let id_poliza =  tblDetallePolizas.rows($(this).closest("tr").index()).data().pluck(0)[0];

           let formaPago =  tblDetallePolizas.rows($(this).closest("tr").index()).data().pluck(4)[0];
           let fechaInicial =  tblDetallePolizas.rows($(this).closest("tr").index()).data().pluck(5)[0];
           let fechaFinal =  tblDetallePolizas.rows($(this).closest("tr").index()).data().pluck(6)[0];


            $.ajax(
                      {
                          type: "POST",
                          url: base_url+"Polizas/getPagosPoliza",
                          dataType:"json",
                          data: {id_poliza: id_poliza},
                          async: true,
                          success: function(result)
                              {

                                if(result.status=="OK")
                                {

                                    let tempPagos = '<tr>';

                                    $("#strFechaInicial").text(fechaInicial);
                                    $("#strFechaFinaliza").text(fechaFinal);

                                    $("#txtPagoTotalPoliza").text(result.pagos[0].pago_total);

                                    $("#lblFormaPago").text(formaPago);

                                     $("#modalPagosPoliza #tblFormaDePago tbody").html("");

                                     let checked = '';



                                    switch(result.numRegistros)
                                    {
                                        case 12:

                                                    for(let x = 0; x < result.pagos.length ; x++)
                                                    {

                                                         // var fecha1 = moment('2018-02-10');
                                                         var fecha1 = moment(hoy);
                                                         var fecha2 = result.pagos[x].fecha_pago.split("/")[2] + "/" + result.pagos[x].fecha_pago .split("/")[1] + "/" + result.pagos[x].fecha_pago .split("/")[0];
                                                          fecha2 = moment(fecha2); 

                                                         var diferenciaDias = fecha2.diff(fecha1, 'days');
                                                         var color = '';


                                                            if (result.pagos[x].pagado == '1')
                                                            {
                                                                checked = 'checked';
                                                                //color = 'green';
                                                            }
                                                            else
                                                            {
                                                                checked = '';   

                                                                if(diferenciaDias < 0)
                                                                {
                                                                    color = 'red';
                                                                }
                                                                else if(diferenciaDias >= 0 && diferenciaDias <= 10)
                                                                {
                                                                    color = 'orange';
                                                                }
                                                                else 
                                                                {
                                                                    color = 'black';
                                                                }

                                                            }




                                                            tempPagos +=    `     <td>
                                                                                      <strong class='pagos' style='margin-left:65px;color:${color}' >${result.pagos[x].fecha_pago } </strong>
                                                                                      <input type='checkbox' ${checked} style='height: 25px;'class="form-control hacerPagoPoliza" data-id_datos_forma_pago='${result.pagos[x].id_datos_forma_pago}' >
                                                                                      <input type='text' style='color:${color}' class="form-control" name="pagoPoliza" class='pagoPoliza' readonly="readonly" value='${result.pagos[x].cantidad_pago }' />
                                                                                 </td> `;

                                                            
                                                                 if(x== 3)
                                                                {
                                                                     tempPagos += `</tr><tr>`;
                                                                }

                                                                 if(x== 7)
                                                                {
                                                                     tempPagos += `</tr><tr>`;
                                                                }

                                                                if(x== 11)
                                                                {
                                                                     tempPagos += `</tr>`;
                                                                }
                                                        
                                                       



                                                    }

                                                $("#modalPagosPoliza #tblFormaDePago tbody").append(tempPagos);
                                                $("#modalPagosPoliza #tblFormaDePago").css("height","285px");
                                                $("#modalPagosPoliza #tblFormaDePago").css("width","768px");
                                                $("#modalPagosPoliza .modal-content").css("width","800px");


                                        break;

                                        case 4:


                                                for(let x = 0; x < result.pagos.length ; x++)
                                                {

                                                     var fecha1 = moment(hoy);
                                                     var fecha2 = result.pagos[x].fecha_pago.split("/")[2] + "/" + result.pagos[x].fecha_pago .split("/")[1] + "/" + result.pagos[x].fecha_pago .split("/")[0];
                                                     fecha2 = moment(fecha2); 

                                                     var diferenciaDias = fecha2.diff(fecha1, 'days');
                                                     var color = '';


                                                        if (result.pagos[x].pagado == '1')
                                                        {
                                                            checked = 'checked';
                                                           // color = 'green';
                                                        }
                                                        else
                                                        {
                                                            checked = '';   

                                                            if(diferenciaDias < 0)
                                                            {
                                                                color = 'red';
                                                            }
                                                            else if(diferenciaDias >= 0 && diferenciaDias <= 10)
                                                            {
                                                                color = 'orange';
                                                            }
                                                            else 
                                                            {
                                                                color = 'black';
                                                            }

                                                        }


                                                        tempPagos +=    `     <td>
                                                                                  <strong class='pagos' style='margin-left:115px;color:${color}' >${result.pagos[x].fecha_pago } </strong>
                                                                                  <input type='checkbox' ${checked} style='height: 25px;'class="form-control hacerPagoPoliza" data-id_datos_forma_pago='${result.pagos[x].id_datos_forma_pago}' >
                                                                                  <input type='text' style='color:${color}' class="form-control" name="pagoPoliza" class='pagoPoliza' readonly="readonly" value='${result.pagos[x].cantidad_pago }' />
                                                                             </td> `;

                                                        
                                                             if(x== 1)
                                                            {
                                                                 tempPagos += `</tr><tr>`;
                                                            }

                                                             if(x== 3)
                                                            {
                                                                 tempPagos += `</tr>`;
                                                            }
                                                    

                                                }

                                                $("#modalPagosPoliza #tblFormaDePago tbody").append(tempPagos);
                                                $("#modalPagosPoliza #tblFormaDePago").css("height","220px");
                                                $("#modalPagosPoliza #tblFormaDePago").css("width","600px");
                                                $("#modalPagosPoliza .modal-content").css("width","638px");

                                                


                                        break;

                                        default:

                                                 for(let x = 0; x < result.pagos.length ; x++)
                                                {

                                                     var fecha1 = moment(hoy);
                                                     var fecha2 = result.pagos[x].fecha_pago.split("/")[2] + "/" + result.pagos[x].fecha_pago .split("/")[1] + "/" + result.pagos[x].fecha_pago .split("/")[0];
                                                      fecha2 = moment(fecha2); 

                                                     var diferenciaDias = fecha2.diff(fecha1, 'days');
                                                     var color = '';


                                                        if (result.pagos[x].pagado == '1')
                                                        {
                                                            checked = 'checked';
                                                            //color = 'green';
                                                        }
                                                        else
                                                        {
                                                            checked = '';   

                                                            if(diferenciaDias < 0)
                                                            {
                                                                color = 'red';
                                                            }
                                                            else if(diferenciaDias >= 0 && diferenciaDias <= 10)
                                                            {
                                                                color = 'orange';
                                                            }
                                                            else 
                                                            {
                                                                color = 'black';
                                                            }

                                                        }




                                                        tempPagos +=    `     <td>
                                                                                  <strong class='pagos' style='margin-left:65px;color:${color}' >${result.pagos[x].fecha_pago } </strong>
                                                                                  <input type='checkbox' ${checked} style='height: 25px;'class="form-control hacerPagoPoliza" data-id_datos_forma_pago='${result.pagos[x].id_datos_forma_pago}' >
                                                                                  <input type='text' style='color:${color}' class="form-control" name="pagoPoliza" class='pagoPoliza' readonly="readonly" value='${result.pagos[x].cantidad_pago }' />
                                                                             </td> `;

                                                        
                                                             if(x== 1)
                                                            {
                                                                 tempPagos += `</tr>`;
                                                            }

                                                            

                                                }

                                                $("#modalPagosPoliza #tblFormaDePago tbody").append(tempPagos);
                                                $("#modalPagosPoliza #tblFormaDePago").css("height","120px");
                                                $("#modalPagosPoliza #tblFormaDePago").css("width","600px");
                                                $("#modalPagosPoliza .modal-content").css("width","638px");

                                        break;


                                    }

                                        

                                      $("#modalPagosPoliza").modal("show");
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

           

      });


    $("body").on("click",".hacerPagoPoliza",function()
    {

        let pagado = $(this).is(':checked') ? '1' : '0';
        let id_datos_forma_pago = $(this).attr("data-id_datos_forma_pago");

        let fecha =  $(this).siblings().text().split("/")[0] + "/" + $(this).siblings().text().split("/")[1] + "/" + $(this).siblings().text().split("/")[2];

        let fecha_ = $(this).siblings().text().trim().split("/")[2] + "/" + $(this).siblings().text().split("/")[1] + "/" + $(this).siblings().text().split("/")[0];
        
        if(pagado == '1')
        {   
            $(this).siblings().css("color","");
        }
        else
        {

             let fecha1 = moment(hoy);
            
             let fecha2 = moment(fecha_); 

             let diferenciaDias = fecha2.diff(fecha1, 'days');
             let color = '';

             if(diferenciaDias < 0)
             {
                 color = 'red';
             }
             else if(diferenciaDias >= 0 && diferenciaDias <= 10 )
             {
                 color = 'orange';
             }
             else 
             {
                 color = 'black';
             }

            $(this).siblings().css("color",color);


        }

         $.ajax(
                   {
                       type: "POST",
                       url: base_url+"Polizas/hacerPagosPoliza",
                       dataType:"json",
                       data: {pagado: pagado, id_datos_forma_pago :id_datos_forma_pago, fecha : fecha},
                       async: true,
                       success: function(result)
                           {

                               if(result.status=='OK')
                               {
                                    $("#modalSuccessPagoPoliza .modal-body").html(result.mensaje);
                                    $("#modalSuccessPagoPoliza").modal('show');
                               }
                               else
                               {
                                    $("#modalSuccessPagoPoliza .modal-body").html(result.mensaje);
                                    $("#modalSuccessPagoPoliza").modal('show');
                               }

                           },
                      error:function(result)
                         {
                           alert("Error");
                          console.log(result.responseText);
                           
                         }
                         
        });   





    });



     $('#modalPagosPoliza').on('hide.bs.modal', function (e) 
       {
             location.reload();
       });

   





});