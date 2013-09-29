jQuery(document).ready(function($){
	var error= document.createElement("div");

	//valida en cada elemento individualmente
	
	$('#codigo').focus(function(event) {
		
		$(".error").remove();
	});
	//---------------
	$('#nombre').focus(function(event) {
		$(".error").remove();
	});
	//---------------
	$('#apellidos').focus(function(event) {
		$(".error").remove();
	});
	//-----------
	
	$('#seccion').focus(function(event) {
		$(".error").remove();
	});
	//---------
	
	$('#carrera').focus(function(event) {
		$(".error").remove();
	});
	//----------
	
	$('#correo').focus(function(event) {
		$(".error").remove();
	});

	// valida cuando se da click en el boton de enviar
	$(".enviar").click(function (e) {
		e.preventDefault();//para evitar que se envie antes de validar
		if($("#codigo").val()=="")
		{
			
			$(error).text("Ingrese el codigo")
					.addClass("error")
			    	.clone().insertAfter($("#codigo"))
		}
		if($("#nombre").val()=="" || $("#apellidos").val()=="")
		{
			$(error).text("Ingresa el nombre completo")
					.addClass("error")
			    	.clone().insertAfter($("#apellidos"))
		}

		if($("#carrera").val()=="")
		{
			$(error).text("Ingresa la carrera")
					.addClass("error")
			    	.clone().insertAfter($("#carrera"))
		}

		if($("#correo").val()=="")
		{
			$(error).text("Ingresa el correo")
					.addClass("error")
			    	.clone().insertAfter($("#correo"))
		}
	});

});

