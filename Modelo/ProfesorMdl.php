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
				(codigo, nombre, apellidos, carrera, correo, celular, github, web)
				VALUES (
					'".$codigo."',
					'".$nombre."',
					'".$apellidos."',
					'".$carrera."',
					'".$correo."',
					'".$celular."',
					'".$github."',
					'".$web."'

				)";
			$r = $this -> driver -> query($query);
			if($r === FALSE)
				return FALSE;
			else
				$this -> enviarCorreo($nombre,$correo);
	}
	function obtenerCiclos()
	{
		$query = 'SELECT * FROM ciclos';

		$r = $this -> driver -> query($query);

		while($row = $r -> fetch_assoc())
			$rows[] = $row;

		return $rows;
	}

	function obtenerCurso()
	{
		$query = 'SELECT * FROM cursos';

		$r = $this -> driver -> query($query);

		while($row = $r -> fetch_assoc())
			$rows[] = $row;

		return $rows;
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
		$query = "SELECT * FROM actividades ";

		$r = $this -> driver -> query($query);

		while($row = $r -> fetch_assoc())
			$rows[] = $row;

		return $rows;	
	}

	function enviarCorreo($nombre,$correo)
	{
			$mail = new PHPMailer();
			$clave = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890"), 0,10);
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

	function agregarHojaExtra($actividad,$cantidad,$porcentajes)
	{
		for($i = 0; $i<$cantidad; $i++)
		{
			$query = 
				"INSERT INTO hojasextras
				(porcentaje, id_actividad)
				VALUES (
					'".$porcentajes[$i]."',
					'".$actividad."'
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

	function darAltaAlumnos($codigos,$curso)
	{
		foreach ($codigos as  $codigo) {
			$query = 
				"INSERT INTO alumnos_cursos
				(codigo, id_curso)
				VALUES (
					'".$codigo."',
					'".$curso."'
				)";
			$r = $this -> driver -> query($query);
			if($r === FALSE)
				return FALSE;
		}
	}
}

?>