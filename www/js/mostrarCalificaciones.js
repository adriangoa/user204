jQuery(document).ready(function($){

	var DIALOG= document.createElement("div");
	var FORM = document.createElement("form");
	var INPUT = document.createElement("input");
	var hojaextra=false;
	var Hojas =null;
	var json=null;
	var miajax2=nuevoAjax();
	var miajax=nuevoAjax();
	var banderaPaso =0;
	$(".mostrarCalificaciones").click(function (e){

		banderaPaso =0;
		$( DIALOG ).html("");
		$( FORM ).html("");
		$( INPUT ).html("");
		//se obtiene con ajax
		Hojas=[];
		json=[];
		
		//primero se  obtienen las hojas extras
		$.ajax({ 
		    url: 'index.php?ctl=Profesor&act=mostrarCalificacionesHojas&codigoAlumno='+$(this).attr("id"),
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
		    url: 'index.php?ctl=Profesor&act=mostrarCalificacionesActividades&codigoAlumno='+$(this).attr("id")+'&idCurso='+$(this).parent().parent().attr("id"),
		    error: function(data) {
		               		 },
		     //data: {action: 'crearArchivo', salida: output},
		     success: function(salida) {
			        if(salida == "1")
					{
						$( FORM ).append("No se han asignado Calificaciones");
					}
					else
					{

						json = eval(salida);

						//++++++++++++++++++++++++++++++++++++++++++++++++++
						for( i in json)
						{
							hojaextra=false;
							var label ="<label for ="+json[i].id_actividad+">"+json[i].nombre_actividad+"</label>";
							$( FORM ).append(label);
							for(e in Hojas)
							{
								
								//alert("hoja :"+Hojas[e].id_actividad+"<br>"+"Acti: "+json[i].id_actividad);
								if(Hojas[e].id_actividad==json[i].id_actividad)
								{
									//la actividad tiene hoja extra de evalucion
									$(INPUT).attr({
									'name': json[i].id+"-"+e,
									'id': json[i].id+"-"+e,
									'type': 'text',
									'value': Hojas[e].calificacion,
									'disabled': true
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
									'value': json[i].calificacion,
									
								});
								
								$( FORM ).append($(INPUT).clone());
							}
							
						}
					}
					$( DIALOG ).append(FORM);

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
