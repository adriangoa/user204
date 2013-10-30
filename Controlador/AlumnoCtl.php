<?php

class AlumnoCtl
{
	public $modelo;
	public function ejecutar()
	{
		require_once("Modelo/AlumnoMdl.php");
		$this->modelo = new AlumnoMdl();
		switch ($_GET['act'])
		{
			case "calificaciones":
				if(empty($_POST))
					require_once("Vista/calificaciones.html");
				else
				{

				}
				break;

			case "asistencias":
				if(empty($_POST))
					require_once("Vista/asistencias.html");
				else
				{

				}
				break;

			default:
			 	require_once("Vista/InicioAlumno.html");
			 	break;
		}
	}
}
?>