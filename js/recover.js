jQuery(document).ready(function($){
	var DIV= document.createElement("div");
	var cont;

	
	$('#usuario').focus(function(event) {
		
		$(".error").remove();
	});

	$('#correo').focus(function(event) {
		$(".error").remove();
	});
	

	$(".enviar").click(function (e) {
		e.preventDefault();//para evitar que se envie antes de validar

		cont=0;

		if($("#usuario").val()=="")
		{
			cont=1;
			
			$(DIV).text("Ingresa el usuario")
					.addClass("error")
			    	.clone().insertAfter($("#usuario"))
		}



		if($("#correo").val()=="")
		{
			cont=1;

			$(DIV).text("Ingresa el correo")
					.addClass("error")
			    	.clone().insertAfter($("#correo"))
		}
		else
		{

			var valor = $("#correo").val();
			if(!valor.match(/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}/))//se valida que el correo sea valido
			{
				cont=1;

				$(DIV).text("Correo invalido")
					.addClass("error")
			    	.clone().insertAfter($("#correo"))
			}

		}

		if(cont==0)
			alert("La contraseña fue enviada a tu correo..");
	});

});

