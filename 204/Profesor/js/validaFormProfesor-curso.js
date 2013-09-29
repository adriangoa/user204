jQuery(document).ready(function($){
	var error= document.createElement("div");

	//valida en cada elemento individualmente
	
	$('#ciclo_escolar').focus(function(event) {
		
		$(".error").remove();
	});
	//---------------
	$('#nombre_curso').focus(function(event) {
		$(".error").remove();
	});
	//-----------
	
	$('#seccion').focus(function(event) {
		$(".error").remove();
	});
	//---------
	
	$('#nrc').focus(function(event) {
		$(".error").remove();
	});
	//----------
	
	$('#academia').focus(function(event) {
		$(".error").remove();
	});

	// valida cuando se da click en el boton de enviar
	$(".enviar").click(function (e) {
		e.preventDefault();//para evitar que se envie antes de validar
		if($("#ciclo_escolar").val()=="")
		{
			
			$(error).text("Selecciona un cliclo escolar")
					.addClass("error")
			    	.clone().insertAfter($("#ciclo_escolar"))
		}
		if($("#nombre_curso").val()=="")
		{
			$(error).text("Ingresa un nombre para el curso")
					.addClass("error")
			    	.clone().insertAfter($("#nombre_curso"))
		}

		if($("#seccion").val()=="")
		{
			$(error).text("Ingresa la seccion")
					.addClass("error")
			    	.insertAfter($("#seccion"))
		}

		if($("#nrc").val()=="")
		{
			$(error).text("Ingresa el nrc")
					.addClass("error")
			    	.clone().insertAfter($("#nrc"))
		}

		if($("#academia").val()=="")
		{
			$(error).text("Ingresa la seccion")
					.addClass("error")
			    	.clone().insertAfter($("#academia"))
		}
	});

});

