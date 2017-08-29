$(document).ready(function()
{
   

var base_url = $("body").attr("data-base-url");

	   var tablaClientes = $('#tblClientes').DataTable( 
      {
        "processing": true,
        "serverSide": true,
        "ordering": true,
         "select": 'single',
         "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
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



});