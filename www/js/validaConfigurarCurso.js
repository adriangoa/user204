jQuery(document).ready(function($){
	var error= document.createElement("tr");
	var td= document.createElement("td");
	sinError= true;

	//valida en cada elemento individualmente//por el momento solo elimina los mensajes de error
	
	$('#ciclo_escolar').focus(function(event) {
		
		$(".error").remove();
		sinError= true;
	});
	

	// valida cuando se da click en el boton de enviar
	$(".agregar").click(function (e) {
		sinError=true;

		var id = $(this).attr('id');
		var cadenaErrores="";
		//si ya hay mensajes de error se borran para validar de nuevo
		$(".error_fila").remove();

		if($("#actividad"+id).val()=="")
		{
			cadenaErrores="Ingresa una actividad";
			sinError= false;
		}
		else
		{
			var valor = $("#actividad"+id).val();
			var expresion =/^[0-9a-zA-Z]{1,}$/;

			if(!valor.match(expresion))//se valida que el campos tenga letras o numeros,por eso de los espacios
			{
				cadenaErrores="Nombre de actividad invalido";
				sinError= false;
			}
		}
		if($("#porcentaje"+id).val()=="")
		{
			cadenaErrores+=" - Ingresa un porcentaje";
			sinError= false;
		}

		if(sinError==false)
		{
			$(td).text(cadenaErrores)
				 .attr('colspan',"5");
			error.appendChild(td);
			$(error).addClass("error_fila")
			    	.clone().insertAfter($("#contenido"+id+" tr:last"));
		}

	  	return sinError;
	});

});
