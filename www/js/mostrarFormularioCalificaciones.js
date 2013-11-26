jQuery(document).ready(function($){
	var DIALOG= document.createElement("div");
	var FORM = document.createElement("form");
	var INPUT = document.createElement("input");
	var hojaextra=false;
	var Hojas =null;
	$(".agregarCalificaciones").click(function (e){
		var codigoAlumno=$(this).parent().parent().attr("class");
		
		$( DIALOG ).html("");
		$( FORM ).html("");
		//se obtiene con ajax
		
		//primero se  obtienen las hojas extras
		var miajax2=nuevoAjax();
		//primero se  obtienen las hojas extras
		
		//hago la peticion a mi server
		miajax2.open('get','index.php?ctl=Profesor&act=mostrarFormularioCalificacionesHojas&idCurso='+$(this).attr("id"),true);

		//funcion para cuando ccambie el estatus
		miajax2.onreadystatechange=function()
		{
			if(miajax2.readyState==4)
			{
				Hojas = eval(miajax2.responseText);
			}
		}

		miajax2.send(null);
		///-------------------------------------------
		//creamos el objeto Ajax
		var miajax=nuevoAjax();
		//hago la peticion a mi server
		miajax.open('get','index.php?ctl=Profesor&act=mostrarFormularioCalificacionesActividades&idCurso='+$(this).attr("id"),true);

		//funcion para cuando cambie el estatus
		miajax.onreadystatechange=function()
		{
			if(miajax.readyState==4 && miajax2.readyState==4)
			{
				
				var json = eval(miajax.responseText);
				if(json == undefined)
				{
					$( DIALOG ).append("<p>No hay actividades asignadas</p>");
				}
				else
				{
					for( i in json)
					{
						hojaextra=false;
						var label ="<label for ="+json[i].id+">"+json[i].actividad+"</label>";
						$( FORM ).append(label);
						for(e in Hojas)
						{
							if(Hojas[e].id_actividad==json[i].id)
							{
								//la actividad tiene hoja extra de evalucion
								$(INPUT).attr({
								'name': json[i].id+"-"+e,
								'id': json[i].id+"-"+e,
								'type': 'text',
								'placeholder':Hojas[e].nombre+' [valor: '+Hojas[e].porcentaje+' %]',
								'class': Hojas[e].porcentaje
								});
								$( FORM ).append($(INPUT).clone());
								hojaextra=true;
							}
						}
						if(hojaextra == false)
						{
							
							$(INPUT).attr({
								'name': json[i].id,
								'id': json[i].id,
								'type': 'text',
								'placeholder':'valor: '+json[i].porcentaje+' %',
								'class': json[i].porcentaje
							});
							
							$( FORM ).append($(INPUT).clone());
						}
						
					}//fin for i in json
					//input oculto para guardar el codigo del alumno
					$( FORM ).append("<input type='hidden' name='codigo-alumno' value='"+codigoAlumno+"'>");
					$( FORM ).append("<input type='hidden' name='id-curso' value='"+json[1].idCurso+"'>");
					//se agrega un boton para guardar el formulario
					$( FORM ).append("<button type='button'id='guardar-calificaciones' class='"+json[1].idCurso+" btn'>Guardar</button>");
					//se agregan atributos al formulario
					$( FORM ).attr({
						'id': 'formulario-calificaciones',
						'action': 'index.php?ctl=Profesor&act=agregarCalificaciones',
						'method': 'post'
					});
					$( DIALOG ).append(FORM);
				}
				
				
				

				$( DIALOG ).dialog({
			      modal: true,
			      title: "Calificaciones",
			      buttons: {
			        Cerrar: function() {
			          $( this ).dialog( "close" );
			        }
			      }
			    });
				
			}
		}

		miajax.send(null);
		return false;
	});	


});
