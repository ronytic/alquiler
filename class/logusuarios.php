<?php
include_once("db2.php");
class logusuarios extends db{
	var $tabla="logusuarios";
	function estadoTabla(){
		return $this->statusTable();
	}
	function insertarRegistro($Values){
		$this->insertRow($Values,1);
	}
	function mostrarUsoDocente($CodDocente){
		$this->campos=array('*');
		return $this->getRecords(" CodUsuario=$CodDocente and Nivel=3","FechaLog",0,0,0,1);
	}
}
?>