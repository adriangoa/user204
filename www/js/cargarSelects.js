jQuery(document).ready(function($){
var OPTION= document.createElement("option");
	//se obtiene las academias por ajax
	$.ajax({ 
		    url: "index.php?ctl=Profesor&act=regresarAcademias",
		    error: function(data) {
		               		 },
		     //data: {action: 'crearArchivo', salida: output},
		     success: function(salida) {
		            academias = eval(salida);

		            var contador=1;
		            for(i in academias)
		            {
		            	if(contador==academias[i].academia_id)
		            	{
		            		$(OPTION).text(academias[i].nombre_academia)
		            			.attr({
		            			'value': academias[i].academia_id,
								});
							$( "#academia" ).append($(OPTION).clone());
							contador++;
		            	}
		            }
		            $(OPTION).text("Otro")
		            		.attr({
		            		'value': 10,
							});
					$( "#academia" ).append($(OPTION).clone());
				}
		 });

	//se maneja el cambio de option en el select para cargar las materias correspondientes
	$('#academia').on('change', function() {
		document.getElementById("nombre_curso").innerHTML = "";
		actualizaMaterias($("#academia").val());
	});

});

function actualizaMaterias(idAcademia)
{
	var OPTION= document.createElement("option");
	$.ajax({ 
		    url: "index.php?ctl=Profesor&act=regresarMaterias&idAcademia="+idAcademia,
		    error: function(data) {
		               		 },
		     //data: {action: 'crearArchivo', salida: output},
		     success: function(salida) {
		            materias = eval(salida);
		            for(i in materias)
		            {
		            	$(OPTION).text(materias[i].nombre_materia)
		            		.attr({
		            		'value': materias[i].nombre_materia,
							});
						$( "#nombre_curso" ).append($(OPTION).clone());
		            }
				}
		 });
}