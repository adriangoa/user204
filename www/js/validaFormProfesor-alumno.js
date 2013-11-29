jQuery(document).ready(function($){
	var error= document.createElement("div");
	sinError= true;

	//se muestran los campos opcionales si se seleccionan los checkbox
	$('#opcional-celular').change(function(){
    var estado = this.checked ? 'mostrar' : 'ocultar';
    switch(estado)
    {
    	case 'mostrar':
    		$('#celular').removeClass('oculto');
    		break;

    	case 'ocultar':
    		$('#celular').addClass('oculto');
    		$('#celular').val("");
    		break;
    }
	});

	$('#opcional-github').change(function(){
    var estado = this.checked ? 'mostrar' : 'ocultar';
    switch(estado)
    {
    	case 'mostrar':
    		$('#github').removeClass('oculto');
    		break;

    	case 'ocultar':
    		$('#github').addClass('oculto');
    		$('#github').val("");
    		break;
    }
	});

	$('#opcional-web').change(function(){
    var estado = this.checked ? 'mostrar' : 'ocultar';
    switch(estado)
    {
    	case 'mostrar':
    		$('#web').removeClass('oculto');
    		break;

    	case 'ocultar':
    		$('#web').addClass('oculto');
    		$('#web').val("");
    		break;
    }
	});
	//valida en cada elemento individualmente
	
	$('#codigo').focus(function(event) {
		
		$(".error").remove();
		sinError= true;
	});
	//---------------
	$('#nombre').focus(function(event) {
		$(".error").remove();
		sinError= true;
	});
	//---------------
	$('#apellidos').focus(function(event) {
		$(".error").remove();
		sinError= true;
	});
	//-----------
	
	$('#seccion').focus(function(event) {
		$(".error").remove();
		sinError= true;
	});
	//---------
	
	$('#carrera').focus(function(event) {
		$(".error").remove();
		sinError= true;
	});
	//----------
	
	$('#correo').focus(function(event) {
		$(".error").remove();
		sinError= true;
	});
	//----------
	
	$('#celular').focus(function(event) {
		$(".error").remove();
		sinError= true;
	});
	//----------
	
	$('#github').focus(function(event) {
		$(".error").remove();
		sinError= true;
	});
	//----------
	
	$('#web').focus(function(event) {
		$(".error").remove();
		sinError= true;
	});

	// valida cuando se da click en el boton de enviar
	$(".enviar").click(function (e) {
		//si ya hay mensajes de error se borran para validar de nuevo
		$(".error").remove();
		//si el codigo esta vacio
		if($("#codigo").val()=="")
		{
			
			$(error).text("Ingrese el codigo")
					.addClass("error")
			    	.clone().insertAfter($("#codigo"));
			sinError= false;
		}
		//si no esta vacio se verifica que sea un codigo valido
		else
		{
			var valor = $("#codigo").val();
			if(!valor.match(/^[a-zA-Z0-9]{1}[0-9]{1,}$/))//se valida que el codigo sea valido
			{
				$(error).text("El codigo no es valido")
					.addClass("error")
			    	.clone().insertAfter($("#codigo"))
			    sinError= false;
			}
		}
		if($("#nombre").val()=="" || $("#apellidos").val()=="")
		{
			$(error).text("Ingresa el nombre completo")
					.addClass("error")
					.css("display","block")
			    	.clone().insertAfter($("#apellidos"));
			sinError= false;
		}
		//si existe nombre y apellido, se valida que sean solo letras
		else
		{
			var nombreInvalido=false;
			var valor = $("#nombre").val();
			if(!valor.match(/^[a-zA-Z ñÑ]{1,}$/))//se valida que el nombre sea real!
			{
			    nombreInvalido=true;
			    sinError= false;
			}

			var valor = $("#apellidos").val();
			if(!valor.match(/^[a-zA-Z ñÑ]{1,}$/))//se valida que el nombre sea real!
			{
				
				
			    nombreInvalido=true;
			    sinError= false;
			}
			if(nombreInvalido)
			{
				$(error).text("Nombre invalido, solo se permiten letras")
					.addClass("error")
					.css("display","block")
			    	.clone().insertAfter($("#apellidos"))
			}

		}

		if($("#carrera").val()=="")
		{
			$(error).text("Ingresa la carrera")
					.addClass("error")
					.css("display","inline")
			    	.clone().insertAfter($("#carrera"));
			sinError= false;
		}

		if($("#correo").val()=="")
		{
			$(error).text("Ingresa el correo")
					.addClass("error")
			    	.clone().insertAfter($("#correo"));
			sinError= false;
		}
		else
		{

			var valor = $("#correo").val();
			if(!valor.match(/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}/))//se valida que el correo sea valido
			{
				$(error).text("El correo no es valido")
					.addClass("error")
			    	.clone().insertAfter($("#correo"))
			    sinError= false;
			}

		}
		//Se validan los campos opcionales
		if($("#opcional-celular").prop("checked"))
		{
			if($("#celular").val()=="")
			{
				$(error).text("Ingresa el celular")
						.addClass("error")
				    	.clone().insertAfter($("#celular"));
				sinError= false;
			}
			else
			{

				var valor = $("#celular").val();
				if(!valor.match(/[0-9]+/) || valor.length!=10)//se valida que el celular solo tenga numeros
				{
					$(error).text("Ingresa un celular valido")
						.addClass("error")
				    	.clone().insertAfter($("#celular"));
				    sinError= false;
				}

			}
		}

		if($("#opcional-github").prop("checked"))
		{
			if($("#github").val()=="")
			{
				$(error).text("Ingresa el github")
						.addClass("error")
				    	.clone().insertAfter($("#github"));
				sinError= false;
			}
			//si existe github, se verifica que sea una url 
			else
			{

				var valor = $("#github").val();
				if(!valor.match(/^(?:ftp|http|https):\/\/(?:[\w\.\-\+]+:{0,1}[\w\.\-\+]*@)?(?:[a-z0-9\-\.]+)(?::[0-9]+)?(?:\/|\/(?:[\w#!:\.\?\+=&%@!\-\/\(\)]+)|\?(?:[\w#!:\.\?\+=&%@!\-\/\(\)]+))?$/))//se valida la url sea valido
				{
					$(error).text("La direccion de github no es valida")
						.addClass("error")
				    	.clone().insertAfter($("#github"))
				    sinError= false;
				}

			}

		}

		if($("#opcional-web").prop("checked"))
		{
			if($("#web").val()=="")
			{
				$(error).text("Ingresa la web")
						.addClass("error")
				    	.clone().insertAfter($("#web"));
				sinError= false;
			}
			else
			{

				var valor = $("#web").val();
				if(!valor.match(/^(?:ftp|http|https):\/\/(?:[\w\.\-\+]+:{0,1}[\w\.\-\+]*@)?(?:[a-z0-9\-\.]+)(?::[0-9]+)?(?:\/|\/(?:[\w#!:\.\?\+=&%@!\-\/\(\)]+)|\?(?:[\w#!:\.\?\+=&%@!\-\/\(\)]+))?$/))
				{
					$(error).text("La direccion web no es valida")
						.addClass("error")
				    	.clone().insertAfter($("#web"));
				    sinError= false;
				}

			}
		}
		//////////////////////////////////////////////////////////////
		if(sinError)
		{
		//Serializar y Agregar
			var datos=$("#formulario").serialize();
			$.ajax({
					type:'POST',
				url: $('#baseurl').text()+"/user204/index.php?ctl=Profesor&act=agregarAlumno",
				error: function(data) {
					apprise('Ocurrio un error . Intenta otra vez.');
					},
					data:datos,
					beforeSend: function(){
			                $.blockUI({
			                    message:'<img style=\"width:400px;\" src=\"./www/img/cargando.gif\">',
			                    css: { 
			                        top:  ($(window).height() - 160) /2 + 'px', 
			                        left: ($(window).width() - 200) /2 + 'px', 
			                        width: '200' 
			                    },

			                });
			                setTimeout($.unblockUI,4000);
			            },
								success: function(data) {
						if(data==0)//si no hay error
						{
							apprise('Alumno Agregado', {'textOk':'Aceptar'}, function(r)
							{
								if(r)
								{

									location.reload();
								}
							});
						}
						else
						{
							apprise('Ocurrio un error . Intenta otra vez.');
						}
					}
				});
		}
		///////////////////////////////////////////////////////////////
		return false;

	});

});

