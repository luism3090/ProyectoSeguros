$(document).ready(function()
{


	 $.ajax(
          {
              type: "POST",
              url: "Permisos/listaMenuRoles",
              dataType:"json",
              data: {id_rol:'1',id_rol_select:$("#slTipoUsuario").val()},
              async: true,
              success: function(result)
                  {

                    $("#ulListaPermisos").html(result.rowsMenu);

                    for(var x=0 ; x < result.elementosMenu.length;x++)
                    {

                    	$("#ulListaPermisos li[data-id-elemento-menu="+result.elementosMenu[x].id_elemento_menu+"] input").prop("checked","checked");

                    }


                  },
             error:function(result)
                {
                  alert("Error");
                 $("#formRegistrarUsuario").html(result.responseText);
                 console.log(result.responseText);
                  
                }
                
          });


	 $("body").on("submit","#formPermisos",function(event)
	 {
		 	event.preventDefault();

		 	 var datosElementosMenu = [];

		 	 if($("#ulListaPermisos li input:checked").length > 0 )
		 	 {

		 	 	$("#ulListaPermisos li input:checked").parent().each(function()
			 	{

			 		var elemento = 	{
			 							id_elemento_menu:$(this).attr("data-id-elemento-menu") 
			 						}



			 		datosElementosMenu.push(elemento);


			 		 $.ajax(
				      {
				          type: "POST",
				          url: "Permisos/insertarPermisosRoles",
				          dataType:"json",
				          data: {datosElementosMenu,id_rol:$("#slTipoUsuario").val()},
				           async: true,
				          success: function(result)
				              {

				              	if(typeof(result.baja) == "undefined") 
				                {
				                	$("#modalGuardarMenusRoles .modal-body h4").text(result.msjConsulta);
				              		$("#modalGuardarMenusRoles").modal("show");
				                }
				                else
				                {
				                  window.location = result.url;
				                }

				              },
				         error:function(result)
				            {
				              alert("Error");
				             $("#formRegistrarUsuario").html(result.responseText);
				             console.log(result.responseText);
				              
				            }
				            
				      });


			 	});

		 	 }
		 	 else
		 	 {
		 	 	$("#modalGuardarMenusRoles .modal-body h4").text("Debe seleccionar cuando menos un permiso para el rol");
          		$("#modalGuardarMenusRoles").modal("show");
		 	 }

		 	


			 	//console.log(datosElementosMenu);

		 	
	 	 

	 });



	 $("body").on("change","#slTipoUsuario",function()
	 {


	 	 $.ajax(
          {
              type: "POST",
              url: "Permisos/listaMenuRoles",
              dataType:"json",
              data: {id_rol:'1',id_rol_select:$("#slTipoUsuario").val()},
               async: true,
              success: function(result)
                  {

                  	if(typeof(result.baja) == "undefined") 
                    {
                    	$("#ulListaPermisos").html(result.rowsMenu);

	                    for(var x=0 ; x < result.elementosMenu.length;x++)
	                    {

	                    	$("#ulListaPermisos li[data-id-elemento-menu="+result.elementosMenu[x].id_elemento_menu+"] > input").prop("checked","checked");

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
                 //$("#formRegistrarUsuario").html(result.responseText);
                 console.log(result.responseText);
                  
                }
                
          });


	 		
	 });


	$("body").on("click","#ulListaPermisos li > input",function() 
	{
		
		if(!$(this).is(':checked'))  // si se le da cllick a un check y se desmarca entra aquí
		{
			$(this).parent().find("ul li > input").prop("checked",""); 
			// si el check que se desmarcó tiene mas hijos checks, pues desmarca esos hijos 
		}
		else  // si se le da click a un check y se marca ese check entra aquí
		{
			$(this).parent().find("ul li > input").prop("checked","checked");
			$(this).parents("ul").parent("li").find(">input").prop("checked","checked"); 
			// si el check que se marco tiene mas hijos checks, pues se marcan esos hijos 
		}


		var cantChecks = $(this).closest("ul").find("li input").length;
		// verificar la cantidad de hermanos checks que tiene el check al que se le dio click 

		var cantSiCheckeados = $(this).closest("ul").find("li input:checked").length;
		// verificar la cantidad de hermanos checks  SI marcados que tiene el check al que se le dio click 

		var cantNoCheckeados = $(this).closest("ul").find("li input:not(:checked)").length;
		// verificar la cantidad de hermanos checks NO marcados que tiene el check al que se le dio click 

	    // si la cantidad de checks hermanos SI marcados es por lo menos de uno entra aquí
		if(cantSiCheckeados == 1 ) 
		{
			$(this).parents("ul").parent("li").find(">input").prop("checked","checked");
			// si por lo menos hay un check hermano marcado entonces marca a todos sus checks padres tambien 
			
		}

		// si la cantidad de checks hemanos es igual a la cantidad de checks no marcados entra aquí 
		if(cantChecks == cantNoCheckeados) 
		{
			
			$(this).parents("ul").parent("li").find(">input").prop("checked","");   // desmarca todos sus checks padres de ese check  

			// si hya un elemento padre que tiene mas hijos checks marcados entonces entra aqui 
			if($(this).closest("ul").parent().parents("ul").parent("li").find("ul  li input:checked").length > 0) 
			{
				// si fue asi entonces ese check padre se vuelve marcado debido a que tiene algun o algunos otros hijos marcados
				$(this).closest("ul").parent().parents("ul").parent("li").find(">input").prop("checked","checked");
			}

			
			
		}

		

	});



});