$(document).ready(function()
{

	var base_url = $("body").attr("data-base-url");


	function cargarSelectStatus()
	{

		$.ajax(
	    {
	      
	      type: "POST",
	      url: base_url+"Polizas/cargarSelectStatus",
	      dataType:"json",
	      data: '',
	      async: true,
	        success: function(result)
	            {

	                if(result.length > 0)
	                {
	                   let options ="<option selected disabled >Elija una opción</option>";
	                   result.forEach(function(elemento,index) 
	                   {
	  
	                       options += '<option value="'+elemento.id_status+'">'+elemento.nombre+'</option>';
	                      
	                  });

	                   $("#slStatus").html(options);

	                }
	              
	            },
	       error:function(result)
	          {
	            alert("Error");
	           console.log(result.responseText);
	            
	          }
	   });


	}
	cargarSelectStatus();


	function cargarSelectTipo()
	{

		$.ajax(
	    {
	      
	      type: "POST",
	      url: base_url+"Polizas/cargarSelectTipo",
	      dataType:"json",
	      data: '',
	      async: true,
	        success: function(result)
	            {

	                if(result.length > 0)
	                {
	                   let options ="<option selected disabled >Elija una opción</option>";
	                   result.forEach(function(elemento,index) 
	                   {
	  
	                       options += '<option value="'+elemento.id_tipo+'">'+elemento.nombre+'</option>';
	                      
	                  });

	                   $("#slTipo").html(options);

	                }
	              
	            },
	       error:function(result)
	          {
	            alert("Error");
	           console.log(result.responseText);
	            
	          }
	   });


	}
	cargarSelectTipo();


	function cargarSelectAseguradora()
	{

		$.ajax(
	    {
	      
	      type: "POST",
	      url: base_url+"Polizas/cargarSelectAseguradora",
	      dataType:"json",
	      data: '',
	      async: true,
	        success: function(result)
	            {

	                if(result.length > 0)
	                {
	                   let options ="<option selected disabled >Elija una opción</option>";
	                   result.forEach(function(elemento,index) 
	                   {
	  
	                       options += '<option value="'+elemento.id_aseguradora+'">'+elemento.nombre+'</option>';
	                      
	                  });

	                   $("#slAseguradora").html(options);

	                }
	              
	            },
	       error:function(result)
	          {
	            alert("Error");
	           console.log(result.responseText);
	            
	          }
	   });


	}
	cargarSelectAseguradora();


	 var tableUsersAlta = $('#tblUsuariosAlta').DataTable( 
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
          url :"Usuarios/cargarUsuariosAlta", 
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
                      },
                      {
                          "targets": [ 1 ],
                          "visible": false,
                          "searchable": false
                      }
                  ],
        

      } );


});