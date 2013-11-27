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
				//creamos una sesion  o cargamos una sesion ya existente
				session_start();
				//se verifica que no exista una session iniciada en , si existe se redirige
				if (!isset($_SESSION['nombre']))
				{

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
							
							$_SESSION['usuario']=$usuario;//que en realidad es el codigo
							//se guarda el id
							if(isset($resultado["id_alumno"]))
								$_SESSION['id']=$resultado["id_alumno"];
							if(isset($resultado["id_profesor"]))
								$_SESSION['id']=$resultado["id_profesor"];
							if(isset($resultado["id_administrador"]))
								$_SESSION['id']=$resultado["id_administrador"];
							$_SESSION['tipo']=$resultado["tipo"];
							$_SESSION['nombre']=$resultado["nombre"];
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
				}//fin if verifica sesion
				else
				{
					//ya esiste una session
					if(isset($_SESSION["tipo"]))
					{
						switch($_SESSION["tipo"])
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
						//Se muestra la vista para logearse
						require_once("Vista/IngresoLogin.html");
					}

					
				}
				
			break;

			case "cerrarSesion":
				if (ini_get("session.use_cookies")) {
				    $params = session_get_cookie_params();
				    setcookie(session_name(), '', time() - 42000,
				        $params["path"], $params["domain"],
				        $params["secure"], $params["httponly"]
				    );
				}
				session_destroy();
				$host  = $_SERVER['HTTP_HOST'];
				$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
				$extra = 'mypage.php';
				header("Location: http://$host/user204/index.php");
			break;

		}

		

	}
}
?>