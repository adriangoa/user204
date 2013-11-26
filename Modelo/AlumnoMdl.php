<?php

class AlumnoMdl
{
	public $driver;

	function __construct(){
		$this -> driver = new mysqli('localhost','root','','cc409_user204');
		if($this -> driver->connect_errno)
			die("<br>Error en la conexión");
	}


	function obtenerCiclos()
	{
		$query = 'SELECT * FROM ciclos';

		$r = $this -> driver -> query($query);

		while($row = $r -> fetch_assoc())
			$rows[] = $row;

		return $rows;
	}

	function obtenerCursos()
	{
		session_start();
		
		$codigo=$_SESSION['usuario'];

		$query ="SELECT cursos.* FROM cursos, alumnos, alumnos_cursos WHERE cursos.id=alumnos_cursos.id_curso AND alumnos_cursos.id_alumno=alumnos.id_alumno AND alumnos.codigo=\"$codigo\"";

		$r = $this -> driver -> query($query);

		while($row = $r -> fetch_assoc())
			$rows[] = $row;
		if(isset($rows))
			return $rows;
		else
			return FALSE;
	}

	function obtenerActividades($idCurso)
	{
		$query = "SELECT * FROM actividades WHERE idCurso=$idCurso ";

		$r = $this -> driver -> query($query);

		while($row = $r -> fetch_assoc())
			$rows[] = $row;
		if(isset($rows))
			return $rows;
		else
			return FALSE;	
	}	

	function obtenerHojasExtras($idActividad)
	{
		$consulta ="SELECT * FROM hojasextras WHERE id_actividad=$idActividad";
		$resultado = $this -> driver->query($consulta);

		if($resultado === FALSE)
				return FALSE;
		//se procesa el resultado
		else
		{
			while($row =$resultado->fetch_assoc())
				$hojas[]=$row;
			if(!isset($hojas))
				return FALSE;
			else
			 return $hojas;
		}
		
	}	

	function obtenerAlumnos()
	{
		$consulta ="SELECT * FROM alumnos";
		$resultado = $this -> driver->query($consulta);

		if($resultado === FALSE)
				return FALSE;
		//se procesa el resultado
		else
		{
			while($row =$resultado->fetch_assoc())
				$alumnos[]=$row;
			return $alumnos;
		}
	}	

	function obtenerAlumnosXCurso($idCurso)
	{
		$consulta ="SELECT * FROM alumnos_cursos WHERE id_curso = $idCurso";
		$resultado = $this -> driver->query($consulta);

		if($resultado ->num_rows==0)
				return FALSE;
		else
		{
			//se procesa el resultado obteniendo los alumnos pertenecientes al curso
			while($row =$resultado->fetch_assoc())
			{
				$consulta ="SELECT * FROM alumnos WHERE id_alumno =".$row['id_alumno'];
				$alumno = $this -> driver->query($consulta);
				$alumnos[]=$alumno->fetch_assoc();
			}

			return $alumnos;
		}	
	}	

	function obtenerHojasExtrasXCurso($idCurso)
	{
		$consulta ="SELECT * FROM hojasextras WHERE id_curso=$idCurso";
		$resultado = $this -> driver->query($consulta);

		if($resultado === FALSE)
				return FALSE;
		//se procesa el resultado
		else
		{
			while($row =$resultado->fetch_assoc())
				$hojas[]=$row;
			return $hojas;
		}
		
	}	

	function obtenerCalificacionesHojas($idAlumno)
	{
		
		$consulta ="SELECT * FROM calificaciones_hojas WHERE id_alumno = $idAlumno";
		$resultado = $this -> driver->query($consulta);

		if($resultado === FALSE)
				return FALSE;
		//se procesa el resultado
		else
		{
			while($row =$resultado->fetch_assoc())
				$calificaciones[]=$row;
			return $calificaciones;
		}
	}	

	function obtenerCalificaciones()
	{
		//session_start();
		$codigo=$_SESSION['usuario'];
		$consulta="SELECT calificaciones_actividades.* FROM calificaciones_actividades,alumnos where calificaciones_actividades.id_alumno=alumnos.id_alumno AND alumnos.codigo=\"$codigo\"";

		$resultado = $this -> driver->query($consulta);

		if($resultado === FALSE)
				return FALSE;
		//se procesa el resultado
		else
		{			
			while($row =$resultado->fetch_assoc())
				$calificaciones[]=$row;
			if(isset($calificaciones))
				return $calificaciones;
			else
				return FALSE;			
		}
	}


	function obtenerAsistenciasXAlumno($idCurso,$idAlumno)
	{
		$consulta ="SELECT * FROM asistencias WHERE id_curso=$idCurso AND id_alumno=$idAlumno";
		$resultado = $this -> driver->query($consulta);

		if($resultado ->num_rows==0)
				return FALSE;
		//se procesa el resultado
		else
		{
			while($row =$resultado->fetch_assoc())
				$alumnos[]=$row;
			return $alumnos;
		}
	}




	function obtenerCalificacionesActividades($idCurso)
	{
		$consulta ="SELECT * FROM calificaciones_Actividades WHERE id_alumno=$idAlumno AND id_curso=$idCurso";
		$resultado = $this -> driver->query($consulta);

		if($resultado === FALSE)
				return FALSE;
		//se procesa el resultado
		else
		{
			while($row =$resultado->fetch_assoc())
				$calificaciones[]=$row;
			return $calificaciones;
		}
	}

	function obtenerFechas($idCurso)
	{
		$consulta ="SELECT * FROM cursos WHERE id=$idCurso";
		$resultado = $this -> driver->query($consulta);

		if($resultado ->num_rows==0)
				return FALSE;
		//se procesa el resultado
		else
		{
			//segun el ciclo se obtienen las fechas de iniciO y fin del ciclo escolar
			$ciclo =$resultado->fetch_assoc();
			$consulta ="SELECT * FROM ciclos WHERE ciclo='".$ciclo['ciclo']."'";
			$resultado = $this -> driver->query($consulta);
			$fechasCiclo =$resultado->fetch_assoc();
			
			$fechaInicio = $fechasCiclo['fechaInicio'];
			$fechaFin = $fechasCiclo['fechaFinalizacion'];

			//se obtienen todas las fechas en el rango
			$totalDias =array();
			$iDateFrom=mktime(1,0,0,substr($fechaInicio,5,2),     substr($fechaInicio,8,2),substr($fechaInicio,0,4));
			$iDateTo=mktime(1,0,0,substr($fechaFin,5,2),     substr($fechaFin,8,2),substr($fechaFin,0,4));

			//if ($iDateTo >= $iDateFrom) {
			   //array_push($fechasDisponibles,date('Y-m-d',$iDateFrom)); // first entry

		 	while ($iDateFrom < $iDateTo) {
			      $iDateFrom+=86400; // add 24 hours
			      array_push($totalDias,date('Y-m-d',$iDateFrom));
			    }
			//Se obtienen los dias en los que se imparte el curso
			$consulta ="SELECT *FROM horarios WHERE idCurso=$idCurso";
			$resultado = $this -> driver->query($consulta);
			$diasCurso = array();
			while ($row = $resultado->fetch_assoc()) {
				array_push($diasCurso, $row);
			}
			
			$diasNumero="";
			//se crea un arreglo con los dias de forma numerica
			foreach ($diasCurso as $dia) {
				switch ($dia['dia']) {
					case 'Lunes':
						$diasNumero.="1";
						break;
					case 'Martes':
						$diasNumero.="2";
						break;
					case 'Miercoles':
						$diasNumero.="3";
						break;
					case 'Jueves':
						$diasNumero.="4";
						break;
					case 'Viernes':
						$diasNumero.="5";
						break;
					case 'Sabado':
						$diasNumero.="6";
						break;
				}
			}
			//se regresan las fechas disponibles
			foreach ($totalDias as $dia) {
				$diaDeLaSemana = date('N', strtotime($dia));
				if(strpos($diasNumero, $diaDeLaSemana) !== false)
					$diasDisponibles[]=$dia;
			}
			return $diasDisponibles;



			//Se obtienen los horarios del curso
			$consulta ="SELECT * FROM horarios WHERE idCurso='".$idCurso."'";
			$resultado = $this -> driver->query($consulta);
			$horarios =$resultado->fetch_assoc();

			$fechas[]=$fechaInicio;
			return $fechas;

			if($resultado ->num_rows==0)
				return FALSE;
			else
			{
				while($row =$resultado->fetch_assoc())
					$fechas[]=$row;
				return $fechas;	
			}

			
		}
	}


}

?>