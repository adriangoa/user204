jQuery(document).ready(function($){
	var error= document.createElement("div");
	var sinError = true;
	var mensaje="";
	var ajax=false;


//Se borran los mensajes antiguos
	$("#usuario").focus(function (e){
			$(".error").remove();
			sinError= true;
			mensaje=""
		});

	$("#correo").focus(function (e){
		$(".error").remove();
		sinError= true;
		mensaje=""
	});

//se valida al precionar enviar
	$(".enviar").click(function (e){

		$(".error").remove();
		mensaje=""
		if($("#usuario").val()=="")
		{
			mensaje += " -Ingresa un codigo de usuario";
			sinError=false;
		}
			

		if($("#correo").val()=="")
		{
			mensaje += " -Ingresa el correo de usuario";
			sinError=false;	
		}
		else
		{
			var valor = $("#correo").val();
			if(!valor.match(/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}/))//se valida que el correo sea valido
			{
			  mensaje += "el correo no es valido";
			  sinError= false;
			}
		}


		
		

		//se hace un ajax para validar los usuarios y correos
		if(sinError)
		{
			$.ajax({ 
		    url: "index.php?ctl=Login&act=validaUsuario&codigo="+$("#usuario").val()+"&correo="+$("#correo").val()+"",
		    error: function(data) {
		    	
		               		 },
		     //data: {action: 'crearArchivo', salida: output},
		     success: function(salida) {
		     	if(salida == "noExiste")
		     	{
		     		mensaje += "No se encuentra el usuario";
				  	sinError= false;
				  	ajax=true;

				  	$(error).text(mensaje)
						.addClass("error")
						.css("display","block")
				    	.clone().insertAfter($("#correo"))
				    }
				}
		 	});
		}

		//se regresa los mensajes de error si es que los hay
		if(sinError==false && ajax==false)
		{
			$(error).text(mensaje)
					.addClass("error")
					.css("display","block")
			    	.clone().insertAfter($("#correo"))
		}
		

		return false;
	});
});