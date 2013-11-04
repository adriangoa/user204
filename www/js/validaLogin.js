jQuery(document).ready(function($){
	var DIV= document.createElement("div");
	var sinError=true;


	$('#usuario').focus(function(event) {
		
		$(".error").remove();
		sinError=true;
	});

	$('#password').focus(function(event) {
		
		$(".error").remove();
		sinError=true;
	});

	$(".enviar").click(function (e) {

		//si ya hay mensajes de error se borran para validar de nuevo
		$(".error").remove();

		if($("#usuario").val()=="")
		{		
			$(DIV).text("Ingresa tu usuario")
					.addClass("error")
			    	.clone().insertAfter($("#usuario"));
			sinError= false;
		}

		if($("#password").val()=="")
		{		
			$(DIV).text("Ingresa tu password")
					.addClass("error")
			    	.clone().insertAfter($("#password"));
			sinError= false;
		}
		else
			cifrar();

		return sinError;
	});

});