<?php
function rangoFechas($fechauno,$fechados,$rango="+ 1 month",$adelantar=1){
	$fechas=array();
	$fechaaamostrar = $fechauno;
	if($adelantar==1){
	$fechaaamostrar = date("Y-m-d", strtotime($fechaaamostrar . $rango));}
	while(strtotime($fechados) >= strtotime($fechauno))
	{
		if(strtotime($fechados) >= strtotime($fechaaamostrar))
		{
			array_push($fechas,$fechaaamostrar);
			$fechaaamostrar = date("Y-m-d", strtotime($fechaaamostrar . $rango));
		}else{
			array_push($fechas,$fechaaamostrar);
			break;
		}	
	}
	return $fechas;
}
?>