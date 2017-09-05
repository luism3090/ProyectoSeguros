$(document).ready(function()
{

var base_url = $("body").attr("data-base-url");

	 $('#tblDetallePolizas').DataTable(

	 	{
        "ordering": true,
         "select": 'single',
         "language": {
                        "url": base_url+"public/libreriasJS/Spanish.json"
                      },
          "scrollY":        "500px",
          "scrollCollapse": true,
      } 

	 	);






});