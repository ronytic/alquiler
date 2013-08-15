<?php
include_once("../login/check.php");
if(!empty($_POST)){
include_once("../class/gasto.php");
$gasto=new gasto;
$cod=$_POST['CodGasto'];
$values=array("Activo"=>0);
$gasto->actualizarGasto($values,$cod);
}
?>