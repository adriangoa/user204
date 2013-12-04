function descargaAsistencias(pos)
	{
	window.location = $('#baseurl').text()+"/user204/index.php?ctl=Profesor&act=descargaAsistencias&idCurso="+pos;
	}