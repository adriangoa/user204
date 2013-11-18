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
				{
					//Aui se carga la vista con los cursos disponibles

					//Obtener la vista
					$vista = file_get_contents("Vista/calificaciones.html");

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

					//Obtengo todas las calificaciones 
					$calificaciones_actividades= $this -> modelo -> obtenerCalificaciones();
					

					if($cursos==FALSE)
					{
						$new_fila = str_replace("Mostrar Actividades", "No existen cursos disponibles", $fila);
						$vista = str_replace($fila, $new_fila,$vista);
					}

					else
					{
						foreach ($cursos as $curso) {

							if(isset($filasActividad))
								unset($filasActividad);
							//Genero los resultados agregando tambien las actividades
							$actividades = $this -> modelo -> obtenerActividades($curso['id']);

							$new_fila = $fila;
							$new_fila = str_replace("numero", $curso['id'], $new_fila);
							$new_fila = str_replace("mostrar_ocultar", "mostrar_ocultar".$curso['id'], $new_fila);
							$new_fila = str_replace("contenido", "contenido".$curso['id'], $new_fila);
							$new_fila = str_replace("idCurso", $curso['id'], $new_fila);
							$new_fila = str_replace("Ciclo", $curso['ciclo'], $new_fila);
							$new_fila = str_replace("NombreCurso", $curso['nombre'], $new_fila);
							$new_fila = str_replace("Academia", $curso['academia'], $new_fila);
							$new_fila = str_replace("NRC", "NRC: ".$curso['nrc'], $new_fila);
							$new_fila = str_replace("actividad", "actividad".$curso['id'], $new_fila);//este hace referencia al id del input							
							$new_fila = str_replace("porcentaje", "porcentaje".$curso['id'], $new_fila);
							$new_fila = str_replace("boton-agregar", $curso['id'], $new_fila);//para saber que validar

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

								$titulos_columnas=false;
								$existen_actividades=false;

								foreach ($actividades as $raw) {
									if($raw["idCurso"]==$curso["id"])										
									{		                               
										$existen_actividades=true;

										if($titulos_columnas==false)
										{
											$new_filaActividad = $filaActividad;
											$new_filaActividad = str_replace("Actividad","Actividad", $new_filaActividad);											
											$new_filaActividad = str_replace("Porcentaje", "Porcentaje %", $new_filaActividad);
											$new_filaActividad = str_replace("Calificacion","Calificacion pts",$new_filaActividad);
											$new_filaActividad = str_replace("<button class=\"btn btn-info btn-mini mostrarHoja\"  id=\"idAct\" type=\"submit\">Mostrar hoja evaluacion</button>","Hojas extra",$new_filaActividad);

											
											$filasActividad = $new_filaActividad;
											$titulos_columnas=true;
										}

										$new_filaActividad = $filaActividad;
										$new_filaActividad = str_replace("idCURSO", $curso['id'], $new_filaActividad);
										$new_filaActividad = str_replace("Actividad", $raw['actividad'], $new_filaActividad);
										$new_filaActividad = str_replace("idAct", $raw['id'], $new_filaActividad);
										$new_filaActividad = str_replace("Porcentaje", $raw['porcentaje']."%", $new_filaActividad);

										foreach ($calificaciones_actividades as $calificacion) {
											if($calificacion['id_curso']==$curso['id'] and 
											$calificacion['id_actividad']==$raw['id'])
											{
												$new_filaActividad = str_replace("Calificacion",$calificacion['calificacion']." pts",$new_filaActividad);
												break;
											}
											else{
												$new_filaActividad = str_replace("Calificacion","N\A",$new_filaActividad);												
											}
										}

										if(isset($filasActividad))
										   $filasActividad .= $new_filaActividad;
										else
										   $filasActividad = $new_filaActividad;
									}	
								}//fin foreach actividades


								if(!$existen_actividades)
								{
									
								}
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

					//Se imprime la vista
					echo $vista;
				}
				break;
           
			case "asistencias":
				if(empty($_POST))
				{
					//se prepara la vista con los curso disponibles
					//Obtener la vista
					$vista = file_get_contents("Vista/asistencias.html");

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
											$new_filaAlumno = str_replace("[checkboxFecha]", "<input type='checkbox' disabled=\"true\" name='fechas[]' value='".$raw['id_alumno']."*".$row['id']."*".$arrayFechas[0]."'>", $new_filaAlumno);
											for ($i=1; $i < count($arrayFechas); $i++) { 
												$new_filaAlumno .= "<td><input type='checkbox' name='fechas[]' disabled=\"true\" value='".$raw['id_alumno']."*".$row['id']."*".$arrayFechas[$i]."'></td>";
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
														$new_filaAlumno = str_replace("[checkboxFecha]", "<input type='checkbox' checked='true' disabled=\"true\" name='fechas[]' value='".$raw['id_alumno']."*".$row['id']."*".$asistencia['fecha']."'>", $new_filaAlumno);
														$primerFecha=false;
													}
													else
														$new_filaAlumno .= "<td><input type='checkbox' checked='true' disabled=\"true\" name='fechas[]' value='".$raw['id_alumno']."*".$row['id']."*".$asistencia['fecha']."'></td>";
												}
												else
												{
													if($primerFecha)
													{
														$new_filaAlumno = str_replace("[checkboxFecha]", "<input type='checkbox' disabled=\"true\"  name='fechas[]' value='".$raw['id_alumno']."*".$row['id']."*".$asistencia['fecha']."'>", $new_filaAlumno);
														$primerFecha=false;
													}
													else
														$new_filaAlumno .= "<td><input type='checkbox' disabled=\"true\" name='fechas[]' value='".$raw['id_alumno']."*".$row['id']."*".$asistencia['fecha']."'></td>";
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
				break;

			default:
			 	require_once("Vista/InicioAlumno.html");
			 	break;
		}
	}
}
?>