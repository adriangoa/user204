<?php

class ProfesorMdl
{
	public $driver;

	function __construct(){
		require_once("www/PHPMailer/class.phpmailer.php");
		$this -> driver = new mysqli('localhost','root','','cc409_user204');
		if($this -> driver->connect_errno)
			die("<br>Error en la conexión");
	}

	function agregarCurso($ciclo,$nombreCurso,$seccion,$nrc,$academia,$horasInicio,$horasFin,$dias)
	{
		$query = 
				"INSERT INTO cursos
				(ciclo, nombre, seccion, nrc, academia)
				VALUES (
					\"$ciclo\",
					\"$nombreCurso\",
					\"$seccion\",
					\"$nrc\",
					\"$academia\"
				)";

		$r = $this -> driver -> query($query);

		if($this -> driver -> insert_id){
			$agregaHorarios=$this -> agregarHorarios($this -> driver -> insert_id,$horasInicio,$horasFin,$dias);
			return $this -> driver -> insert_id;
		}
		elseif($r === FALSE)
			return FALSE;
	}

	function agregarHorarios($idCurso,$horasInicio,$horasFin,$dias)
	{
		$totalHorarios=count($horasInicio);
		for($i=0;$i<$totalHorarios;$i++)
		{
			$query = 
				"INSERT INTO horarios
				(idCurso, horaInicio, horaFin, dia)
				VALUES (
					'".$idCurso."',
					'".$horasInicio[$i]."',
					'".$horasFin[$i]."',
					'".$dias[$i]."'
				)";
			$r = $this -> driver -> query($query);
			if($r === FALSE)
				return FALSE;
		}
	}
	function agregarAlumno($codigo,$nombre,$apellidos,$carrera,$correo,$celular,$github,$web)
	{
		$clave = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890"), 0,10);
		//se cifra la clave
		$cifrada=sha1($clave);
		$valCelular=$celular;
		$valGithub=$github;
		$valWeb=$web;
		if($celular=="")
			$valCelular=NULL;
		if($github=="")
			$valGithub=NULL;
		if($web=="")
			$valWeb=NULL;

		$query = 
				"INSERT INTO alumnos
				(codigo,password,nombre, apellidos, carrera, correo, celular, github, web, tipo)
				VALUES (
					'".$codigo."',
					'".$cifrada."',
					'".$nombre."',
					'".$apellidos."',
					'".$carrera."',
					'".$correo."',
					'".$celular."',
					'".$github."',
					'".$web."',
					'2'

				)";
			$r = $this -> driver -> query($query);
			if($r === FALSE)
				return FALSE;
			else
				$this -> enviarCorreo($nombre,$correo,$clave);
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
		$query = 'SELECT * FROM cursos';

		$r = $this -> driver -> query($query);

		while($row = $r -> fetch_assoc())
			$rows[] = $row;
		if(isset($rows))
			return $rows;
		else
			return FALSE;
	}
	function obtenerCurso($idCurso)
	{
		$query = "SELECT * FROM cursos WHERE id = $idCurso";

		$r = $this -> driver -> query($query);

		while($row = $r -> fetch_assoc())
			$rows[] = $row;
		if(isset($rows))
			return $rows;
		else
			return FALSE;
	}

	function obtenerCursoXCiclo($ciclo)
	{
		$query = "SELECT *FROM cursos WHERE ciclo='".$ciclo."'";

		$r = $this -> driver -> query($query);

		while($row = $r -> fetch_assoc())
			$rows[] = $row;
		if(isset($rows))
			return $rows;
		else
			return FALSE;
	}

	function agregarActividad($idCurso, $actividad, $porcentaje)
	{
		$query = 
				"INSERT INTO actividades
				(idCurso, actividad, porcentaje)
				VALUES (
					'".$idCurso."',
					'".$actividad."',
					'".$porcentaje."'
				)";
			$r = $this -> driver -> query($query);
			if($r === FALSE)
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

	function enviarCorreo($nombre,$correo,$clave)
	{
			$mail = new PHPMailer();
			
			$codigo_verificacion = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890"), 0,5);


			$mail->IsSMTP(); // enable SMTP
			$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
			$mail->SMTPAuth = true; // authentication enabled
			$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
			$mail->Host = "smtp.gmail.com";
			$mail->Port = 465; // or 587
			$mail->IsHTML(true);
			$mail->Username = "cc409user204@gmail.com";
			$mail->Password = "cucei204";
			$mail->SetFrom($correo);
			$mail->Subject = "Bienvenido";
			$mail->Body = '
					<div id="contenedor" style="background-color: #FFFFFF;text-align: center;">

						<div style="background-color:#32AABB; width:100%; height:40px; text-align:center;"><h1 style="color:white; font-weight:bold;">Bienvenido</h1></div>
						<div style="text-align: center">
							<p style="font-size: 18px; color:gray;">
							Para hacer uso de tu cuenta ingresa el siguiente codigo de verificacion:
							<span style="font-size: 19px; color:#FF4719">'.$codigo_verificacion.'</span></p><br />
							<a href="http://localhost/user204/"><input type="button" value="Verificar" style="border:1px solid #CED5D7;box-shadow: 0 0 0 3px #EEF5F7;padding: 8px 16px 8px 16px;border-radius: 5px;font-weight: bold;color:black;"></a>
						</div>
						<div style="text-align: center">
							<h2>Datos de acceso</h2>
							<br />
								<div style="text-align: center">
								<span style="font-weight:bold;font-size: 17px;">Usuario:</span> '.$correo.'
								<br />
								<span style="font-weight:bold;font-size: 17px;">Contrase&ntilde;a:</span> '.$clave.'
							</div>
						</div>
					</div>
			';
			$mail->AddAddress($correo);
			 if(!$mail->Send())
			    {
			    echo "Mailer Error: " . $mail->ErrorInfo;
			    }
			    else
			    {
			    	//echo "Message has been sent";
			    }
	}

	function agregarHojaExtra($actividad,$cantidad,$nombres,$porcentajes,$idCurso)
	{
		for($i = 0; $i<$cantidad; $i++)
		{
			$query = 
				"INSERT INTO hojasextras
				(nombre,porcentaje, id_actividad, id_curso)
				VALUES (
					'".$nombres[$i]."',
					'".$porcentajes[$i]."',
					'".$actividad."',
					'".$idCurso."'
				)";
			$r = $this -> driver -> query($query);
			if($r === FALSE)
				return FALSE;
		}
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

	function darAltaAlumnos($idAlumno,$curso)
	{
		foreach ($idAlumno as  $id) {
			$consulta ="SELECT * FROM alumnos_cursos WHERE id_alumno =$id AND id_curso=$curso";
			$alumno = $this -> driver->query($consulta);
			if($alumno->num_rows==0)
			{
				$query = 
				"INSERT INTO alumnos_cursos
				(id_alumno, id_curso)
				VALUES (
					'".$id."',
					'".$curso."'
				)";
				$r = $this -> driver -> query($query);
				if($r === FALSE)
					return FALSE;
			}
			
		}
	}

	function agregarCalificacionesActividades($codigoAlumno,$idCurso,$arrayCalificaciones)
	{
		foreach ($arrayCalificaciones as $idActividad => $calificacion) {
			//se obtiene el nombre de la actividad correspondiente
			$consulta ="SELECT actividad FROM actividades WHERE id=$idActividad";
			$resultado = $this -> driver->query($consulta);
			$actividad=$resultado->fetch_assoc();
			$query = 
				"INSERT INTO calificaciones_actividades
				(id_alumno, id_actividad, nombre_actividad, calificacion, id_curso)
				VALUES (
					'".$codigoAlumno."',
					'".$idActividad."',
					'".$actividad["actividad"]."',
					'".$calificacion."',
					'".$idCurso."'

				)";
			$r = $this -> driver -> query($query);
			if($r === FALSE)
				return FALSE;
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

	function agregarCalificacionesHojasExtras($codigoAlumno,$idCurso,$arrayHojasExtras)
	{
		foreach ($arrayHojasExtras as $idHoja => $calificacion) {
			//se obtiene el id de la actividad correspondiente
			$consulta ="SELECT id_actividad FROM hojasextras WHERE id=$idHoja";
			$resultado = $this -> driver->query($consulta);
			$actividad=$resultado->fetch_assoc();
			$query = 
				"INSERT INTO calificaciones_hojas
				(id_alumno, id_hoja, calificacion, id_curso, id_actividad)
				VALUES (
					'".$codigoAlumno."',
					'".$idHoja."',
					'".$calificacion."',
					'".$idCurso."',
					'".$actividad["id_actividad"]."'
				)";
			$r = $this -> driver -> query($query);
			if($r === FALSE)
				return FALSE;
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
	function obtenerCalificacionesActividades($idAlumno,$idCurso)
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

	function agregarAsistencias($fechasPost)
	{
		$campos = explode("*", $fechasPost[0]);
		$idcurso=$campos[1];
		$totalFecha = $this->obtenerFechas($campos[1]);
		//por cada alumno del curso
		$alumnos=$this->obtenerAlumnosXCurso($campos[1]);
		foreach ($alumnos as $alumno) {
				foreach ($totalFecha as $fecha) {
				$asistio=false;
				//foreach de cada fecha del arreglo, supongo que se puede mejorar
				foreach ($fechasPost as  $asistencia) {
					unset($campos);
					$campos = explode("*", $asistencia);
					if($fecha == $campos[2] && $alumno['id_alumno'] == $campos[0])
					{
						$asistio=true;
						break;
					}
						
				}
				if($asistio)
				{
					//si asistio
					$seleciona ="SELECT * FROM asistencias WHERE id_alumno='".$alumno['id_alumno']."' AND id_curso='".$campos[1]."' AND fecha = '".$fecha."'";
					$resultado =$this -> driver -> query($seleciona);
					
					if($resultado->num_rows==0)
					{
						$query = 
						"INSERT INTO asistencias
						(id_alumno,id_curso, fecha,asistencia)
						VALUES (
							'".$alumno['id_alumno']."',
							'".$campos[1]."',
							'".$fecha."',
							'1'
						)";
						$r = $this -> driver -> query($query);
						if($r === FALSE)
							return FALSE;
					}
					else
					{
						$stmt = $this -> driver->prepare("UPDATE asistencias SET asistencia ='1' WHERE id_alumno='".$alumno['id_alumno']."' AND id_curso='".$campos[1]."' AND fecha = '".$fecha."'");
						$stmt->execute();
					}   
				}
				else
				{
					//no tiene asistencia
					$seleciona ="SELECT * FROM asistencias WHERE id_alumno='".$alumno['id_alumno']."' AND id_curso='".$campos[1]."' AND fecha = '".$fecha."'";
					$resultado =$this -> driver -> query($seleciona);
					
					if($resultado->num_rows==0)
					{
						$query = 
						"INSERT INTO asistencias
						(id_alumno,id_curso, fecha,asistencia)
						VALUES (
							'".$alumno['id_alumno']."',
							'".$campos[1]."',
							'".$fecha."',
							'0'
						)";
						$r = $this -> driver -> query($query);
						if($r === FALSE)
							return FALSE;
					}
					else
					{
						$stmt = $this -> driver->prepare("UPDATE asistencias SET asistencia ='0' WHERE id_alumno='".$alumno['id_alumno']."' AND id_curso='".$campos[1]."' AND fecha = '".$fecha."'");
						$stmt->execute();
					}  
				}
				
			}


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

	function obtenerHorarios($idCurso)
	{
		$consulta ="SELECT * FROM horarios WHERE idCurso=$idCurso";
		$resultado = $this -> driver->query($consulta);

		if($resultado === FALSE)
				return FALSE;
		//se procesa el resultado
		else
		{
			while($row =$resultado->fetch_assoc())
				$horarios[]=$row;
			return $horarios;
		}

	}

	function clonarCurso($cicloBase, $idCurso, $cicloClonar)
	{
		//se obtiene la infor del curso a clonar
		$curso= $this->obtenerCurso($idCurso);
		$nombre = $curso[0]['nombre'];
		$seccion = $curso[0]['seccion'];
		$nrc = $curso[0]['nrc'];
		$academia = $curso[0]['academia'];

		//se clona dentro de la tabla de cursos
		$consulta = 
			"INSERT INTO cursos (ciclo,nombre, seccion , nrc, academia) 
			VALUES (
				'$cicloClonar',
				'$nombre',
				'$seccion',
				'$nrc',
				'$academia'
				)";

        mysqli_query($this -> driver, $consulta);
        $idCursoClonado = mysqli_insert_id($this -> driver);

		//se clonan los horarios
		$horariosBase = $this->obtenerHorarios($idCurso);

		foreach ($horariosBase as $horario) {
			$consulta = 
			"INSERT INTO horarios (idCurso,horaInicio, horaFin , dia) 
			VALUES (
				'".$idCursoClonado."',
				'".$horario['horaInicio']."',
				'".$horario['horaFin']."',
				'".$horario['dia']."'
				)";
			$resultado = $this -> driver->query($consulta);

		}

		//se clonan las actividades
		$actividadesBase = $this->obtenerActividades($idCurso);
		if($actividadesBase)
		{
				foreach ($actividadesBase as  $actividadBase) {
				$consulta = 
				"INSERT INTO actividades (actividad,porcentaje, idCurso) 
				VALUES (
					'".$actividadBase['actividad']."',
					'".$actividadBase["porcentaje"]."',
					'".$idCursoClonado."'
					)";
				mysqli_query($this -> driver, $consulta);
	        	$idActividadClonada = mysqli_insert_id($this -> driver);

	        	//se checa si esa actividad tiene hojas extras
	        	$hojasBase = $this->obtenerHojasExtras($actividadBase['id']);
	        	if($hojasBase!=FALSE)
	        	{
	        		foreach ($hojasBase as $hojaBase) {
	        			$consulta = 
						"INSERT INTO hojasextras (porcentaje,id_actividad, id_curso) 
						VALUES (
							'".$hojaBase['porcentaje']."',
							'".$idActividadClonada."',
							'".$idCursoClonado."'
							)";
						mysqli_query($this -> driver, $consulta);
	        		}
	        	}//fin if hojasBase
			}//fin foreach actividadesBase

		}
		
	}
}

?>