<?php

class AdministradorMdl
{
	public $driver;

	function __construct(){
		$this -> driver = new mysqli('localhost','root','','cc409_user204');
		if($this -> driver->connect_errno)
			die("<br>Error en la conexión");
	}

	function agregarCiclo($ciclo,$fechaInicio,$fechaFinalizacion,$fechasMotivos)
	{

		$query = 
				"INSERT INTO ciclos
				(ciclo, fechaInicio, fechaFinalizacion)
				VALUES (
					\"$ciclo\",
					\"$fechaInicio\",
					\"$fechaFinalizacion\"
				)";

		$r = $this -> driver -> query($query);

		if($this -> driver -> insert_id){
			$agregaMotivos=$this -> agregarMotivos($this -> driver -> insert_id,$fechasMotivos);
			return $this -> driver -> insert_id;
		}
		elseif($r === FALSE)
			return FALSE;
	}

	function agregarMotivos($idCiclo,$fechasMotivos)
	{
		foreach ($fechasMotivos as $key => $value) {
			$query = 
				"INSERT INTO diasnoefectivos
				(idCiclo, fecha, Motivo)
				VALUES (
					\"$idCiclo\",
					\"$key\",
					\"$value\"
				)";
			$r = $this -> driver -> query($query);
			if($r === FALSE)
				return FALSE;
		}
		

	}
}
?>