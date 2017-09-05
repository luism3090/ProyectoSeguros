$(document).ready(function()
{

	var base_url = $("body").attr("data-base-url");


	// $("body").on("click","#tblClientes tr",function()
	// {
	// 	$("#contMsCliente").css("display","block");
	// 	var nombre = $(this).find("td").eq(0).text();
	// 	$("#nombreClienteSelecionado").text(nombre);
	// 	$("#btnEnviar").focus();
	// })


	$("body").on("click",".btnSubirPolizas",function()
	{
		$("#modalCargarFilesPolizasUsuario").modal("show");
	});


});