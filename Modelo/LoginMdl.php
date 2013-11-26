<?php

class LoginMdl
{
	public $driver;
	function __construct(){
				require_once("www/PHPMailer/class.phpmailer.php");
		$this -> driver = new mysqli('localhost','root','','cc409_user204');
		if($this -> driver->connect_errno)
			die("<br>Error en la conexión");
	}

	function ingresar($usuario, $password)
	{

		//Primero se busca en la tabla de usuarios
		$query = "SELECT * FROM alumnos WHERE codigo =\"$usuario\" AND password=\"$password\"";
		$r = $this -> driver -> query($query);//regresa un objeto
		if($r->num_rows==0)
			{

				//Luego se busca en la de profesores
				$query2 = "SELECT * FROM profesores WHERE codigo =\"$usuario\" AND password=\"$password\"";
				$r = $this -> driver -> query($query2);
				if($r->num_rows==0)
				{
					//Por ultimo se busca en la de administradores
					$query3 = "SELECT * FROM administradores WHERE codigo =\"$usuario\" AND password=\"$password\"";
					$r = $this -> driver -> query($query3);
				}
			}
		if($r->num_rows==0)
			return FALSE;
		else
		{
			$row = $r -> fetch_assoc();
			return $row;
		}
		
	}
	function recuperar($usuario, $correo)
	{
		$password= substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890"), 0,10);
		$cifrada= sha1($password);

		//Primero se busca en la tabla de usuarios
		$query = "UPDATE alumnos SET password=\"$cifrada\" WHERE codigo =\"$usuario\" AND correo=\"$correo\"";
		$r = $this -> driver -> query($query);//regresa un objeto
		var_dump($r);
		if($r==FALSE)
			{

				//Luego se busca en la de profesores
				$query2 = "UPDATE profesores SET password=\"$cifrada\" WHERE codigo =\"$usuario\" AND correo=\"$correo\"";
				$r = $this -> driver -> query($query2);
				if($r==FALSE)
				{
					//Por ultimo se busca en la de administradores
					$query3 = "UPDATE administradores SET password=\"$cifrada\" WHERE codigo =\"$usuario\" AND correo=\"$correo\"";
					$r = $this -> driver -> query($query3);
				}
			}
		if($r==TRUE)
			$this -> enviarCorreo($correo,$password);
		return $r;

		
	}

	function enviarCorreo($correo,$clave)
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

						<div style="background-color:#32AABB; width:100%; height:40px; text-align:center;"><h1 style="color:white; font-weight:bold;">Bienvenido</h1></div>
						<div style="text-align: center">
							<p style="font-size: 18px; color:gray;">
							Para hacer uso de tu cuenta ingresa el siguiente codigo de verificacion:
							</p><br />
							
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

	function existeUsuario($codigo, $correo)
	{
		$query = "SELECT * FROM alumnos WHERE codigo =\"$codigo\" AND correo=\"$correo\"";
		$r = $this -> driver -> query($query);//regresa un objeto
		if($r->num_rows==0)
			{
				return FALSE;
			}
		else
			return TRUE;
	}

}

?>