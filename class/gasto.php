<?php
include_once("db2.php");
class gasto extends db{
	var $tabla="gasto";
	function insertarGasto($Values){
		$this->insertRow($Values,1);
	}
	function mostrarTodo($cantidad=0,$where=''){
		$this->campos=array('*');
		$condicion=$where?$where.' and ':'';
		if($cantidad==0)
			return $this->getRecords($condicion."Activo=1","FechaGasto",0,0,0);
		else
			return $this->getRecords($condicion."Activo=1","CodGasto",0,$cantidad,0);
	}
	function actualizarGasto($values,$Cod){
		$this->updateRow($values,"CodGasto=$Cod");	
	}
}
?>