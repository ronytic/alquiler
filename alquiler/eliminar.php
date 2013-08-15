<?php
include_once("../login/check.php");
if(!empty($_POST)){
include_once("../class/pago.php");
$pago=new pago;
$cod=$_POST['CodPago'];
$values=array("Activo"=>0);
$pago->actualizarPago($values,$cod);
}
?>