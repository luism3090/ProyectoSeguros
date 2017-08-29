$(document).ready(function()
{

	var base_url = $("body").attr("data-base-url");

	// var direccion = window.location.href;

	// if(indexOf())


	  $("body").on("change","#slEstado",function(event)
	  {
	      
	     cargarSelectMunicipios();

	  });

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


	function cargarSelectFormaPago()
	{

		$.ajax(
	    {
	      
	      type: "POST",
	      url: base_url+"Polizas/cargarSelectFormaPago",
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
	  
	                       options += '<option value="'+elemento.id_forma_pago+'">'+elemento.nombre+'</option>';
	                      
	                  });

	                   $("#slFormaPago").html(options);

	                }
	              
	            },
	       error:function(result)
	          {
	            alert("Error");
	           console.log(result.responseText);
	            
	          }
	   });


	}
	cargarSelectFormaPago();


	function cargarSelectMoneda()
	{

		$.ajax(
	    {
	      
	      type: "POST",
	      url: base_url+"Polizas/cargarSelectMoneda",
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
	  
	                       options += '<option value="'+elemento.id_moneda+'">'+elemento.nombre+'</option>';
	                      
	                  });

	                   $("#slMoneda").html(options);

	                }
	              
	            },
	       error:function(result)
	          {
	            alert("Error");
	           console.log(result.responseText);
	            
	          }
	   });


	}
	cargarSelectMoneda();


	function cargarSelectMedioPago()
	{

		$.ajax(
	    {
	      
	      type: "POST",
	      url: base_url+"Polizas/cargarSelectMedioPago",
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
	  
	                       options += '<option value="'+elemento.id_medio_pago+'">'+elemento.nombre+'</option>';
	                      
	                  });

	                   $("#slMedioPago").html(options);

	                }
	              
	            },
	       error:function(result)
	          {
	            alert("Error");
	           console.log(result.responseText);
	            
	          }
	   });


	}
	cargarSelectMedioPago();



	function cargarSelectPais()
	{
	    $.ajax(
	    {
	      
	      type: "POST",
	      url: base_url+"Polizas/cargarSelectPais",
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
	  
	                       options += '<option value="'+elemento.id_pais+'">'+elemento.nombre+'</option>';
	                      

	                  });


	                   $("#slPais").html(options);

	                   $('#slPais option[value="146"]').attr("selected", "selected");

	                }
	              
	            },
	       error:function(result)
	          {
	            alert("Error");
	           console.log(result.responseText);
	            
	          }
	    });

	}
	cargarSelectPais();


	function cargarSelectEstado()
	{
	    $.ajax(
	    {
	      
	      type: "POST",
	      url: base_url+"RegistrarUsuarios/cargarSelectEstado",
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
	  
	                       options += '<option value="'+elemento.id_estado+'">'+elemento.nombre+'</option>';
	                      

	                  });


	                   $("#slEstado").html(options);

	                }
	              
	            },
	       error:function(result)
	          {
	            alert("Error");
	           console.log(result.responseText);
	            
	          }
	    });

	}
	cargarSelectEstado();



	function cargarSelectMunicipios()
	{
	   var datosEstado = { id_estado: $("#slEstado").val() }

	    $.ajax(
	    {
	      
	      type: "POST",
	      url: base_url+"RegistrarUsuarios/cargarSelectMunicipios",
	      dataType:"json",
	      data: datosEstado,
	      async: true,
	        success: function(result)
	            {

	                if(result.length > 0)
	                {
	                  let options ="<option selected disabled >Elija una opción</option>";
	                   result.forEach(function(elemento,index) 
	                   {
	  
	                       options += '<option value="'+elemento.id_municipio+'">'+elemento.nombre+'</option>';
	                      

	                  });

	                  // $("#formRegistrarPolizaEmpresarial").data("bootstrapValidator").resetField("slMunicipio",true);
	                   $("#slMunicipio").html(options);

	                }
	              
	            },
	       error:function(result)
	          {
	            alert("Error");
	           console.log(result.responseText);
	            
	          }
	    });

	}


});