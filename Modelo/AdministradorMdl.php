<?php

class AdministradorMdl
{
	public $driver;

	function __construct(){
		require_once("www/PHPMailer/class.phpmailer.php");
		$this -> driver = new mysqli('localhost','root','','cc409_user204');
		if($this -> driver->connect_errno)
			die("<br>Error en la conexión");
	}

	function agregarCiclo($ciclo,$fechaInicio,$fechaFinalizacion,$fechasMotivos)
	{

		$query = 
				"INSERT INTO ciclos
				(ciclo, fechaInicio, fechaFinalizacion)
				VALUES (
					\"$ciclo\",
					\"$fechaInicio\",
					\"$fechaFinalizacion\"
				)";

		$r = $this -> driver -> query($query);

		if($this -> driver -> insert_id){
			$agregaMotivos=$this -> agregarMotivos($this -> driver -> insert_id,$fechasMotivos);
			return $this -> driver -> insert_id;
		}
		elseif($r === FALSE)
			return FALSE;
	}

	function agregarMotivos($idCiclo,$fechasMotivos)
	{
		foreach ($fechasMotivos as $key => $value) {
			$query = 
				"INSERT INTO diasnoefectivos
				(idCiclo, fecha, Motivo)
				VALUES (
					\"$idCiclo\",
					\"$key\",
					\"$value\"
				)";
			$r = $this -> driver -> query($query);
			if($r === FALSE)
				return FALSE;
		}
		

	}
	function agregarProfesor($codigo,$nombre,$apellidos,$correo)
	{
		$clave = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890"), 0,10);
		//se cifra la clave
		$cifrada=sha1($clave);

		$query = 
				"INSERT INTO profesores
				(codigo,password,nombre, apellidos,correo,tipo)
				VALUES (
					'".$codigo."',
					'".$cifrada."',
					'".$nombre."',
					'".$apellidos."',
					'".$correo."',
					'1'

				)";
			$r = $this -> driver -> query($query);
			if($r === FALSE)
				return FALSE;
			else
				$this -> enviarCorreo($nombre,$correo,$clave,$codigo);
	}

	function enviarCorreo($nombre,$correo,$clave,$codigo)
	{
			$mail = new PHPMailer();
			
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

						<div style="background-color:#32AABB; width:100%; height:40px; text-align:center;"><h1 style="color:white; font-weight:bold;">Bienvenido Profesor</h1></div>
						<div style="text-align: center">
							<h2>Datos de acceso</h2>
							<br />
								<div style="text-align: center">
								<span style="font-weight:bold;font-size: 17px;">Usuario:</span> '.$codigo.'
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
}
?>