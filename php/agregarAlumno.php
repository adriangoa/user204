<?php

	$codigo=$_POST["codigo"];
	$nombre=$_POST["nombre"];
	$apellidos=$_POST["apellidos"];
	$carrera=$_POST["carrera"];
	$correo=$_POST["correo"];

	//Creando conexion
	$conexion = new mysqli("localhost","root","","califix");

	if($conexion->connect_error)
	{
		die('La conexion ha fallado');
	}
	
?>

