<?php

class LoginMdl
{
	public $driver;
	function __construct(){
		$this -> driver = new mysqli('localhost','root','','cc409_user204');
		if($this -> driver->connect_errno)
			die("<br>Error en la conexión");
	}

	function ingresar($usuario, $password)
	{
		$query = "SELECT * FROM usuarios WHERE usuario =\"$usuario\" AND password=\"$password\"";
		$r = $this -> driver -> query($query);
		if($r === FALSE)
			return FALSE;
		else
		{
			$row = $r -> fetch_assoc();
			return $row;
		}
	}
}

?>