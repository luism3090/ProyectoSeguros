$(document).ready(function()
{

    var base_url = $("body").attr("data-base-url");


	   var tablaClientes = $('#tblClientes').DataTable( 
      {
        "processing": true,
        "serverSide": true,
        "ordering": true,
         // "select": 'single',
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


	$('#modalCargarFilesPolizasUsuario').on('hide.bs.modal', function (e) 
    {
        $('#filePoliza').fileinput('clear');


		$("#formValidaUploadPoliza").bootstrapValidator('resetForm', true);
        
    });
	 


	$("body").on("click",".btnSubirPolizas",function()
	{
		
		//let id_usuario = tablaClientes.rows($(this).closest("tr").index()).data().pluck(0)[0];

        let id_poliza = $(this).closest("tr").attr("data-id_poliza");


        $("#modalCargarFilesPolizasUsuario").prop("id_poliza",id_poliza);

		$("#modalCargarFilesPolizasUsuario").modal("show");

	});


  $("body").on("click",".btnVerPolizas",function()
  {
    
        let id_usuario = tablaClientes.rows($(this).closest("tr").index()).data().pluck(0)[0];

        let cliente = tablaClientes.rows($(this).closest("tr").index()).data().pluck(1)[0];


        $("#modalCargarFilesPolizasUsuario").prop("cliente",cliente);
        $("#modalCargarFilesPolizasUsuario").prop("id_usuario",id_usuario);

         $.ajax(
          {
                       type: "POST",
                       url: base_url+"PolizaDigital/getDatosPolizasCliente",
                       dataType:"json",
                       data: {id_usuario: id_usuario},
                       async: true,
                       success: function(result)
                           {

                            //console.log(result);

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
                                         let cliente = $("#modalCargarFilesPolizasUsuario").prop("cliente");

                                          $("#divClientePolizas").text(cliente);

                                          let noData= `<tr class='noData' >
                                                            <td  colspan='8' class='text-center'>No hay información disponible</td>
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
                                                                                <td class='text-center'>
                                                                                    ${poliza.SubirPolizas}
                                                                                </td>
                                                                         </tr>`;


                                                $("body #tblLoadPolizasCliente tbody").append(tempPolizasCliente);

                                                

                                    });

                                    $("#modalLoadTablaPolizasCliente").modal("show");


                             }
                             else
                             {
                                    // $("#modalSuccessRegistroPoliza .modal-body").html(result.msjConsulta);
                                    //  $("#modalSuccessRegistroPoliza").modal("show");
                             }

                           },
                      error:function(result)
                         {
                           alert("Error");
                          console.log(result.responseText);
                           
                         }
                         
        });   

  });
    
    

	validaUploadPoliza();

	$("#formValidaUploadPoliza").on("submit",function(event)
	{
		event.preventDefault();

		$("#formValidaUploadPoliza").bootstrapValidator();

	});


	function validaUploadPoliza()
	{
		

		$('#formValidaUploadPoliza').bootstrapValidator(
		{

    	        message: 'This value is not valid',
    	        container: 'tooltip',
    	        feedbackIcons: {
    	            valid: 'glyphicon glyphicon-ok',
    	            invalid: 'glyphicon glyphicon-remove',
    	            validating: 'glyphicon glyphicon-refresh'
    	        },
    	        fields: {

    	            filePoliza: {
    	                group: '.form-group',
    	                validators: 
    	                {
    	                    notEmpty: {
    	                        message: 'Este campo es requerido'
    	                    }
    	                     

    	                }
    	            },
    	}
        }).on('success.form.bv', function (e) 
        {

        	    e.preventDefault();

                let id_usuario = $("#modalCargarFilesPolizasUsuario").prop("id_usuario");

                let id_poliza = $("#modalCargarFilesPolizasUsuario").prop("id_poliza");


                  var datosCliente = "?id_usuario="+id_usuario+"&id_poliza="+id_poliza;

        				  var archivos = document.getElementById("filePoliza");  

                        var archivo = archivos.files;
                        var archivos = new FormData();
                        for(i=0; i<archivo.length;i++)
                        {
                          archivos.append('archivo',archivo[i])
                        }


                          $.ajax(
                          {
                                    type: "POST",
                                    url: "PolizaDigital/uploadPolizaDigitalCliente"+datosCliente,
                                    dataType:"json",
                                    contentType:false,
                                    processData:false,
                                    data: archivos,
                                    async: true,
                                    success: function(result)
                                        {
                                          
                                          if(typeof(result.baja) == "undefined") 
                                          {

                                             if(result.status == 'OK')
                                             {

                                                 $("#modalCargarFilesPolizasUsuario").modal("hide");
                                                $("#modalMensajeUploadPoliza .modal-body").html(result.msjConsulta);
                                                $("#modalMensajeUploadPoliza").modal("show");
                                             }
                                             else
                                             {

                                                $("#modalCargarFilesPolizasUsuario").modal("hide");
                                                $("#modalMensajeUploadPoliza .modal-body").html(result.msjConsulta);
                                                $("#modalMensajeUploadPoliza").modal("show");
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
        });


	}



  $('#modalMensajeUploadPoliza').on('hide.bs.modal', function (e) 
   {
          location.reload();
          
   });


    



});
