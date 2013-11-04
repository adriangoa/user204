jQuery(document).ready(function($){
	$('.puntero').css( 'cursor', 'pointer' );
	
});

function desplegar(pos)
	{
		$(document).ready(function (){
			if($("#contenido"+pos).is(":hidden")){
				$("#mostrar_ocultar"+pos).text("Ocultar Alumnos");
				$("#contenido"+pos).show("slow");
			}
			else{
				$("#contenido"+pos).hide("slow");
				$("#mostrar_ocultar"+pos).text("Mostrar Alumnos");
			}
		});
	}