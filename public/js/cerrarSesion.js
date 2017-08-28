$(document).ready(function()
{


  var base_url = $("body").attr("data-base-url");

    $("#btnCerrarSesion").on("click",function()
    {

       $.ajax(
        {
              type: "POST",
              dataType: "json",
              url: base_url+"Home/cerrarSesion",
              data: "",
               async: true,
              success: function(result)
                  {
                    
                    if(!result.sesion)
                    {
                      location.href = result.base_url;
                    }
                  

                  },
           error:function(result)
              {
                
                console.log(result.responseText);
                //$("#error").html(data.responseText); 
              }
              
        });

    });
      
    
});


  