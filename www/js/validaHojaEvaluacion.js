jQuery(document).ready(function($){
	var INPUT= document.createElement("input");
	var BOTON= document.createElement("button");
	var DIV= document.createElement("div");
	var boton = document.getElementById("generar");
	var sinError=true;
	//se eliminan mensajes de error
	$('#cantidad-hojas').focus(function(event) {
		
		$(".error").remove();
		sinError=true;
	});




	//___________________
	$(".hoja").click(function (e) {
		//se muestra el formulario correspondiente a las hojas
		var formulario = $("#formulario-hojas");
		formulario.css('display', '');

		//se pone un id al boton general que hace referencia a la actividad relacionada
		var boton = $("#formulario-hojas button.generar");
		boton.attr('id', $(this).parent().parent().attr("class"));

		//se hace focus sobre se input y se mueve la pagina hasta el
		$('html, body').animate({ scrollTop: $("#cantidad-hojas").offset().top }, 500);
		$("#cantidad-hojas").focus();
     	return false;
	});


//se genera el formulario para agregar calificaciones a las hojas
	$(".generar").click(function (e){


		//se obtiene la cantidad del input
		var cantidad = $("#cantidad-hojas").val();
		//se valida que la cantidad se un digito valido
		var expresion =/^[0-9]{1,}$/;

		if(!cantidad.match(expresion))//se valida que el campos tenga letras o numeros,por eso de los espacios
		{
			$(DIV).text("Ingresa un valor numerico valido")
					.addClass("error")
					.css('display', 'block')
			    	.clone().insertAfter($(".generar").parent());
			    sinError= false;
		}
		else
		{
			//se generan los input de acuerdo al total
			for(var i =0; i<cantidad; i++)
			{

				$(INPUT).attr({
						'type': 'text',
						'class':'nombrePorcentaje',
						'placeholder': 'Nombre',
						'name':"nombre"+i,
						});
				$("#contenedor-inputs").append($(INPUT).clone());

				$(INPUT).attr({
						'type': 'text',
						'class':'inputPorcentaje',
						'placeholder': 'porcentaje',
						'name':"porcentaje"+i,
						});
				$("#contenedor-inputs").append($(INPUT).clone());

				//se agrega un salto de linea
				$("#contenedor-inputs").append('<br>');
			}

			//input hidden para saber la cantidad
			$(INPUT).attr({
						'type': 'hidden',
						'value': cantidad,
						'name':'cantidad',
						'class':'j'
						});
			$("#contenedor-inputs").append($(INPUT).clone());

			//input hidden para saber el curso
			$(INPUT).attr({
						'type': 'hidden',
						'value':  $("tr."+$(this).attr("id")).attr("id"),//$("tr."+$(this).attr("id")).parent().parent().attr("id")
						'name':'id-curso',
						'class':'j'
						});
			$("#contenedor-inputs").append($(INPUT).clone());
			//Por ultimo se genera un boton para enviar el formulario y un input que identificara la actividad
			$(INPUT).attr({
						'type': 'hidden',
						'value': $(this).attr("id"),
						'name':'actividad'
						});
			$("#contenedor-inputs").append($(INPUT).clone());

			$(BOTON).attr({
						'type': 'button',
						'class': 'btn',
						'id':'btn-guardarHojas'
						})
					.css('margin-bottom','2%')
					.text("Guardar");
			$("#contenedor-inputs").append($(BOTON));
		
		}
		return sinError;
	});
	
	//como el boton se genera dinamicamente en el paso anterior
	//por eso agrege un eventlistener en el body, ya que no se otra forma aun
	document.querySelector('body').addEventListener('click', function(event) {
	  if (event.target.id === 'btn-guardarHojas') {
	  	//------------------------
	    $(".error").remove();
		sinError=true;
		//------------------------

		var porcentajeActual=0;
	  	var expresion =/^[0-9]{1,}$/;
	    $('.inputPorcentaje').each(function(){
		   if(!($(this).val().match(expresion)))
		   		sinError=false;
		   	else
		   		porcentajeActual+=parseInt($(this).val());
		});
		$('.nombrePorcentaje').each(function(){
		   if(($(this).val()==""))
		   		sinError=false;
		});

		if(sinError==false)
		{
			$(DIV).text("Ingresa un valor numerico valido en todos los campos de porentaje y nombres correspondientes")
					.addClass("error")
					.css('display', 'block')
			    	.clone().insertAfter($("#contenedor-inputs"));
			  
		}
		else
		{
			//se valida que la cantidad del porcentaje coincida
			var numeroActividad= $("input[name=actividad]").val();
			var porcentajeTotal = $(".resultado table tbody tr."+numeroActividad+" td:nth-child(2) p").html();
			if(porcentajeActual!=porcentajeTotal)
			{
				$(DIV).text("El porcentaje de los rublos no coincide con el total("+porcentajeTotal+")")
					.addClass("error")
					.css('display', 'block')
			    	.clone().insertAfter($("#contenedor-inputs"));
			}
			else
			{
				$( "#formulario-hojas" ).submit();
			}
		}
			
	  }
	});

});

