jQuery(document).ready(function($){

	//se obtiene el id del curso por default en el select
	var idCurso=$("#select-cursos").val();
	//mediante ajax se obtiene a los alumnos que ya estan en ese curso
	$.ajax({ 
			
		    url: 'index.php?ctl=Profesor&act=desabilitarAlumnos&idCurso='+idCurso,
		    error: function(data) {
		               		 },
		     //data: {action: 'crearArchivo', salida: output},
		     success: function(salida) {
			        if(salida == "1")
					{
						
						//$( DIALOG ).append("<p>No hay actividades asignadas</p>");
					}
					else
					{
						json = eval(salida);
						//se desabilitan los checkbox correspondientes a alumnos ya dados de alta 
						$("input.checkbox").each(function(index, el) {
							for( i in json)
							{
								if($(this).val()==json[i].id_alumno)
								{
									$(this).attr('disabled', 'true');
									$(this).attr('title', 'alumno ya inscrito');
								}
									
							}//fin for i in json
						});
						
					}
				}
		 });

	//cada que se cambie de curso se actualizan los alumnos desabilitados
	$('#select-cursos').on('change', function() {
		actualizaDesabilitados($("#select-cursos").val());
	});
	

});

function actualizaDesabilitados(idCurso)
{
	$.ajax({ 
			
		    url: 'index.php?ctl=Profesor&act=desabilitarAlumnos&idCurso='+idCurso,
		    error: function(data) {
		               		 },
		     //data: {action: 'crearArchivo', salida: output},
		     success: function(salida) {
			        if(salida == "1")
					{
						$("input.checkbox").each(function(index, el) {	
							$(this).removeAttr( "title" );
							$(this).removeAttr( "disabled" );
						});
						
					}
					else
					{
						json = eval(salida);
						//se desabilitan los checkbox correspondientes a alumnos ya dados de alta 
						$("input.checkbox").each(function(index, el) {
							for( i in json)
							{
								if($(this).val()==json[i].id_alumno)
								{
									$(this).attr('disabled', 'true');
									$(this).attr('title', 'alumno ya inscrito');
								}
								else
								{
									
									
								}
									
							}//fin for i in json
						});
						
					}
				}
		 });
}