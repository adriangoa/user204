jQuery(document).ready(function($){
	var error= document.createElement("div");

	// valida cuando se da click en el boton de enviar
	$(".enviar").click(function (e) {
		e.preventDefault();//para evitar que se envie antes de validar
		//si ya hay mensajes de error se borran para validar de nuevo
		$(".error").remove();

		$('input[type=number]').each(function(){
		   if(!$(this).val())
		   {
		   		$(error).text("Los campos solo admiten numeros, calificaciones ")
					.addClass("error")
			    	.insertAfter($("#campos_entrada"));
		   }
		   else if( $(this).val()>100 || $(this).val()<0)
		   {
		   		$(error).text("Calificacion fuera de rango ")
					.addClass("error")
			    	.insertAfter($("#campos_entrada"));
		   }
		});

	});

});

