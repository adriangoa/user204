jQuery(document).ready(function($){
	$.xhrPool = []; // array of uncompleted requests

	$.xhrPool.abortAll = function() { // our abort function
	    $(this).each(function(idx, jqXHR) { 
	        jqXHR.abort();
	    });
	    $.xhrPool.length = 0
	};

	var DIALOG= document.createElement("div");
	var FORM = document.createElement("form");
	var INPUT = document.createElement("input");
	var hojaextra=false;
	var Hojas =null;
	var json=null;
	var banderaPaso =0;
	$(".agregarCalificaciones").click(function (e){
		var codigoAlumno=$(this).parent().parent().attr("class");
		///¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨
		$.xhrPool.abortAll = function() { // our abort function
		    $(this).each(function(idx, jqXHR) { 
		        jqXHR.abort();
		    });
		    $.xhrPool.length = 0
		};
		///""""""""""""""""
		banderaPaso =0;
		$( DIALOG ).html("");
		$( FORM ).html("");
		$( INPUT ).html("");
		//se obtiene con ajax
		Hojas=[];
		json=[];
		
		//primero se  obtienen las hojas extras
		$.ajax({ 
			beforeSend: function(jqXHR) { // before jQuery send the request we will push it to our array
		        $.xhrPool.push(jqXHR);
		    },
		    complete: function(jqXHR) { // when some of the requests completed it will splice from the array
		        var index = $.xhrPool.indexOf(jqXHR);
		        if (index > -1) {
		            $.xhrPool.splice(index, 1);
		        }
		    },
		    url: 'index.php?ctl=Profesor&act=mostrarFormularioCalificacionesHojas&idCurso='+$(this).attr("id"),
		    error: function(data) {
		               		 },
		     //data: {action: 'crearArchivo', salida: output},
		     success: function(salida) {
			        if(salida == "1")
					{
					}
					else
					{
						Hojas = eval(salida);

					}
					banderaPaso =1;
				}
		 });
		///-------------------------------------------
		//luego se obtienen las actividades
		$.ajax({ 
			beforeSend: function(jqXHR) { // before jQuery send the request we will push it to our array
		        $.xhrPool.push(jqXHR);
		    },
		    complete: function(jqXHR) { // when some of the requests completed it will splice from the array
		        var index = $.xhrPool.indexOf(jqXHR);
		        if (index > -1) {
		            $.xhrPool.splice(index, 1);
		        }
		    },
		    url: 'index.php?ctl=Profesor&act=mostrarFormularioCalificacionesActividades&idCurso='+$(this).attr("id"),
		    error: function(data) {
		               		 },
		     //data: {action: 'crearArchivo', salida: output},
		     success: function(salida) {
			        if(salida == "1")
					{
						$( DIALOG ).append("<p>No hay actividades asignadas</p>");
					}
					else
					{

						json = eval(salida);

						//++++++++++++++++++++++++++++++++++++++++++++++++++
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
						if( json[1] == undefined)
						{
							$( DIALOG ).append("No se han asignado actividades");	
						}
						else
						{
							//input oculto para guardar el codigo del alumno
							$( FORM ).append("<input type='hidden' name='codigo-alumno' value='"+codigoAlumno+"'>");
							$( FORM ).append("<input type='hidden' name='id-curso' value='"+json[1].idCurso+"'>");
							//se agrega un boton para guardar el formulario
							$( FORM ).append("<button type='button'id='guardar-calificaciones' class='"+json[1].idCurso+" btn'>Guardar</button>");
							$( FORM ).append("<br><p style='font-size:9'>Se actualizara si ya existe</p>");
							//se agregan atributos al formulario
							$( FORM ).attr({
								'id': 'formulario-calificaciones',
								'action': 'index.php?ctl=Profesor&act=agregarCalificaciones',
								'method': 'post'
							});
							$( DIALOG ).append(FORM);
						}
						
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
		 });
		return false;
	});	

	
});
