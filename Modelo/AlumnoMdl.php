<?php

class AlumnoMdl
{
	public $driver;

	function __construct(){
		$this -> driver = new mysqli('localhost','root','','cc409_user204');
		if($this -> driver->connect_errno)
			die("<br>Error en la conexión");
	}

	function agregarCiclo()
	{
		
	}
}

?>