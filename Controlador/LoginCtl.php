<?php

class LoginCtl
{
	public $modelo;

	public function ejecutar()
	{
		require_once("Modelo/LoginMdl.php");
		$this->modelo = new LoginMdl();
		if(!isset($_GET['act']))
			$_GET['act']="defalult";

		switch($_GET['act'])
		{
			case 'Recuperar':
				if(empty($_POST))
				{
					//Se muestra la vista para recuperar
					require_once("Vista/recuperarContrasenia.html");
				}
				else
				{

					$usuario 	= $_POST["usuario"];
					$correo 	= $_POST["correo"];
				$resultado=$this-> modelo-> recuperar($usuario,$correo);
				if($resultado==FALSE)
					echo("ERROR");
				else
				{
					echo "Una nueva contraseña fue enviada a $correo";
					require("Vista/recuperarContrasenia.html");
				}
				}
			break;

			case 'validaUsuario':
				//se obtienen las variables mandadas por ajax
				$codigo = $_GET["codigo"];
				$correo = $_GET["correo"];

				//se llama a existeusuario para validar
				$resultado=$this-> modelo-> existeusuario($codigo,$correo);
				if($resultado)
					echo "existe";
				else
				{
					echo "noExiste";
				}

			break;

			case 'Login':
			default:
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
					//creamos una sesion  o cargamos una sesion ya sesion
					session_start();
					$resultado= $this -> modelo -> ingresar($usuario,$password);
					if($resultado!= FALSE)
					{
						$_SESSION['usuario']=$usuario;
						$_SESSION['password']=$password;
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
			break;
		}

		

	}
}
?>