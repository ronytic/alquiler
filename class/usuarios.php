<?php
include_once("db2.php");
class usuarios extends db{
	var $tabla="usuarios";
	function mostrarDatos($CodUsuario){
		$this->campos=array("*");
		return $this->getRecords("CodUsuario=$CodUsuario");
	}
	function loginUsuarios($Usuario,$Password){
		$this->campos=array("count(*) as Can,CodUsuario,Nivel");	
		return $this->getRecords("Usuario='$Usuario' and Pass=MD5('$Password') and Activo=1");
	}
	function insertarUsuarios($Values){
		$this->insertRow($Values,1);
	}
	function mostrarTodo($cantidad=0,$where=''){
		$this->campos=array('*');
		$condicion=$where?$where.' and ':'';
		if($cantidad==0)
			return $this->getRecords($condicion."Activo=1","CodUsuario",0,0,0,0);
		else
			return $this->getRecords($condicion."Activo=1","CodUsuario",0,$cantidad,0,0);
	}
	function actualizarUsuarios($values,$CodUsuario){
		$this->updateRow($values,"CodUsuario=$CodUsuario");	
	}
}
?>