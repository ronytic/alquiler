<?php
include_once("../login/check.php");
if(!empty($_POST)){
include_once("../class/arrendatario.php");
$arrendatario=new arrendatario;
$cod=$_POST['CodArrendatario'];
$values=array("Activo"=>0);
$arrendatario->actualizarArrendatario($values,$cod);
}
?>