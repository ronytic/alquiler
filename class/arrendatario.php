<?php
include_once("db2.php");
class arrendatario extends db{
	var $tabla="arrendatario";
	function insertarArrendatario($Values){
		$this->insertRow($Values,1);
	}
	function mostrarTodo($cantidad=0,$where=''){
		$this->campos=array('*');
		$condicion=$where?$where.' and ':'';
		if($cantidad==0)
			return $this->getRecords($condicion."Activo=1","CodArrendatario",0,0,0,1);
		else
			return $this->getRecords($condicion."Activo=1","CodArrendatario",0,$cantidad,0,1);
	}
	function actualizarArrendatario($values,$Cod){
		$this->updateRow($values,"CodArrendatario=$Cod");	
	}
}
?>