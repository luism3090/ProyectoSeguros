$(document).ready(function()
{

var base_url = $("body").attr("data-base-url");

	 $('#tblDetallePolizas').DataTable(

	 	{
        "ordering": true,
         "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                      },
          "scrollY":        "500px",
          "scrollCollapse": true,
      } 

	 	);





});