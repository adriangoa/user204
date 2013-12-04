jQuery(document).ready(function($){
	var sinError=true;
	var DIV= document.createElement("div");
	var check=true;
//se eliminan los errores
	$('input[type=checkbox]').change(function(event) {
			
			$(".error").remove();
			sinError= true;
		});

	$('#select-cursos').change(function(event) {
			
			sinError= true;
			$(".error").remove();
		});

	$('#seleccionar-todo').click(function(event) {
			
			$(".error").remove();
			sinError= true;
			$('input[type=checkbox]').attr('checked', check);
			check=!check;
			return false;
		});
///////
	$("#btn-agregar").click(function(event) {
		$(".error").remove();
		if(!$('input[type=checkbox]:checked').length)
		{
			sinError=false;
			$(DIV).text("Selecciona Alumnos")
					.addClass("error")
					.css('display', 'block')
			    	.clone().insertAfter($("#select-cursos"));
		}
		//////////////////////////////////////////////////////////////
		if(sinError)
		{
		//Serializar y Agregar
			var datos=$("#formulario").serialize();
			$.ajax({
					type:'POST',
				url: $('#baseurl').text()+"/user204/index.php?ctl=Profesor&act=altaAlumnos",
				error: function(data) {
					
					apprise('Alumno Agregado', {'textOk':'Aceptar'}, function(r)
							{
								if(r)
								{

									location.reload();
								}
							});
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
							apprise('Alumno Agregado', {'textOk':'Aceptar'}, function(r)
							{
								if(r)
								{

									location.reload();
								}
							});
						}
					}
				});
		}
		///////////////////////////////////////////////////////////////
		return false;
	});
});