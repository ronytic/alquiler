<?php
include_once("db2.php");

class submenu extends db{
	var $tabla="submenu";

	function mostrar($Nivel,$Menu){
		
		$this->campos=array('Nombre','Url','Imagen');
		switch($Nivel){
			case "1":{return $this->getRecords(" Admin=1 and CodMenu=$Menu and Activo=1","Orden");}break;
			case "2":{return $this->getRecords(" Presidente=1 and CodMenu=$Menu and Activo=1","Orden");}break;
			case "3":{return $this->getRecords(" Coordinador=1 and CodMenu=$Menu and Activo=1","Orden");}break;
			case "4":{return $this->getRecords(" Medico=1 and CodMenu=$Menu and Activo=1","Orden");}break;
			case "5":{return $this->getRecords(" PresidenteClub=1 and CodMenu=$Menu and Activo=1","Orden");}break;
			case "6":{return $this->getRecords(" Comite=1 and CodMenu=$Menu and Activo=1","Orden");}break;
			case "7":{return $this->getRecords(" Jugador=1 and CodMenu=$Menu and Activo=1","Orden");}break;
			case "8":{return $this->getRecords(" Encargado=1 and CodMenu=$Menu and Activo=1","Orden");}break;
		}

	}
	
	
}
?>