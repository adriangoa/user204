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

		//Primero se busca en la tabla de usuarios
		$query = "SELECT * FROM alumnos WHERE codigo =\"$usuario\" AND password=\"$password\"";
		$r = $this -> driver -> query($query);//regresa un objeto
		if($r->num_rows==0)
			{

				//Luego se busca en la de profesores
				$query2 = "SELECT * FROM profesores WHERE codigo =\"$usuario\" AND password=\"$password\"";
				$r = $this -> driver -> query($query2);
				if($r->num_rows==0)
				{
					//Por ultimo se busca en la de administradores
					$query3 = "SELECT * FROM administradores WHERE codigo =\"$usuario\" AND password=\"$password\"";
					$r = $this -> driver -> query($query3);
				}
			}
		if($r->num_rows==0)
			return FALSE;
		else
		{
			$row = $r -> fetch_assoc();
			return $row;
		}
		
	}
}

?>