jQuery(document).ready(function($){
	var DIV= document.createElement("div");
	var sinError=true;
	var errores="";

	//se elimina el mensaje de error
	$("#cicloBase").click(function(){
		sinError=true;
		errores="";
		$(".error").remove();

	});

	$("#cursosBase").click(function(){
		sinError=true;
		errores="";
		$(".error").remove();

	});

	$("#cicloClonar").click(function(){
		sinError=true;
		errores="";
		$(".error").remove();

	});
	///////////////////////////////////

	$("#btn-clonar").click(function(){
		
		if($("#cicloBase").val()=="")
		{
			errores+="- Selecciona un ciclo Base";
			sinError=false;
		}

		if($("#cursosBase").val()=="")
		{
			errores+="- Selecciona un curso a clonar";
			sinError=false;
		}

		if($("#cicloClonar").val()=="")
		{
			errores+="- Selecciona un ciclo donde clonar";
			sinError=false;
		}
		else
		{
			//se valida que no se clone en el mismo ciclo
			if($("#cicloBase").val() == $("#cicloClonar").val())
			{
				errores+="- Selecciona un ciclo diferente donde clonar";
				sinError=false;
			}
		}

		if(sinError)
		{
			//se envia el formulario
<<<<<<< HEAD
=======
			alert()
>>>>>>> ade11761801940b1bd859e0d0dadcefc10115596
			
		}

		else
		{
			
			//se muestra mensaje de error
			$(DIV).text(errores)
					.addClass("error")
					.css('display', 'block')
			    	.clone().insertAfter($("#cicloClonar"));
		}


		return sinError;


	});

});