<?php
include_once("../login/check.php");
if(!empty($_POST)){
	include_once("../class/gasto.php");
	extract($_POST);
	$gasto=new gasto;

	$values=array(
				"Detalle"=>"'$detalle'",
				"Monto"=>"'$monto'",
				"FechaGasto"=>"'$fecha'",
				"Observaciones"=>"'$observaciones'",
				);
	$gasto->actualizarGasto($values,$CodGasto);
	header("Location:../index.php");
}
?>