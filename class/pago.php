<?php
include_once("db2.php");
class pago extends db{
	var $tabla="pago";
	function insertarPago($Values){
		$this->insertRow($Values,1);
	}
	function mostrarTodo($cantidad=0,$where=''){
		$this->campos=array('*');
		$condicion=$where?$where.' and ':'';
		if($cantidad==0)
			return $this->getRecords($condicion."Activo=1","CodArrendatario",0,0,0,1);
		else
			return $this->getRecords($condicion."Activo=1","CodPago",0,$cantidad,0,1);
	}
	function mostrarHistorico($codPagos,$cod){
		$this->campos=array('*');
		return $this->getRecords("CodPago NOT IN($codPagos) and CodArrendatario=$cod and Activo=1","Mes DESC,Anio ",0,5,0,1);
	}
	function actualizarPago($values,$Cod){
		$this->updateRow($values,"CodPago=$Cod");	
	}
}
?>