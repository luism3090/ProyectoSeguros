$(document).ready(function()
{

var base_url = $("body").attr("data-base-url");

	 $('#tblDetallePolizasClientes').DataTable(

	 	{
        "ordering": true,
         
         "language": {
                        "url": base_url+"public/libreriasJS/Spanish.json"
                      },
          "scrollY":        "500px",
          "scrollCollapse": true,
      } 

	 	);


$('body').on( 'click', '#tblDetallePolizas tbody tr', function () {
        $(this).toggleClass('selected');
    } );




});