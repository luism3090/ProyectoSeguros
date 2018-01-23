$(document).ready(function()
{

    var base_url = $("body").attr("data-base-url");



     $.ajax(
          {
                       type: "POST",
                       url: base_url+"PolizaDigitalCliente/getDatosPolizasCliente",
                       dataType:"json",
                       data: {'':''},
                       async: true,
                       success: function(result)
                           {
                                if(typeof(result.baja) == "undefined") 
                                {

                                     if(result.status=="OK")
                                     {

                                        let tempPolizasCliente = '';

                                        let rowPdfPoliza = '';

                                            
                                            $("body #tblLoadPolizasCliente tbody").html("");

                                            if(result.polizasCliente.length > 0)
                                            {

                                                $("#divClientePolizas").text(result.polizasCliente[0].cliente);
                                            }
                                            else
                                            {

                                                  $("#divClientePolizas").text(result.nombre);

                                                  let noData= `<tr class='noData' >
                                                                    <td  colspan='8' class='text-center'>Sin información disponible</td>
                                                              </tr>`;

                                                  $("body #tblLoadPolizasCliente tbody").html(noData);

                                            }

                                             

                                            result.polizasCliente.forEach(function(poliza) 
                                            {
                                                    
                                                    if(poliza.pdf_poliza != undefined)
                                                    {
                                                        rowPdfPoliza = `<a href='${base_url}/public/uploads/${poliza.pdf_poliza}' style ='text-decoration: underline;' download >Descargar póliza</a>`;    
                                                    }
                                                    else
                                                    {
                                                        rowPdfPoliza = `No hay póliza`;
                                                    }
                                                    
                                                   

                                                    //<td><input type='checkbox' class="form-control" style='height: 25px;' checked='checked' /></td>

                                                        tempPolizasCliente = `    <tr data-id_poliza='${poliza.id_poliza}' style='height:50px;'>
                                                                                        <td class='text-center'>
                                                                                            ${poliza.no_poliza}
                                                                                        </td>
                                                                                        <td class='text-center'>
                                                                                            ${poliza.tipoPoliza}
                                                                                        </td>
                                                                                        <td class='text-center'>
                                                                                            ${poliza.formaPago}
                                                                                        </td>
                                                                                        <td class='text-center'>
                                                                                            ${poliza.fecha_inicia}
                                                                                        </td>
                                                                                        <td class='text-center'>
                                                                                            ${poliza.fecha_finaliza}
                                                                                        </td>
                                                                                        <td class='text-center'>
                                                                                            ${poliza.aseguradora}
                                                                                        </td>
                                                                                        <td class='text-center'>
                                                                                            ${rowPdfPoliza}
                                                                                        </td>
                                                                                       
                                                                                 </tr>`;


                                                        $("body #tblLoadPolizasCliente tbody").append(tempPolizasCliente);

                                                        

                                            });

                                           // $("#modalLoadTablaPolizasCliente").modal("show");


                                     }
                                     else
                                     {
                                            // $("#modalSuccessRegistroPoliza .modal-body").html(result.msjConsulta);
                                            //  $("#modalSuccessRegistroPoliza").modal("show");
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



  $("body").on("click",".btnVerPolizas",function()
  {
    
        let id_usuario = tablaClientes.rows($(this).closest("tr").index()).data().pluck(0)[0];

        let cliente = tablaClientes.rows($(this).closest("tr").index()).data().pluck(1)[0];


        $("#modalCargarFilesPolizasUsuario").prop("cliente",cliente);
        $("#modalCargarFilesPolizasUsuario").prop("id_usuario",id_usuario);

        

  });
    
    

  


    



});
