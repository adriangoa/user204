<?php

class ProfesorCtl
{
	public $modelo;
	public function ejecutar()
	{
		require_once("Modelo/ProfesorMdl.php");
		
		$this->modelo = new ProfesorMdl();
		switch ($_GET['act'])
		{
			case "agregarCurso":
				if(empty($_POST))
				{
					//se prepara la vista con los ciclos disponibles
					//Obtener la vista
					$vista = file_get_contents("Vista/agregarCurso.html");

					$pos1 = strpos($vista, "<select id=\"ciclo_escolar\" name=\"ciclo_escolar\">");
					$len1 = strlen("<select id=\"ciclo_escolar\" name=\"ciclo_escolar\">");
					$url1 = substr($vista, $pos1+$len1);
					$pos2 = strpos($url1, "</select id=\"fin\">");
					$url2 = substr($url1, $pos2);
					$fila = str_replace($url2, '', $url1);
					//fila contiene el div de resultado
					//Genero los resultados segun los cursos
					$ciclos = $this -> modelo -> obtenerCiclos();
					
					foreach ($ciclos as $row) {
							$new_fila = $fila;
							$new_fila = str_replace("valorCiclo", $row['ciclo'], $new_fila);
							if(isset($filas))
							   $filas .= $new_fila;
							else
								$filas = $new_fila;
						}

						//echo $new_fila;
					$vista = str_replace($fila, $filas,$vista);
					echo $vista;
				}
				else
				{
					//Obtiene las Variables para agregar el curso
					$ciclo = $_POST["ciclo_escolar"];
					$nombreCurso=$_POST["nombre_curso"];
					$seccion=$_POST["seccion"];
					$nrc=$_POST["nrc"];
					$academia=$_POST["academia"];
					
					//se obtienen los horarios del formulario en arrays
					//primero se crea un arreglo para las horas de inicio
					$horasInicio=array();
					$contador=0;
					do
					{
						array_push($horasInicio, $_POST["hora-inicio".$contador]);
						$contador++;

					}while(isset($_POST["hora-inicio".$contador]));
					
					//luego se crea un arreglo para las horas de finalizacion
					$horasFin=array();
					$contador=0;
					do
					{
						array_push($horasFin, $_POST["hora-fin".$contador]);
						$contador++;

					}while(isset($_POST["hora-fin".$contador]));

					//un arreglo mas para los dias
					$dias=array();
					$contador=0;
					do
					{
						array_push($dias, $_POST["dia".$contador]);
						$contador++;

					}while(isset($_POST["dia".$contador]));


					$resultado = $this -> modelo -> agregarCurso($ciclo,$nombreCurso,$seccion,$nrc,$academia,$horasInicio,$horasFin,$dias);

					if($resultado!==FALSE)
					{
						require_once("Vista/agregarCurso.html");
					}
					else
					{
						echo "error";
					}

				}
				break;

			case "configurarCurso":
				if(empty($_POST))
				{
					//se prepara la vista con los curso disponibles
					//Obtener la vista
					$vista = file_get_contents("Vista/configurarCurso.html");

					$pos1 = strpos($vista, "<div class=\"contenedor\">");
					$len1 = strlen("<div class=\"contenedor\">");
					$url1 = substr($vista, $pos1+$len1);
					$pos2 = strpos($url1, "</div id=\"fin\">");
					$url2 = substr($url1, $pos2);
					$fila = str_replace($url2, '', $url1);
					//fila contiene el div de resultado

					//Se obtienen tambien las actividades
					$pos1 = strpos($vista, "<form action=\"index.php?ctl=Profesor&act=configurarCurso\" method=\"post\">");
					$len1 = strlen("<form action=\"index.php?ctl=Profesor&act=configurarCurso\" method=\"post\">");
					$url1 = substr($vista, $pos1+$len1);
					$pos2 = strpos($url1, "<tr id=\"fin\">");
					$url2 = substr($url1, $pos2);
					$filaActividad = str_replace($url2, '', $url1);
					//Genero los resultados segun los cursos
					$cursos = $this -> modelo -> obtenerCurso();
					

					
					foreach ($cursos as $row) {
							if(isset($filasActividad))
								unset($filasActividad);
							//Genero los resultados agregando tambien las actividades
							$actividades = $this -> modelo -> obtenerActividades($row['id']);

							$new_fila = $fila;
							$new_fila = str_replace("numero", $row['id'], $new_fila);
							$new_fila = str_replace("mostrar_ocultar", "mostrar_ocultar".$row['id'], $new_fila);
							$new_fila = str_replace("contenido", "contenido".$row['id'], $new_fila);
							$new_fila = str_replace("idCurso", $row['id'], $new_fila);
							$new_fila = str_replace("Ciclo", $row['ciclo'], $new_fila);
							$new_fila = str_replace("NombreCurso", $row['nombre'], $new_fila);
							$new_fila = str_replace("Academia", $row['academia'], $new_fila);
							$new_fila = str_replace("NRC", "NRC: ".$row['nrc'], $new_fila);
							$new_fila = str_replace("actividad", "actividad".$row['id'], $new_fila);//este hace referencia al id del input
							$new_fila = str_replace("porcentaje", "porcentaje".$row['id'], $new_fila);
							$new_fila = str_replace("boton-agregar", $row['id'], $new_fila);//para saber que validar

							foreach ($actividades as $raw) {
								if($raw["idCurso"]==$row["id"])
								{
									$new_filaActividad = $filaActividad;
									$new_filaActividad = str_replace("Actividad", $raw['actividad'], $new_filaActividad);
									$new_filaActividad = str_replace("Porcentaje", $raw['porcentaje'], $new_filaActividad);
									if(isset($filasActividad))
									   $filasActividad .= $new_filaActividad;
									else
									   $filasActividad = $new_filaActividad;
								}	
							}
							if(isset($filasActividad))
								$new_fila = str_replace($filaActividad, $filasActividad, $new_fila);
							if(isset($filas))
							   $filas .= $new_fila;
							else
								$filas = $new_fila;
						}

						//echo $new_fila;
					$vista = str_replace($fila, $filas,$vista);
					echo $vista;
				}
				else
				{
					//Obtener las variables para la alta
					//y limpiarlas
					$idCurso 	= $_POST["curso"];
					$actividad 	= $_POST["actividad".$idCurso];
					$porcentaje = $_POST["porcentaje".$idCurso];
					

					$resultado = $this -> modelo -> agregarActividad($idCurso, $actividad, $porcentaje);
					if($resultado!==FALSE)
					{   
						//se prepara la vista con los curso disponibles
						//Obtener la vista
						$vista = file_get_contents("Vista/configurarCurso.html");

						$pos1 = strpos($vista, "<div class=\"contenedor\">");
						$len1 = strlen("<div class=\"contenedor\">");
						$url1 = substr($vista, $pos1+$len1);
						$pos2 = strpos($url1, "</div id=\"fin\">");
						$url2 = substr($url1, $pos2);
						$fila = str_replace($url2, '', $url1);
						//fila contiene el div de resultado

						//Se obtienen tambien las actividades
						$pos1 = strpos($vista, "<form action=\"index.php?ctl=Profesor&act=configurarCurso\" method=\"post\">");
						$len1 = strlen("<form action=\"index.php?ctl=Profesor&act=configurarCurso\" method=\"post\">");
						$url1 = substr($vista, $pos1+$len1);
						$pos2 = strpos($url1, "<tr id=\"fin\">");
						$url2 = substr($url1, $pos2);
						$filaActividad = str_replace($url2, '', $url1);
						//Genero los resultados segun los cursos
						$cursos = $this -> modelo -> obtenerCurso();
						

						
						foreach ($cursos as $row) {
								if(isset($filasActividad))
									unset($filasActividad);
								//Genero los resultados agregando tambien las actividades
								$actividades = $this -> modelo -> obtenerActividades($row['id']);

								$new_fila = $fila;
								$new_fila = str_replace("numero", $row['id'], $new_fila);
								$new_fila = str_replace("mostrar_ocultar", "mostrar_ocultar".$row['id'], $new_fila);
								$new_fila = str_replace("contenido", "contenido".$row['id'], $new_fila);
								$new_fila = str_replace("idCurso", $row['id'], $new_fila);
								$new_fila = str_replace("Ciclo", $row['ciclo'], $new_fila);
								$new_fila = str_replace("NombreCurso", $row['nombre'], $new_fila);
								$new_fila = str_replace("Academia", $row['academia'], $new_fila);
								$new_fila = str_replace("NRC", "NRC: ".$row['nrc'], $new_fila);
								$new_fila = str_replace("actividad", "actividad".$row['id'], $new_fila);//este hace referencia al id del input
								$new_fila = str_replace("porcentaje", "porcentaje".$row['id'], $new_fila);
								$new_fila = str_replace("boton-agregar", $row['id'], $new_fila);//para saber que validar
								foreach ($actividades as $raw) {
									if($raw["idCurso"]==$row["id"])
									{
										$new_filaActividad = $filaActividad;
										$new_filaActividad = str_replace("Actividad", $raw['actividad'], $new_filaActividad);
										$new_filaActividad = str_replace("Porcentaje", $raw['porcentaje'], $new_filaActividad);
										if(isset($filasActividad))
										   $filasActividad .= $new_filaActividad;
										else
										   $filasActividad = $new_filaActividad;
									}	
								}
								if(isset($filasActividad))
									$new_fila = str_replace($filaActividad, $filasActividad, $new_fila);
								if(isset($filas))
								   $filas .= $new_fila;
								else
									$filas = $new_fila;
							}

							//echo $new_fila;
						$vista = str_replace($fila, $filas,$vista);
						echo $vista;	
					}
				}
				break;

			case "agregarCalificaciones":
				if(empty($_POST))
					require_once("Vista/agregarCalificaciones.html");
				else
				{

				}
				break;

			case "agregarAsistencias":
				if(empty($_POST))
					require_once("Vista/agregarAsistencias.html");
				else
				{

				}
				break;
				
			case "agregarAlumno":
				if(empty($_POST))
					require_once("Vista/agregarAlumno.html");
				else
				{
					//obtiene las variables para agregar el alumno
					$codigo = $_POST["codigo"];
					$nombre = $_POST["nombre"];
					$apellidos = $_POST["apellidos"];
					$carrera = $_POST["carrera"];
					$correo = $_POST["correo"];

					$celular = $_POST["celular"];
					$github = $_POST["github"];
					$web = $_POST["web"];
					
					$resultado = $this -> modelo -> agregarAlumno($codigo,$nombre,$apellidos,$carrera,$correo,$celular,$github,$web);
					
					if($resultado!==FALSE)
					{
						
						require_once("Vista/agregarAlumno.html");
						
					}
					else
					{
						echo "error";
					}


				}
				break;
				
			case "altaAlumnos":
				if(empty($_POST))
					require_once("Vista/altaAlumnos.html");
				else
				{

				}
				break;
				
			case "clonarCurso":
				if(empty($_POST))
					require_once("Vista/clonarCurso.html");
				else
				{

				}
				break;
				
			default:
			 	require_once("Vista/InicioProfesor.html");
			 	break;
				


		}
	}
}
?>