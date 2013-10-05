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
	//----------
	
	$('#celular').focus(function(event) {
		$(".error").remove();
	});
	//----------
	
	$('#github').focus(function(event) {
		$(".error").remove();
	});
	//----------
	
	$('#web').focus(function(event) {
		$(".error").remove();
	});

	// valida cuando se da click en el boton de enviar
	$(".enviar").click(function (e) {
		e.preventDefault();//para evitar que se envie antes de validar
		//si ya hay mensajes de error se borran para validar de nuevo
		$(".error").remove();
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
					.css("display","block")
			    	.clone().insertAfter($("#apellidos"))
		}

		if($("#carrera").val()=="")
		{
			$(error).text("Ingresa la carrera")
					.addClass("error")
					.css("display","inline")
			    	.clone().insertAfter($("#carrera"))
		}

		if($("#correo").val()=="")
		{
			$(error).text("Ingresa el correo")
					.addClass("error")
			    	.clone().insertAfter($("#correo"))
		}
		else
		{

			var valor = $("#correo").val();
			if(!valor.match(/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}/))//se valida que el correo sea valido
			{
				$(error).text("El correo no es valido")
					.addClass("error")
			    	.clone().insertAfter($("#correo"))
			}

		}
		//Se validan los campos opcionales
		if($("#opcional-celular").prop("checked"))
		{
			if($("#celular").val()=="")
			{
				$(error).text("Ingresa el celular")
						.addClass("error")
				    	.clone().insertAfter($("#celular"))
			}
			else
			{

				var valor = $("#celular").val();
				if(!valor.match(/[0-9]+/) || valor.length!=10)//se valida que el celular solo tenga numeros
				{
					$(error).text("Ingresa un celular valido")
						.addClass("error")
				    	.clone().insertAfter($("#celular"))
				}

			}
		}

		if($("#opcional-github").prop("checked"))
		{
			if($("#github").val()=="")
			{
				$(error).text("Ingresa el github")
						.addClass("error")
				    	.clone().insertAfter($("#github"))
			}
		}

		if($("#opcional-web").prop("checked"))
		{
			if($("#web").val()=="")
			{
				$(error).text("Ingresa la web")
						.addClass("error")
				    	.clone().insertAfter($("#web"))
			}
			else
			{

				var valor = $("#web").val();
				if(!valor.match(/((([A-Za-z]{3,9}:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)/))//se valida que el celular solo tenga numeros
				{
					$(error).text("Ingresa una direccion correcta")
						.addClass("error")
				    	.clone().insertAfter($("#web"))
				}

			}
		}

	});

});

