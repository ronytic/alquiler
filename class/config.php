<?php
include_once("db2.php");
class configuracion extends db{
	var $tabla="config";	
	function mostrarConfig($Nombre){
		$this->campos=array('*');
		return $this->getRecords("Nombre='$Nombre'");	
	}
	function actualizarCuotas($campos,$values){
		$this->campos=$campos;		
		$this->updateRecord("CodConfig=1",$values);
	}
}
?>