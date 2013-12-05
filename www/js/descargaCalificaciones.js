function descargaCalificaciones(pos)
	{
	window.location = $('#baseurl').text()+"/user204/index.php?ctl=Profesor&act=descargaCalificaciones&idCurso="+pos;
	}