<?php
include_once("../login/check.php");
if(!empty($_GET)){
	include_once("pdf.php");
	include_once("../funciones.php");
	include_once("../class/pago.php");
	include_once("../class/gasto.php");
	include_once("../class/arrendatario.php");
	$gasto=new gasto;
	$pago=new pago;
	$arrendatario=new arrendatario;
	$fechaInicio=$_GET['FechaInicio'];	
	$fechaFin=$_GET['FechaFin'];
	class PDF extends PPDF{
		function Cabecera(){
				
		}	
	}
	$titulo="Reporte General";
	$pdf=new PDF("P","mm","letter");//$pdf=new FPDF("L","mm",array(306,396));
	$borde=0;

	$pdf->AddPage();
	
	$totalpagos=0;
	$totalgastos=0;
	foreach(rangoFechas($fechaInicio,$fechaFin,"+ 1 month",1) as $rfechas){
		$mespagos=0;
		$mesgastos=0;
		$mes=date("m",strtotime($rfechas));
		$anio=date("Y",strtotime($rfechas));
		$gas=$gasto->mostrarTodo(0,"MONTH(FechaGasto)=$mes and YEAR(FechaGasto)=$anio");
		//print_r($gas);
		$pag=$pago->mostrarTodo(0,"MONTH(FechaCancelado)=$mes and YEAR(FechaCancelado)=$anio");
		$pdf->Fuente("",9);
		
		$pdf->Ln();
		$pdf->linea();
		$pdf->Ln();
		
		$pdf->Fuente("",9);
		$pdf->CuadroCuerpoPersonalizado(35,"Pagos - ".ucfirst(strftime("%B %Y ",strtotime($rfechas))),1,"L",1,"",8);
		$pdf->CuadroCuerpoPersonalizado(27,"Fecha de Pago",1,"C",1,"",8);
		$pdf->CuadroCuerpoPersonalizado(30,"Fecha Cancelado",1,"C",1,"",8);
		$pdf->CuadroCuerpoPersonalizado(60,"Nombre de Arrendatarios",1,"C",1,"",8);
		$pdf->CuadroCuerpoPersonalizado(30,"Monto",1,"C",1,"",8);
		$pdf->Ln();
		$p;
		
		foreach($pag as  $p){
			$paci=array_shift($arrendatario->mostrarTodo(0,"CodArrendatario=".$p['CodArrendatario']));
			$pacih=explode(" ",$paci['NombreEsposo']);
			$pacim=explode(" ",$paci['NombreEsposa']);
			$totalpagos+=$p['Monto'];
			$mespagos+=$p['Monto'];
			$pdf->CuadroCuerpo(35,"",0,"C","");
			$pdf->CuadroCuerpo(27,fecha2Str($p['FechaPago']),0,"C","RL");
			$pdf->CuadroCuerpo(30,fecha2Str($p['FechaCancelado']),0,"C","R");
			$pdf->CuadroCuerpo(60,$pacih[0]." ".$pacih[2]." | ".$pacim[0]." ".$pacim[2],0,"L","R");
			$pdf->CuadroCuerpo(30,$p['Monto']." Bs",0,"R","R");
			$pdf->Ln();	
		}
		if($mespagos!=0){
			$pdf->CuadroCuerpo(92,"",0,"C","R");
			$pdf->CuadroCuerpo(60,"Total Pagos de Mes"."",1,"R",1);
			$pdf->CuadroCuerpo(30,$mespagos." Bs",1,"R",1);
			$pdf->Ln();	
		}
		$pdf->CuadroCuerpoPersonalizado(35,"Gastos - ".ucfirst(strftime("%B %Y ",strtotime($rfechas))),0,"L",1,"",8);
		$pdf->CuadroCuerpoPersonalizado(27,"Fecha de Gasto",1,"C",1,"",8);
		$pdf->CuadroCuerpoPersonalizado(90,"Detalle",1,"C",1,"",8);
		$pdf->CuadroCuerpoPersonalizado(30,"Monto",1,"C",1,"",8);
		$pdf->Ln();	
		foreach($gas as  $g){
			$totalgastos+=$g['Monto'];
			$mesgastos+=$g['Monto'];
			$pdf->CuadroCuerpo(35,"",0,"C","");
			$pdf->CuadroCuerpo(27,fecha2Str($g['FechaGasto']),0,"C","RL");
			$pdf->CuadroCuerpo(90,($g['Detalle']),0,"C","RL");
			$pdf->CuadroCuerpo(30,($g['Monto']." Bs"),0,"R","RL");
			
			$pdf->Ln();	
		}
		if($mesgastos!=0){
			$pdf->CuadroCuerpo(92,"",0,"C","R");
			$pdf->CuadroCuerpo(60,"Total Gastos de Mes"."",1,"R",1);
			$pdf->CuadroCuerpo(30,$mesgastos." Bs",1,"R",1);
			$pdf->Ln();
		}
	}
	$pdf->Ln();
	
	$pdf->CuadroCuerpo(60,"Total Pagos"."",1,"R",1,9,"B");
	$pdf->CuadroCuerpo(60,"Total Gastos"."",1,"R",1,9,"B");
	$pdf->CuadroCuerpo(60,"Saldo en Caja"."",1,"R",1,9,"B");
	
	$pdf->Ln();

	$pdf->CuadroCuerpo(60,$totalpagos." Bs",1,"R",1,10);
	$pdf->CuadroCuerpo(60,$totalgastos." Bs",1,"R",1);
	$pdf->CuadroCuerpo(60,$totalpagos-$totalgastos." Bs",1,"R",1);
	$pdf->Ln();
	$pdf->Output("Reporte.pdf","I");
}
?>