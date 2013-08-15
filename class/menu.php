<?php
include_once("db2.php");
class menu extends db{
	var $tabla="menu";
	function mostrar($Nivel){
		$this->campos=array('CodMenu','Nombre','Url','SubMenu','Imagen');
		switch($Nivel){
			case "1":{return $this->getRecords(" Admin=1 and Activo=1","Orden");}break;
			case "2":{return $this->getRecords(" Presidente=1 and Activo=1","Orden");}break;
			case "3":{return $this->getRecords(" Coordinador=1 and Activo=1","Orden");}break;
			case "4":{return $this->getRecords(" Medico=1 and Activo=1","Orden");}break;
			case "5":{return $this->getRecords(" PresidenteClub=1 and Activo=1","Orden");}break;
			case "6":{return $this->getRecords(" Comite=1 and Activo=1","Orden");}break;
			case "7":{return $this->getRecords(" Jugador=1 and Activo=1","Orden");}break;
			case "8":{return $this->getRecords(" Encargado=1 and Activo=1","Orden");}break;
		}

	}
	
	
}
?>