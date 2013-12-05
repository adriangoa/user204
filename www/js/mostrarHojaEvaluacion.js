jQuery(document).ready(function($){
	var DIALOG= document.createElement("div");
	$(".mostrarHoja").click(function (e){
		$( DIALOG ).html("");
		//se obtiene con ajax
		$.ajax({ 
		    url: 'index.php?ctl=Alumno&act=mostrarHojaExtra&idActividad='+$(this).attr("id"),
		    error: function(data) {
		               		 },
		     //data: {action: 'crearArchivo', salida: output},
		     success: function(salida) {
			        if(salida == "1")
					{
						$( DIALOG ).append("No se han asignado Calificaciones");
					}
					else
					{
						$( DIALOG ).append(salida);//la salida ya viene formateada
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
