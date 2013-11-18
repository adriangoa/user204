jQuery(document).ready(function($){
	var OPTION= document.createElement("option");
	//llena  los select cuando carga la pagina
	$.ajax({ 
		    url: "index.php?ctl=Profesor&act=regresarCiclos",
		    error: function(data) {
		               		 },
		     //data: {action: 'crearArchivo', salida: output},
		     success: function(salida) {
		            ciclos = eval(salida);

		            for(i in ciclos)
		            {
		            	$(OPTION).text(ciclos[i].ciclo)
		            			.attr({
		            			'value': ciclos[i].ciclo,
								});
						$( cicloBase ).append($(OPTION).clone());
						$( cicloClonar ).append($(OPTION).clone());
		            }
				}
		 });

	$(cicloBase).change(function (e) {
		//se borran los cursos anteriores
		$("#cursosBase option").remove();
		//se cargan los cursos en base al ciclo
		$.ajax({ 

		    url: "index.php?ctl=Profesor&act=regresarCursos&ciclo="+$(this).val()+"",
		    error: function(data) {
		               		 },
		     //data: {action: 'crearArchivo', salida: output},
		     success: function(salida) {
		            cursos = eval(salida);
		            for(i in cursos)
		            {
		            	$(OPTION).text(cursos[i].nombre)
		            			.attr({
		            			'value': cursos[i].id,
								});
						$( cursosBase ).append($(OPTION).clone());
		            }
				}
		 });

	});
});