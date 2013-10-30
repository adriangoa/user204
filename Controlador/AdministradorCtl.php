<?php

class AdministradorCtl
{
	public $modelo;
	public function ejecutar()
	{
		require_once("Modelo/AdministradorMdl.php");
		$this->modelo = new AdministradorMdl();
		switch ($_GET['act'])
		{
			case "agregarCiclo":
				if(empty($_POST))
					require_once("Vista/agregarCiclo.html");
				else
				{
					//Obtiene las Variables para agregar el ciclo
					$ciclo = $_POST["ciclo"];
					$fechaInicio=$_POST["fecha-inicio"];
					$fechaFinalizacion=$_POST["fecha-finalizacion"];

					
					//primero se crea un arreglo para las fechas
					$fechas=array();
					$contador=0;
					do
					{
						array_push($fechas, $_POST["dia-no-efectivo".$contador]);
						$contador++;

					}while(isset($_POST["dia-no-efectivo".$contador]));
					
					//luego se crea un arreglo para los motivos
					$motivos=array();
					$contador=0;
					do
					{
						array_push($motivos, $_POST["motivo".$contador]);
						$contador++;

					}while(isset($_POST["motivo".$contador]));
					//ahora si se crea el diccionario
					$fechasMotivos = array_combine($fechas, $motivos);

					$resultado = $this -> modelo -> agregarCiclo($ciclo,$fechaInicio,$fechaFinalizacion,$fechasMotivos);

					if($resultado!==FALSE)
					{
						require_once("Vista/agregarCiclo.html");
					}
					else
					{
						echo "error";
					}
				}
				break;
			case "editarCiclo":
				if(empty($_POST))
					require_once("Vista/editarCiclo.html");
				else
				{

				}
			default:
			 	require_once("Vista/InicioAdministrador.html");


		}
	}
}
?>