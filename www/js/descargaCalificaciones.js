function descargaCalificaciones(pos)
	{
		/*$(document).ready(function (){
			$.ajax({
					type:'GET',
				url: $('#baseurl').text()+"/user204/index.php?ctl=Profesor&act=descargaCalificaciones&idCurso="+pos,
				error: function(data) {

					},
				beforeSend: function(){
			              
			            },
				success: function(data) {
						
					}
				});
		});*/
	window.location = $('#baseurl').text()+"/user204/index.php?ctl=Profesor&act=descargaCalificaciones&idCurso="+pos;
	}