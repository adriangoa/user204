jQuery(document).ready(function($){
	var DIV= document.createElement("div");

	//valida en cada elemento individualmente//por el momento solo elimina los mensajes de error
	
	$('#ciclo').focus(function(event) {
		
		$(".error").remove();
	});
	//---------------




	// valida cuando se da click en el boton de enviar
	$(".enviar").click(function (e) {

		e.preventDefault();//para evitar que se envie antes de validar
		//si ya hay mensajes de error se borran para validar de nuevo
		$(".error").remove();

		if($("#ciclo").val()=="")
		{		
			$(DIV).text("Ingresa un cliclo escolar")
					.addClass("error")
			    	.clone().insertAfter($("#ciclo"))
		}
				else
		{

			var valor = $("#ciclo").val();
			var expresion =/^[0-9]{4}\-[AaBbVv]{1}$/;

			if(!valor.match(expresion))//se valida que el correo sea valido
			{
				cont=1;

				$(DIV).text("Ciclo invalido")
					.addClass("error")
			    	.clone().insertAfter($("#ciclo"))
			}

		}

		
	});



});

