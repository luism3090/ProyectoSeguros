$(document).ready(function()
{
   // $('button').click(function(){
   //     //$('.sidebar').toggleClass('fliph');
   // });
    
    $.ajax(
      {
            type: "POST",
            url: "Home/cargarMenu",
            dataType:"json",
            data: "",
             async: true,
            success: function(result)
                {
                    $(".list-sidebar").html(result.rowsMenu);

                    $("body .sidebar a[href='"+window.location.href.replace("#","")+"']").closest("ul").siblings().closest("ul").siblings().click();
                    $("body .sidebar a[href='"+window.location.href.replace("#","")+"']").closest("ul").siblings().click();
                    $("body .sidebar a[href='"+window.location.href.replace("#","")+"']").addClass('selecionado');

                },
         error:function(result)
            {
              alert("Error");
             console.log(result.responseText);
              //$("#error").html(data.responseText); 
            }
            
          });
    

  	
  	$("body").on("click",".sidebar ul li a",function()
  	{
  	
  		if($(this).parent().find("ul").length == 0 )
  		{
  			$(".sidebar ul li a").removeClass("selecionado");
  			$(this).addClass("selecionado");
  		}

  	});
   
});