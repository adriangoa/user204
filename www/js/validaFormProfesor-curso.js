jQuery(document).ready(function($){
	var error= document.createElement("div");
	var DIV= document.createElement("div");
	sinError= true;

	//valida en cada elemento individualmente//por el momento solo elimina los mensajes de error
	
	$('#ciclo_escolar').focus(function(event) {
		
		$(".error").remove();
		sinError= true;
	});
	//---------------
	$('#nombre_curso').focus(function(event) {
		$(".error").remove();
		sinError= true;
	});
	//-----------
	
	$('#seccion').focus(function(event) {
		$(".error").remove();
		sinError= true;
	});
	//---------
	
	$('#nrc').focus(function(event) {
		$(".error").remove();
		sinError= true;
	});
	//----------
	
	$('#academia').focus(function(event) {
		$(".error").remove();
		sinError= true;
	});



	// valida cuando se da click en el boton de enviar
	$(".enviar").click(function (e) {
		//si ya hay mensajes de error se borran para validar de nuevo
		$(".error").remove();

		if($("#ciclo_escolar").val()=="")
		{
			
			$(error).text("Selecciona un cliclo escolar")
					.addClass("error")
			    	.clone().insertAfter($("#ciclo_escolar"));
			sinError= false;
		}
		if($("#nombre_curso").val()=="")
		{
			$(error).text("Ingresa un nombre para el curso")
					.addClass("error")
			    	.clone().insertAfter($("#nombre_curso"));
			sinError= false;
		}

		if($("#seccion").val()=="")
		{
			$(error).text("Ingresa la seccion")
					.addClass("error")
			    	.insertAfter($("#seccion"));
			sinError= false;
		}

		if($("#nrc").val()=="")
		{
			$(error).text("Ingresa el nrc")
					.addClass("error")
			    	.clone().insertAfter($("#nrc"));
			sinError= false;
		}
		else
		{
			var valor = $("#nrc").val();
			if(!valor.match(/[0-9]+/))//los nrc solo haceptan numeros
			{
				$(error).text("El nrc solo admite numeros")
					.addClass("error")
			    	.clone().insertAfter($("#nrc"));
			   	sinError= false;
			}
		}

		if($("#academia").val()=="")
		{
			$(error).text("Ingresa la seccion")
					.addClass("error")
			    	.clone().insertAfter($("#academia"));
			sinError= false;
		}

		//se validan los Horarios
		var ultimoHorario = $( "#campos_entrada .horario:last-child");
  		var posicionActual =ultimoHorario.attr('id');
  		posicionActual=parseInt(posicionActual.substr(posicionActual.length - 2));
  		if(isNaN(posicionActual))//checkar si son mas de 10
	  	{
	  		posicionActual =ultimoHorario.attr('id');
	  		posicionActual=parseInt(posicionActual.substr(posicionActual.length - 1));
	  	}
	  	for(var i=0;i<=posicionActual;i++)
	  	{
	  		if($("#hora-inicio"+i).val()=="")
	  		{
	  			$(error).text("Ingresa una hora valida")
					.addClass("error")
			    	.clone().insertAfter($("#hora-inicio"+i))
			    	sinError= false;
	  		}
	  		if($("#hora-fin"+i).val()=="")
	  		{
	  			$(error).text("Ingresa una hora valida")
					.addClass("error")
			    	.clone().insertAfter($("#hora-fin"+i))
			    	sinError= false;
	  		}
	  		if($("#dia"+i).val()=="")
	  		{
	  			$(error).text("Seleciona un dia")
					.addClass("error")
			    	.clone().insertAfter($("#dia"+i))
			    	sinError= false;
	  		}
	  	}

	  	return sinError;
	});
//-----------------------------------------------------------------------
  //Segeneran elementos dinamicamente cuando se da click al boton de "+"
  $(".btn-mas").click(function (e)
  {
  	$(".error").remove();
		sinError=true;
  	var ultimoHorario = $( "#campos_entrada .horario:last-child");
  	var posicionActual =ultimoHorario.attr('id');

  	posicionActual=parseInt(posicionActual.substr(posicionActual.length - 2));
  	if(isNaN(posicionActual))//checkar si son mas de 10
  	{
  		posicionActual =ultimoHorario.attr('id');
  		posicionActual=parseInt(posicionActual.substr(posicionActual.length - 1));
  	}

  	nuevaPosicion=posicionActual+1;
  	
  	//se crea el nuevo elemento
  	var cadena="";
  	cadena+="<label for=\"hora-inicio"+nuevaPosicion+"\">Hora inicio:</label>";
	cadena+="<input type=\"time\" name=\"hora-inicio"+nuevaPosicion+"\" id=\"hora-inicio"+nuevaPosicion+"\"><br>";
	cadena+="<label for=\"hora-fin"+nuevaPosicion+"\">Hora fin:</label>";
	cadena+="<input type=\"time\" name=\"hora-fin"+nuevaPosicion+"\" id=\"hora-fin"+nuevaPosicion+"\"><br>";								
	cadena+="<label for=\"dia"+nuevaPosicion+"\">Dia:</label>";
	cadena+="<select id=\"dia"+nuevaPosicion+"\" name=\"dia"+nuevaPosicion+"\">";
	cadena+="<option value=\"\"></option><option value=\"lunes\">Lunes</option>";
	cadena+="<option value=\"martes\">Martes</option><option value=\"miercoles\">Miercoles</option>";
	cadena+="<option value=\"jueves\">Jueves</option><option value=\"viernes\">Viernes</option>";
	cadena+="<option value=\"sabado\">Sabado</option></select><br>";

								
  	$(DIV).html(cadena)
		  .attr('id', "div-horario"+nuevaPosicion)
		  .addClass("horario")
		  .clone().insertAfter("#div-horario"+(nuevaPosicion-1));

  	
  	return false;
  });

});

