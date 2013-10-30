<?php
//me conecto a la base de datos
$mysql = new mysqli('localhost','root','','cc409_user204');


//ago un queri papachoso
$idActividad= $_GET["idActividad"];
$consulta ="SELECT * FROM hojasextras WHERE id_actividad=$idActividad";
$resultado = $mysql->query($consulta);

//se procesa el resultado
while($row =$resultado->fetch_assoc())
	$alumnos[]=$row;

//muestro el resultado
 echo json_encode($alumnos);
$mysql->close();
?>