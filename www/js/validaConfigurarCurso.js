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
			var expresion =/^[0-9a-zA-Z" "]{1,}$/;

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
		else
		{
			//se valida que se un digito y que la suma no pace de 100 o tenga valor negativo
			var valor = $("#porcentaje"+id).val();
			var expresion =/^[0-9]{1,}$/;

			if(!valor.match(expresion) || parseInt(valor)<=0)//se valida que el campos tenga letras o numeros,por eso de los espacios
			{
				cadenaErrores+="Ingresa un valor valido, digito";
				sinError= false;
			}
			else
			{
				//se suman los anteriores porcentajes
				//var porcentajes=$( "#contenido"+id+" tr td:nth-child(2)" );
				var porcentajes=$( "#contenido"+id+" tr" );
				var valorPorcentajeActual=null;
				var totalPorcentajes=0;
				var totalActividades = porcentajes.length;
				for(var i=2; i<=totalActividades;i++)
				{
					valorPorcentajeActual=$( "#contenido"+id+" tr:nth-child("+i+") td:nth-child(2)");
					totalPorcentajes+= parseInt(valorPorcentajeActual.text());
				}
				if(totalPorcentajes+parseInt(valor)>100)//se pasa del total
				{
					cadenaErrores+=" - El porcentaje total excede el maximo(100%)";
					sinError= false;
				}

			}

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
