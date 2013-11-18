<?php

class LoginCtl
{
	public $modelo;

	public function ejecutar()
	{
		require_once("Modelo/LoginMdl.php");
		$this->modelo = new LoginMdl();
		if(empty($_POST))
		{
			//Se muestra la vista para logearse
			require_once("Vista/IngresoLogin.html");
		}
		else
		{
			//Obtener las variables para la alta
			//y limpiarlas
			$usuario 	= $_POST["usuario"];
			$password 	= $_POST["password"];

			$resultado= $this -> modelo -> ingresar($usuario,$password);
			if($resultado!= FALSE)
			{
				switch($resultado["tipo"])
				{
					case 0:
						//Administrador
						require_once("Vista/InicioAdministrador.html");
						break;
					case 1:
						//Profesor
						require_once("Vista/InicioProfesor.html");
						break;
					case 2:
						//Alumno
						require_once("Vista/InicioAlumno.html");
						break;
				}
			}
			else
			{
				echo "error";
			}
		}

	}
}
?>