<?php

class ProfesorCtl
{
	public $modelo;
	public function ejecutar()
	{
		session_start();
		if($_SESSION['tipo']!=1)
			header("Location: /user204/index.php");
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
					$cursos = $this -> modelo -> obtenerCursos();
					
					if($cursos==FALSE)
						{
							$new_fila = str_replace("Mostrar Actividades", "No existen cursos disponibles", $fila);
							$vista = str_replace($fila, $new_fila,$vista);
						}

					else
					{
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
							if($actividades===FALSE)
							{
								$new_filaActividad = $filaActividad;
								$new_filaActividad = str_replace($filaActividad, "", $new_filaActividad);
								if(isset($filasActividad))
									$filasActividad .= $new_filaActividad;
								else
									$filasActividad = $new_filaActividad;
							}
							else
							{
								foreach ($actividades as $raw) {
									if($raw["idCurso"]==$row["id"])
									{
		
										$new_filaActividad = $filaActividad;
										$new_filaActividad = str_replace("idCURSO", $row['id'], $new_filaActividad);
										$new_filaActividad = str_replace("Actividad", $raw['actividad'], $new_filaActividad);
										$new_filaActividad = str_replace("idAct", $raw['id'], $new_filaActividad);
										$new_filaActividad = str_replace("Porcentaje", $raw['porcentaje'], $new_filaActividad);
										if(isset($filasActividad))
										   $filasActividad .= $new_filaActividad;
										else
										   $filasActividad = $new_filaActividad;
									}	
								}//fin foreach actividades
							}
							
							if(isset($filasActividad))
								$new_fila = str_replace($filaActividad, $filasActividad, $new_fila);
							if(isset($filas))
							   $filas .= $new_fila;
							else
								$filas = $new_fila;
						}//fin foreach cursos

						//echo $new_fila;
						$vista = str_replace($fila, $filas,$vista);
					}
					

						
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
						$cursos = $this -> modelo -> obtenerCursos();
						

						
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
								if($actividades===FALSE)
								{
									$new_filaActividad = $filaActividad;
									$new_filaActividad = str_replace($filaActividad, "", $new_filaActividad);
									if(isset($filasActividad))
										$filasActividad .= $new_filaActividad;
									else
										$filasActividad = $new_filaActividad;
								}
								else
								{
									foreach ($actividades as $raw) {
										if($raw["idCurso"]==$row["id"])
										{
											$new_filaActividad = $filaActividad;
											$new_filaActividad = str_replace("idCURSO", $row['id'], $new_filaActividad);
											$new_filaActividad = str_replace("Actividad", $raw['actividad'], $new_filaActividad);
											$new_filaActividad = str_replace("numero", $raw['id'], $new_filaActividad);
											$new_filaActividad = str_replace("Porcentaje", $raw['porcentaje'], $new_filaActividad);
											if(isset($filasActividad))
											   $filasActividad .= $new_filaActividad;
											else
											   $filasActividad = $new_filaActividad;
										}	
									}//fin foreach actividades
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
				{
					//se prepara la vista con los curso disponibles
					//Obtener la vista
					$vista = file_get_contents("Vista/agregarCalificaciones.html");

					$pos1 = strpos($vista, "<div class=\"contenedor\">");
					$len1 = strlen("<div class=\"contenedor\">");
					$url1 = substr($vista, $pos1+$len1);
					$pos2 = strpos($url1, "</div id=\"fin\">");
					$url2 = substr($url1, $pos2);
					$fila = str_replace($url2, '', $url1);
					//fila contiene el div de resultado

					//Se obtienen tambien las actividades
					$pos1 = strpos($vista, "<form action=\"index.php?ctl=Profesor&act=agregarCalificaciones\" method=\"post\">");
					$len1 = strlen("<form action=\"index.php?ctl=Profesor&act=agregarCalificaciones\" method=\"post\">");
					$url1 = substr($vista, $pos1+$len1);
					$pos2 = strpos($url1, "<tr id=\"fin\">");
					$url2 = substr($url1, $pos2);
					$filaActividad = str_replace($url2, '', $url1);
					//Genero los resultados segun los cursos
					$cursos = $this -> modelo -> obtenerCursos();

					
					if($cursos==FALSE)
					{
						$new_fila = str_replace("Mostrar Alumnos", "No existen cursos disponibles", $fila);
						$vista = str_replace($fila, $new_fila,$vista);
					}
					else
					{
						foreach ($cursos as $row) {

							if(isset($filasActividad))
								unset($filasActividad);
							

							//Genero los resultados agregando tambien los Alumnos
							//$alumnosEnCurso = $this -> modelo -> obtenerAlumnosEnCurso($row['id']);
							$alumnos = $this -> modelo -> obtenerAlumnosXCurso($row['id']);

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

							if($alumnos===FALSE)
							{
								//No hay alumnos asignados a ese curso
								$new_fila = str_replace($filaActividad, "<td colspan='6'>No hay alumnos asignados a este curso</td>", $new_fila);

							}
							else
							{
								foreach ($alumnos as $raw) {
									//if($raw["idCurso"]==$row["id"])
									//{
		
										$new_filaActividad = $filaActividad;
										$new_filaActividad = str_replace("CODIGO", $raw['codigo'], $new_filaActividad);
										$new_filaActividad = str_replace("idCOD", $raw['id_alumno'], $new_filaActividad);
										$new_filaActividad = str_replace("NOMBRE", $raw['nombre'], $new_filaActividad);
										$new_filaActividad = str_replace("idCURSO", $row['id'], $new_filaActividad);
										if(isset($filasActividad))
										   $filasActividad .= $new_filaActividad;
										else
										   $filasActividad = $new_filaActividad;
									//}	
								}//fin foreach alumnos
							}
							
							if(isset($filasActividad))
								$new_fila = str_replace($filaActividad, $filasActividad, $new_fila);
							if(isset($filas))
							   $filas .= $new_fila;
							else
								$filas = $new_fila;
						}//fin foreach cursos

						//echo $new_fila;
						$vista = str_replace($fila, $filas,$vista);
					}

					
					

						
					echo $vista;
				}
					
				else
				{ 	
					//se obtienen las variables
					$codigoAlumno = $_POST["codigo-alumno"];
					$idCurso = $_POST["id-curso"];

					//se obtien los id de las actividades de ese curso
					$actividades = $this -> modelo -> obtenerActividades($idCurso);


					//en base al resultado se llena un array con las calificaciones de cada actividad
					$arrayCalificaciones = array();
					$arrayHojasExtras = array();
					foreach ($actividades as $actividad) {
						//se verifica si esa actividad tiene hojas extras
						$hojasExtras= $this -> modelo ->obtenerHojasExtras($actividad["id"]);
						$i=0;
						$total=0;
						if($hojasExtras!==FALSE)
						{
							foreach ($hojasExtras as $hoja) {
								$arrayHojasExtras[$hoja["id"]]=$_POST[$actividad["id"]."-".$i];
								
								$total+=$_POST[$actividad["id"]."-".$i];
								$i++;
							}
							$arrayCalificaciones[$actividad["id"]]=$total;
						}
						else
							$arrayCalificaciones[$actividad["id"]]=$_POST[$actividad["id"]];
					}

					$resultado = $this -> modelo -> agregarCalificacionesActividades($codigoAlumno,$idCurso,$arrayCalificaciones);
					$resultado2 = $this -> modelo -> agregarCalificacionesHojasExtras($codigoAlumno,$idCurso,$arrayHojasExtras);
					if($resultado!==FALSE && $resultado2!==FALSE)
					{
						header("Location: index.php?ctl=Profesor&act=agregarCalificaciones"); /* Redirect browser */
					}
					else
					{

						echo "error";
					}
				}
				break;

			case "agregarAsistencias":
				if(empty($_POST))
				{
					//se prepara la vista con los curso disponibles
					//Obtener la vista
					$vista = file_get_contents("Vista/agregarAsistencias.html");

					$pos1 = strpos($vista, "<div class=\"contenedor\">");
					$len1 = strlen("<div class=\"contenedor\">");
					$url1 = substr($vista, $pos1+$len1);
					$pos2 = strpos($url1, "</div id=\"fin\">");
					$url2 = substr($url1, $pos2);
					$fila = str_replace($url2, '', $url1);
					//fila contiene el div de resultado

					//Se obtienen tambien la columna de asitencias para llenar segun sea necesario
					$pos1 = strpos($vista, "</td id=\"fechas\">");
					$len1 = strlen("</td id=\"fechas\">");
					$url1 = substr($vista, $pos1+$len1);
					$pos2 = strpos($url1, "</tr id=\"fin\">");
					$url2 = substr($url1, $pos2);
					$filaActividad = str_replace($url2, '', $url1);

					//Se obtienen tambien la fila de  alumnos
					$pos1 = strpos($vista, "<tr id=\"filaAlumno\">");
					$len1 = strlen("<tr id=\"filaAlumno\">");
					$url1 = substr($vista, $pos1+$len1);
					$pos2 = strpos($url1, "</tr id=\"fin\">");
					$url2 = substr($url1, $pos2);
					$filaAlumno = str_replace($url2, '', $url1);


					//Genero los resultados segun los cursos
					$cursos = $this -> modelo -> obtenerCursos();
					
					if($cursos==FALSE)
						{
							$new_fila = str_replace("Mostrar Actividades", "No existen cursos disponibles", $fila);
							$vista = str_replace($fila, $new_fila,$vista);
						}

					else
					{
						$primerAlumno=true;
						foreach ($cursos as $row) {

							if(isset($filasActividad))
								unset($filasActividad);

							//se obtienen las fechas correspondintes a ese curso
							$actividades = $this -> modelo -> obtenerFechas($row['id']);

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
							//se adaptan las tablas para segun las fechas a mostrar
							if(count($actividades)>0)
							{
								$new_fila = str_replace("colspan1", count($actividades)/3, $new_fila);//para saber que validar
								$new_fila = str_replace("colspan2", count($actividades)/3, $new_fila);//para saber que validar
								$new_fila = str_replace("colspan3", (count($actividades)/3)+1, $new_fila);//para saber que validar
								$new_fila = str_replace("[colspanBoton]", count($actividades)+1, $new_fila);//para saber que validar
							}
							if($actividades===FALSE)
							{
								
								$new_filaActividad = $filaActividad;
								$new_filaActividad = str_replace($filaActividad, "", $new_filaActividad);
								if(isset($filasActividad))
									$filasActividad .= $new_filaActividad;
								else
									$filasActividad = $new_filaActividad;
							}
							else
							{
								
								unset($arrayFechas);
								foreach ($actividades as $raw) {
									
									if($row["id"])
									{
										$fecha = explode("-", $raw);
										$arrayFechas[] =	$raw;
										$new_filaActividad = $filaActividad;
										$new_filaActividad = str_replace("[fecha]", $fecha[2]."<br>".$fecha[1]."<br>".$fecha[0], $new_filaActividad);
										if(isset($filasActividad))
										   $filasActividad .= $new_filaActividad;
										else
										   $filasActividad = $new_filaActividad;
									}	
								}//fin foreach actividades
							}
							
							

							//Se procesa la fila de alumnos
							$alumnos = $this -> modelo -> obtenerAlumnosXCurso($row['id']);
							if($alumnos===FALSE)
							{
								
								
								$new_filaAlumno = $filaAlumno;
								$new_filaAlumno = str_replace($filaAlumno, "", $new_filaAlumno);
								if(isset($filasAlumnos))
									$filasAlumnos = $new_filaAlumno;
								else
									$filasAlumnos = $new_filaAlumno;

								$new_fila = str_replace($filaAlumno, $filasAlumnos, $new_fila);
							}
							else
							{	
								unset($filasAlumnos);
								
								foreach ($alumnos as $raw) {
									
									if($row["id"])
									{
										//se obtienen las asistencias actuales de ese alumno en ese curso
										$asistencias = $this -> modelo -> obtenerAsistenciasXAlumno($row['id'],$raw['id_alumno']);
										$new_filaAlumno = $filaAlumno;
										$new_filaAlumno = str_replace("[nombreAlumno]", $raw['nombre'], $new_filaAlumno);
											
										if($asistencias===FALSE)
										{
											$new_filaAlumno = str_replace("[checkboxFecha]", "<input type='checkbox' name='fechas[]' value='".$raw['id_alumno']."*".$row['id']."*".$arrayFechas[0]."'>", $new_filaAlumno);
											for ($i=1; $i < count($arrayFechas); $i++) { 
												$new_filaAlumno .= "<td><input type='checkbox' name='fechas[]' value='".$raw['id_alumno']."*".$row['id']."*".$arrayFechas[$i]."'></td>";
											}
										}
										else
										{	
											$primerFecha=true;
											foreach ($asistencias as $asistencia) {
												if($asistencia["asistencia"]==1)
												{
													if($primerFecha)
													{
														$new_filaAlumno = str_replace("[checkboxFecha]", "<input type='checkbox' checked='true'  name='fechas[]' value='".$raw['id_alumno']."*".$row['id']."*".$asistencia['fecha']."'>", $new_filaAlumno);
														$primerFecha=false;
													}
													else
														$new_filaAlumno .= "<td><input type='checkbox' checked='true'  name='fechas[]' value='".$raw['id_alumno']."*".$row['id']."*".$asistencia['fecha']."'></td>";
												}
												else
												{
													if($primerFecha)
													{
														$new_filaAlumno = str_replace("[checkboxFecha]", "<input type='checkbox'  name='fechas[]' value='".$raw['id_alumno']."*".$row['id']."*".$asistencia['fecha']."'>", $new_filaAlumno);
														$primerFecha=false;
													}
													else
														$new_filaAlumno .= "<td><input type='checkbox'  name='fechas[]' value='".$raw['id_alumno']."*".$row['id']."*".$asistencia['fecha']."'></td>";
												}

												
											}
										}
										$new_filaAlumno .="</tr>";
										if(isset($filasAlumnos))
										   $filasAlumnos .= $new_filaAlumno;
										else
										   $filasAlumnos = $new_filaAlumno;
									}	
								}//fin foreach alumnos
								$new_fila = str_replace($filaAlumno, $filasAlumnos, $new_fila);
								
							}

							if(isset($filasActividad))
								$new_fila = str_replace($filaActividad, $filasActividad, $new_fila);
								
							if(isset($filas))
							   $filas .= $new_fila;
							else
								$filas = $new_fila;
						}//fin foreach cursos

						//echo $new_fila;
						$vista = str_replace($fila, $filas,$vista);

					}
					echo $vista;
				}
					
				else
				{
					//se obtiene el array con los checkbox
					$fechasPost = $_POST['fechas'];
					

					//se guardan las fechas en la base de datos
					$resultado = $this -> modelo -> agregarAsistencias($fechasPost);
					if($resultado!==FALSE)
					{
						
						//se prepara la vista con los curso disponibles
					//Obtener la vista
					$vista = file_get_contents("Vista/agregarAsistencias.html");

					$pos1 = strpos($vista, "<div class=\"contenedor\">");
					$len1 = strlen("<div class=\"contenedor\">");
					$url1 = substr($vista, $pos1+$len1);
					$pos2 = strpos($url1, "</div id=\"fin\">");
					$url2 = substr($url1, $pos2);
					$fila = str_replace($url2, '', $url1);
					//fila contiene el div de resultado

					//Se obtienen tambien la columna de asitencias para llenar segun sea necesario
					$pos1 = strpos($vista, "</td id=\"fechas\">");
					$len1 = strlen("</td id=\"fechas\">");
					$url1 = substr($vista, $pos1+$len1);
					$pos2 = strpos($url1, "</tr id=\"fin\">");
					$url2 = substr($url1, $pos2);
					$filaActividad = str_replace($url2, '', $url1);

					//Se obtienen tambien la fila de  alumnos
					$pos1 = strpos($vista, "<tr id=\"filaAlumno\">");
					$len1 = strlen("<tr id=\"filaAlumno\">");
					$url1 = substr($vista, $pos1+$len1);
					$pos2 = strpos($url1, "</tr id=\"fin\">");
					$url2 = substr($url1, $pos2);
					$filaAlumno = str_replace($url2, '', $url1);


					//Genero los resultados segun los cursos
					$cursos = $this -> modelo -> obtenerCursos();
					
					if($cursos==FALSE)
						{
							$new_fila = str_replace("Mostrar Actividades", "No existen cursos disponibles", $fila);
							$vista = str_replace($fila, $new_fila,$vista);
						}

					else
					{
						foreach ($cursos as $row) {

							if(isset($filasActividad))
								unset($filasActividad);

							//se obtienen las fechas correspondintes a ese curso
							$actividades = $this -> modelo -> obtenerFechas($row['id']);

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
							//se adaptan las tablas para segun las fechas a mostrar
							if(count($actividades)>0)
							{
								$new_fila = str_replace("colspan1", count($actividades)/3, $new_fila);//para saber que validar
								$new_fila = str_replace("colspan2", count($actividades)/3, $new_fila);//para saber que validar
								$new_fila = str_replace("colspan3", (count($actividades)/3)+1, $new_fila);//para saber que validar
								$new_fila = str_replace("[colspanBoton]", count($actividades)+1, $new_fila);//para saber que validar
							}
							if($actividades===FALSE)
							{
								
								$new_filaActividad = $filaActividad;
								$new_filaActividad = str_replace($filaActividad, "", $new_filaActividad);
								if(isset($filasActividad))
									$filasActividad .= $new_filaActividad;
								else
									$filasActividad = $new_filaActividad;
							}
							else
							{
								
								unset($arrayFechas);
								foreach ($actividades as $raw) {
									
									if($row["id"])
									{
										$fecha = explode("-", $raw);
										$arrayFechas[] =	$raw;
										$new_filaActividad = $filaActividad;
										$new_filaActividad = str_replace("[fecha]", $fecha[2]."<br>".$fecha[1]."<br>".$fecha[0], $new_filaActividad);
										if(isset($filasActividad))
										   $filasActividad .= $new_filaActividad;
										else
										   $filasActividad = $new_filaActividad;
									}	
								}//fin foreach actividades
							}
							
							

							//Se procesa la fila de alumnos
							$alumnos = $this -> modelo -> obtenerAlumnosXCurso($row['id']);
							if($alumnos===FALSE)
							{
								
								
								$new_filaAlumno = $filaAlumno;
								$new_filaAlumno = str_replace($filaAlumno, "", $new_filaAlumno);
								if(isset($filasActividad))
									$filasAlumnos = $new_filaAlumno;
								else
									$filasAlumnos = $new_filaAlumno;
								$new_fila = str_replace($filaAlumno, $filasAlumnos, $new_fila);
							}
							else
							{	
								unset($filasAlumnos);
								
								foreach ($alumnos as $raw) {
									
									if($row["id"])
									{
										//se obtienen las asistencias actuales de ese alumno en ese curso
										$asistencias = $this -> modelo -> obtenerAsistenciasXAlumno($row['id'],$raw['id_alumno']);
										$new_filaAlumno = $filaAlumno;
										$new_filaAlumno = str_replace("[nombreAlumno]", $raw['nombre'], $new_filaAlumno);
										if($asistencias===FALSE)
										{
											$new_filaAlumno = str_replace("[checkboxFecha]", "<input type='checkbox' name='fechas[]' value='".$raw['id_alumno']."*".$row['id']."*".$arrayFechas[0]."'>", $new_filaAlumno);
											for ($i=1; $i < count($arrayFechas); $i++) { 
												$new_filaAlumno .= "<td><input type='checkbox' name='fechas[]' value='".$raw['id_alumno']."*".$row['id']."*".$arrayFechas[$i]."'></td>";
											}
										}
										else
										{	
											$primerFecha=true;
											foreach ($asistencias as $asistencia) {
												if($asistencia["asistencia"]==1)
												{
													if($primerFecha)
													{
														$new_filaAlumno = str_replace("[checkboxFecha]", "<input type='checkbox' checked='true'  name='fechas[]' value='".$raw['id_alumno']."*".$row['id']."*".$asistencia['fecha']."'>", $new_filaAlumno);
														$primerFecha=false;
													}
													else
														$new_filaAlumno .= "<td><input type='checkbox' checked='true'  name='fechas[]' value='".$raw['id_alumno']."*".$row['id']."*".$asistencia['fecha']."'></td>";
												}
												else
												{
													if($primerFecha)
													{
														$new_filaAlumno = str_replace("[checkboxFecha]", "<input type='checkbox'  name='fechas[]' value='".$raw['id_alumno']."*".$row['id']."*".$asistencia['fecha']."'>", $new_filaAlumno);
														$primerFecha=false;
													}
													else
														$new_filaAlumno .= "<td><input type='checkbox'  name='fechas[]' value='".$raw['id_alumno']."*".$row['id']."*".$asistencia['fecha']."'></td>";
												}

												
											}
										}
										$new_filaAlumno .="</tr>";
										if(isset($filasAlumnos))
										   $filasAlumnos .= $new_filaAlumno;
										else
										   $filasAlumnos = $new_filaAlumno;
									}	
								}//fin foreach alumnos
								$new_fila = str_replace($filaAlumno, $filasAlumnos, $new_fila);
								
							}

							if(isset($filasActividad))
								$new_fila = str_replace($filaActividad, $filasActividad, $new_fila);
								
							if(isset($filas))
							   $filas .= $new_fila;
							else
								$filas = $new_fila;

						}//fin foreach cursos

						//echo $new_fila;
						$vista = str_replace($fila, $filas,$vista);

					}
					echo $vista;
						
					}
					else
					{
						echo "error";
					}
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
				{
					//se prepara la vista con los curso disponibles
					//Obtener la vista
					$vista = file_get_contents("Vista/altaAlumnos.html");

					$pos1 = strpos($vista, "<tbody id=\"fila-alumno\">");
					$len1 = strlen("<tbody id=\"fila-alumno\">");
					$url1 = substr($vista, $pos1+$len1);
					$pos2 = strpos($url1, "</tbody id=\"fin\">");
					$url2 = substr($url1, $pos2);
					$fila = str_replace($url2, '', $url1);
					//fila contiene el div de resultado


					//Genero los resultados segun los alumnos
					$alumnos = $this -> modelo -> obtenerAlumnos();
					foreach ($alumnos as $row) 
					{

							$new_fila = $fila;
							$new_fila = str_replace("CODIGO", $row['codigo'], $new_fila);
							$new_fila = str_replace("IDALUMNO", $row['id_alumno'], $new_fila);
							$new_fila = str_replace("NOMBRE", $row['nombre'], $new_fila);
							if(isset($filas))
							   $filas .= $new_fila;
							else
								$filas = $new_fila;
						
					}
					

					//se llena el select con los cursos disponibles
					$pos1 = strpos($vista, "<select id=\"select-cursos\" name=\"curso\">");
					$len1 = strlen("<select id=\"select-cursos\" name=\"curso\">");
					$url1 = substr($vista, $pos1+$len1);
					$pos2 = strpos($url1, "</select id=\"fin\">");
					$url2 = substr($url1, $pos2);
					$filaCurso = str_replace($url2, '', $url1);
					//fila contiene el div de resultado


					//Genero los resultados segun los cursos
					$cursos = $this -> modelo -> obtenerCursos();
					if($cursos==FALSE)
					{
						//No hay cursos creados aun
						$new_filaCurso = str_replace("NOMBRECURSO", "", $filaCurso);
						$vista = str_replace($filaCurso, $new_filaCurso,$vista);
					}
					else
					{
						foreach ($cursos as $row) 
						{

								$new_filaCurso = $filaCurso;
								$new_filaCurso = str_replace("VALORCURSO", $row['id'], $new_filaCurso);
								$new_filaCurso = str_replace("NOMBRECURSO", $row['nombre'], $new_filaCurso);
								if(isset($filasCurso))
								   $filasCurso .= $new_filaCurso;
								else
									$filasCurso = $new_filaCurso;
							
						}
						$vista = str_replace($filaCurso, $filasCurso,$vista);
					}
					
					$vista = str_replace($fila, $filas,$vista);
					
					echo $vista;
					
				}
				else
				{
					//se obtienen las variables si es que hay usuarios seleccionados
					if(isset($_POST["seleccionados"]))
					{
						$codigos = $_POST["seleccionados"];
						$curso = $_POST["curso"];
						$resultado = $this -> modelo -> darAltaAlumnos($codigos,$curso);

						if($resultado!==FALSE)
						{
						//se prepara la vista con los curso disponibles
						//Obtener la vista
						$vista = file_get_contents("Vista/altaAlumnos.html");

						$pos1 = strpos($vista, "<tbody id=\"fila-alumno\">");
						$len1 = strlen("<tbody id=\"fila-alumno\">");
						$url1 = substr($vista, $pos1+$len1);
						$pos2 = strpos($url1, "</tbody id=\"fin\">");
						$url2 = substr($url1, $pos2);
						$fila = str_replace($url2, '', $url1);
						//fila contiene el div de resultado


						//Genero los resultados segun los alumnos
						$alumnos = $this -> modelo -> obtenerAlumnos();
						foreach ($alumnos as $row) 
						{

								$new_fila = $fila;
								$new_fila = str_replace("CODIGO", $row['codigo'], $new_fila);
								$new_fila = str_replace("IDALUMNO", $row['id_alumno'], $new_fila);
								$new_fila = str_replace("NOMBRE", $row['nombre'], $new_fila);
								if(isset($filas))
								   $filas .= $new_fila;
								else
									$filas = $new_fila;
							
						}
						

						//se llena el select con los cursos disponibles
						$pos1 = strpos($vista, "<select id=\"select-cursos\" name=\"curso\">");
						$len1 = strlen("<select id=\"select-cursos\" name=\"curso\">");
						$url1 = substr($vista, $pos1+$len1);
						$pos2 = strpos($url1, "</select id=\"fin\">");
						$url2 = substr($url1, $pos2);
						$filaCurso = str_replace($url2, '', $url1);
						//fila contiene el div de resultado


						//Genero los resultados segun los cursos
						$cursos = $this -> modelo -> obtenerCursos();
						foreach ($cursos as $row) 
						{

								$new_filaCurso = $filaCurso;
								$new_filaCurso = str_replace("VALORCURSO", $row['id'], $new_filaCurso);
								$new_filaCurso = str_replace("NOMBRECURSO", $row['nombre'], $new_filaCurso);
								if(isset($filasCurso))
								   $filasCurso .= $new_filaCurso;
								else
									$filasCurso = $new_filaCurso;
							
						}
						$vista = str_replace($fila, $filas,$vista);
						$vista = str_replace($filaCurso, $filasCurso,$vista);
						echo $vista;
							
						}
						else
						{
							echo "error";
						}
					}
					else
					{
						//Se vuelve a cargar la vista ya que no se selecionaron alumnos
						require_once("Vista/altaAlumnos.html");
					}
					
				}
				break;
				
			case "clonarCurso":
				if(empty($_POST))
					require_once("Vista/clonarCurso.html");
				else
				{
					//se obtienen las variables del formulario
					$cicloBase = $_POST['cicloBase'];
					$idCurso = $_POST['cursoBase'];
					$cicloClonar = $_POST['cicloClonar'];

					//se clona el curso
					$clonar = $this -> modelo -> clonarCurso($cicloBase, $idCurso, $cicloClonar);

					if($resultado!==FALSE)
					{
						//se carga la vista
						require_once("Vista/clonarCurso.html");
					}
					else
					{
						echo "error";
					}

				}
				break;
			case "hojaExtra":
				if(empty($_POST))
					require_once("Vista/configurarCurso.html");
				else
				{
					//obtiene las variables para las hojas extras de evalucion
					$cantidad = $_POST["cantidad"];
					$actividad = $_POST["actividad"];
					$idCurso = $_POST["id-curso"];
					$porcentajes= array();
					$nombres=array();
					//arreglo para guardar los porcentajes
					for ($i=0; $i <$cantidad ; $i++) { 
						array_push($porcentajes,$_POST["porcentaje".$i]);
					}

					for ($i=0; $i <$cantidad ; $i++) { 
						array_push($nombres,$_POST["nombre".$i]);
					}

					$resultado = $this -> modelo -> agregarHojaExtra($actividad,$cantidad,$nombres,$porcentajes,$idCurso);
					
					if($resultado!==FALSE)
					{
						
						header("Location: index.php?ctl=Profesor&act=configurarCurso"); /* Redirect browser */
						
					}
					else
					{
						echo "error";
					}

				}
				break;
			case "mostrarHojaExtra":
					//se obtiene la variable correspondiente ala actividad
					$idActividad=$_GET["idActividad"];
					$resultado = $this -> modelo -> obtenerHojasExtras($idActividad);
					if($resultado!==FALSE)
					{
						
						echo json_encode($resultado);
						
					}
					else
					{
						
					}
				break;
			case "mostrarFormularioCalificacionesActividades":
					//se obtiene la variable correspondiente al curso
					$idCurso=$_GET["idCurso"];
					$actividades = $this -> modelo -> obtenerActividades($idCurso);
					//$hojasExtras = $this -> modelo -> obtenerHojasExtras($idActividad);
					if($actividades!==FALSE)
					{
						
						echo json_encode($actividades);

						
					}
					else
					{
						
					}
				break;
			case "mostrarFormularioCalificacionesHojas":
					//se obtiene la variable correspondiente al curso
					$idCurso=$_GET["idCurso"];
					$hojasExtras = $this -> modelo -> obtenerHojasExtrasXCurso($idCurso);
					if($hojasExtras!==FALSE)
					{
						
						echo json_encode($hojasExtras);

						
					}
					else
					{
						
					}
				break;
			case "mostrarCalificacionesHojas":
					//se obtiene la variable correspondiente al curso
					$codigoAlumno=$_GET["codigoAlumno"];
					$calificacionesHojas = $this -> modelo -> obtenerCalificacionesHojas($codigoAlumno);
					if($calificacionesHojas===FALSE)
					{
						
					}
					else
					{
						
						echo json_encode($calificacionesHojas);
					}
				break;
			case "mostrarCalificacionesActividades":
					//se obtiene la variable correspondiente al curso
					$codigoAlumno=$_GET["codigoAlumno"];
					$idCurso=$_GET["idCurso"];
					//echo "hola";
					$calificacionesActividades = $this -> modelo -> obtenerCalificacionesActividades($codigoAlumno,$idCurso);
					if($calificacionesActividades!==FALSE)
					{
						
						echo json_encode($calificacionesActividades);
						

						
					}
					else
					{
							
					}
				break;

			case "regresarCiclos":
				$ciclos = $this -> modelo -> obtenerCiclos();
				if($ciclos!==FALSE)
					{
						echo json_encode($ciclos);
					}
			break;

			case "regresarCursos":
				$ciclo = $_GET['ciclo'];
				$cursos = $this -> modelo -> obtenerCursoXCiclo($ciclo);
				if($cursos!==FALSE)
					{

						echo json_encode($cursos);
					}
			break;

			case "regresarMenu":
				$menu = file_get_contents("Vista/menuProfesor.html");
				if(isset($_SESSION['nombre']))
					$menu = str_replace("[USUARIO]", $_SESSION['nombre'], $menu);
				else
					$menu = str_replace("[USUARIO]", "Hacker", $menu);

				echo $menu;
			break;


			default:
			 	require_once("Vista/InicioProfesor.html");

			 	break;
				


		}
	}
}
?>