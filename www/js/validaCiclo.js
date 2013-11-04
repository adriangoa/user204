jQuery(document).ready(function($){
	var DIV= document.createElement("div");
	var DIV2= document.createElement("div");
	var sinError=true;

	//valida en cada elemento individualmente//por el momento solo elimina los mensajes de error
	
	$('#ciclo').focus(function(event) {
		
		$(".error").remove();
		sinError=true;
	});

	$('#fecha-inicio').focus(function(event) {
		
		$(".error").remove();
		sinError=true;
	});

	$('#fecha-finalizacion').focus(function(event) {
		
		$(".error").remove();
		sinError=true;
	});
	//---------------

	// valida cuando se da click en el boton de enviar
	$(".enviar").click(function (e) {

		//si ya hay mensajes de error se borran para validar de nuevo
		$(".error").remove();

		//se valida el ciclo escolar
		if($("#ciclo").val()=="")
		{		
			$(DIV).text("Ingresa un cliclo escolar")
					.addClass("error")
			    	.clone().insertAfter($("#ciclo"));
			sinError= false;
		}
		else
		{

			var valor = $("#ciclo").val();
			var expresion =/^[0-9]{4}[AaBbVv]{1}$/;

			if(!valor.match(expresion))//se valida que el correo sea valido
			{
				cont=1;

				$(DIV).text("Ciclo invalido")
					.addClass("error")
			    	.clone().insertAfter($("#ciclo"));
			    sinError= false;
			}
		}

		//se valida la fecha de inicio
		if($("#fecha-inicio").val()=="")
		{		
			$(DIV).text("Ingresa un fecha valida")
					.addClass("error")
			    	.clone().insertAfter($("#fecha-inicio"))
			sinError= false;
		}
		else
		{

			/*var valor = $("#ciclo").val();
			var expresion =/^[0-9]{4}[AaBbVv]{1}$/;

			if(!valor.match(expresion))//se valida que el correo sea valido
			{
				cont=1;

				$(DIV).text("Ciclo invalido")
					.addClass("error")
			    	.clone().insertAfter($("#ciclo"))
			}*/
		}
		//se valida la fecha de inicio
		if($("#fecha-finalizacion").val()=="")
		{		
			$(DIV).text("Ingresa un fecha valida")
					.addClass("error")
			    	.clone().insertAfter($("#fecha-finalizacion"));

			sinError= false;
		}
		else
		{

			/*var valor = $("#ciclo").val();
			var expresion =/^[0-9]{4}[AaBbVv]{1}$/;

			if(!valor.match(expresion))//se valida que el correo sea valido
			{
				cont=1;

				$(DIV).text("Ciclo invalido")
					.addClass("error")
			    	.clone().insertAfter($("#ciclo"))
			}*/
		}

		//se validan los dias no efectivos
		var ultimoMotivo = $( "#campos_entrada .no-efectivo:last-child");
  		var posicionActual =ultimoMotivo.attr('id');
  		posicionActual=parseInt(posicionActual.substr(posicionActual.length - 2));
  		if(isNaN(posicionActual))//checkar si son mas de 10
	  	{
	  		posicionActual =ultimoMotivo.attr('id');
	  		posicionActual=parseInt(posicionActual.substr(posicionActual.length - 1));
	  	}
	  	for(var i=0;i<=posicionActual;i++)
	  	{
	  		
	  		if($( "#fecha-no-efectivo"+i ).val()=="" || $( "#motivo"+i ).val()=="")
			{	
				$(DIV).text("Ingresa un fecha valida y un motivo")
						.addClass("error")
				    	.clone().insertAfter($("#div-dia-no-efectivo"+i));
				sinError= false;
			}
			//se valida si la fecha escojida corresponde al ciclo
			else
			{
				var ciclo=$('#ciclo').val();
				var cicloPrincipal=parseInt(ciclo.substr(0,4));
				
				var cicloIngresado=parseInt($( "#fecha-no-efectivo"+i ).val().substr(0,4));
				if(cicloIngresado<cicloPrincipal || cicloIngresado>cicloPrincipal+1)
				{
					$(DIV).text("La fecha ingresada no corresponde al ciclo")
						.addClass("error")
				    	.clone().insertAfter($("#div-dia-no-efectivo"+i));
					sinError= false;
				}
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
  	var ultimoMotivo = $( "#campos_entrada .no-efectivo:last-child");
  	var posicionActual =ultimoMotivo.attr('id');

  	posicionActual=parseInt(posicionActual.substr(posicionActual.length - 2));
  	if(isNaN(posicionActual))//checkar si son mas de 10
  	{
  		posicionActual =ultimoMotivo.attr('id');
  		posicionActual=parseInt(posicionActual.substr(posicionActual.length - 1));
  	}

  	nuevaPosicion=posicionActual+1;
  	
  	//se crea el nuevo elemento
  	$(DIV2).html("<label for=\"dia-no-efectivo"+nuevaPosicion+"\">Dia no efectivo:</label><input type=\"date\" name=\"dia-no-efectivo"+nuevaPosicion+"\" id=\"fecha-no-efectivo"+nuevaPosicion+"\"><input type=\"text\" name=\"motivo"+nuevaPosicion+"\" placeholder=\"Motivo\" id=\"motivo"+nuevaPosicion+"\">")
		  .attr('id', "div-dia-no-efectivo"+nuevaPosicion)
		  .addClass("no-efectivo")
		  .clone().insertAfter("#div-dia-no-efectivo"+(nuevaPosicion-1));

  	
  	return false;
  });

});

