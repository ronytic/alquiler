<?php
include_once("../login/check.php");
if(!empty($_POST)){
include_once("../class/pago.php");
$pago=new pago;
$cod=$_POST['CodPago'];
$tipo=$_POST['Tipo'];
switch($tipo){
case 'Monto':{$values=array("Monto"=>"'".$_POST['Monto']."'");}break;
case 'Observaciones':{$values=array("Observaciones"=>"'".$_POST['Obs']."'");}break;
case 'Fecha':{$values=array("FechaCancelado"=>"'".$_POST['Fecha']."'");}break;
}
$pago->actualizarPago($values,$cod);
}
?>