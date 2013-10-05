jQuery(document).ready(function($){
	var error= document.createElement("div");

	//valida en cada elemento individualmente//por el momento solo elimina los mensajes de error
	
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
		//si ya hay mensajes de error se borran para validar de nuevo
		$(".error").remove();

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
		else
		{
			var valor = $("#nrc").val();
			if(!valor.match(/[0-9]+/))//los nrc solo haceptan numeros
			{
				$(error).text("El nrc solo admite numeros")
					.addClass("error")
			    	.clone().insertAfter($("#nrc"))
			}
		}

		if($("#academia").val()=="")
		{
			$(error).text("Ingresa la seccion")
					.addClass("error")
			    	.clone().insertAfter($("#academia"))
		}

		if($("input[name='horarios']:checked").length==0)
		{
			$(error).text("Selecciona el horario")
					.addClass("error")
			    	.clone().insertBefore($("#tabla-horarios"))
		}
	});

});

