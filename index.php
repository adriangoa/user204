<?php
if(isset($_GET["ctl"]))
{
	switch($_GET["ctl"]){
		
	case "Administrador":
		require_once("Controlador/AdministradorCtl.php");
		$ctl = new AdministradorCtl();
		break;
	case "Profesor":
		require_once("Controlador/ProfesorCtl.php");
		$ctl = new ProfesorCtl();
		break;
	case "Alumno":
		require_once("Controlador/AlumnoCtl.php");
		$ctl = new AlumnoCtl();
		break;
	default:
		//se carga la vista del login por default
		require_once("Controlador/loginCtl.php");
		$ctl = new LoginCtl();
		break;
	}
	

}
else
{
	//Carga el login
	require_once("Controlador/loginCtl.php");
	$ctl = new LoginCtl();
}
$ctl -> ejecutar();


 

