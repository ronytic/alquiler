<?php
include_once("../login/check.php");
if(!empty($_POST)){
	include_once("../class/pago.php");
	include_once("../class/arrendatario.php");
	include_once("fpdf/fpdf.php");
	include_once("funciones.php");
	$cod=$_POST['CodArrendatario'];
	$codpago=$_POST['CodPago'];
	$proximoMes=$_POST['proximoMes'];
	$montoPendiente=$_POST['pendiente'];
	$arrendatario=new arrendatario;
	$pago=new pago;
	$valorConcepto=array();
	$valorImporte=array();
	$arren=array_shift($arrendatario->mostrarTodo(1,"CodArrendatario=$cod"));
	$pagoTotal=0;
	$i=0;
	foreach($codpago as $cpago){$i++;
		$p=array_shift($pago->mostrarTodo(0,"CodPago=".$cpago));
		if($p['Monto']==$arren['Monto']){
			array_push($valorConcepto,"Alquiler mes de ".mb_strtoupper(strftime("%B",strtotime($p['FechaPago'])))." de ".$p['Anio']." | Cancelado: ".date("d/m/Y",strtotime($p['FechaCancelado'])));
			array_push($valorImporte,$p['Monto']." Bs.");
			$pagoTotal+=$p['Monto'];
		}else{
			if($p['Monto']<$arren['Monto']){
				array_push($valorConcepto,"Adelanto alquiler mes de ".mb_strtoupper(strftime("%B",strtotime($p['FechaPago'])))." de ".$p['Anio']." | Cancelado: ".date("d/m/Y",strtotime($p['FechaCancelado'])));
				array_push($valorImporte,$p['Monto']." Bs.");
				$pagoTotal+=$p['Monto'];
			}
		}
	}
	for($j=$i+1;$j<=5;$j++){
		array_push($valorConcepto,"......");
		array_push($valorImporte,"...");	
	}
	$valorHistoricoMes=array();
	$valorHistoricoBs=array();
	$valorHistoricoFecha=array();
	$i=0;
	foreach($pago->mostrarHistorico(implode(",",$codpago),$cod) as $ph){$i++;
		array_push($valorHistoricoMes,mb_strtoupper(strftime("%B",strtotime($ph['FechaPago']))));
		array_push($valorHistoricoBs,$ph['Monto']." Bs.");
		array_push($valorHistoricoFecha,date("d/m/Y",strtotime($ph['FechaCancelado'])));
	}
	for($j=$i+1;$j<=5;$j++){
		array_push($valorHistoricoMes,"...");
		array_push($valorHistoricoBs,"...");
		array_push($valorHistoricoFecha,"...");	
	}
	class PDF extends FPDF{
	function Footer(){
		$this->SetY(-15);
		$this->SetFont('Arial','I',8);
		$this->Cell(376,0,"",1,1);
		$anio=date("Y");
		$this->Cell(376,4,utf8_decode("Sistema de Control de Alquiler ".$anio. " © Todos los derechos reservados | Desarrollado por Ronald Nina Layme "),0,1,"C");
		
	}
	}
	$pdf=new PDF("L","mm",array(220,396));//$pdf=new FPDF("L","mm",array(306,396));
	$borde=0;
	$pdf->SetAutoPageBreak(true,15);
	$pdf->AddPage();
	$pdf->SetFont("Arial","BU",29);
	$pdf->SetFillColor(234,234,234);
	$pdf->Cell(376,10,"RECIBO DE ALQUILER",$borde,0,"C");
	$pdf->ln(25);
	$pdf->SetFont("Arial","B",12);
	$pdf->Cell(100,10,"Nombre",1,0,"C");
	$pdf->Cell(30,10,"C.I.:",1,0,"C");
	$pdf->Cell(30,10,"",$borde,0,"C");
	$pdf->Cell(45,10,utf8_decode("Fecha de Emisión"),1,0,"C");
	$pdf->Cell(30,10,"",$borde,0,"C");
	$pdf->Cell(50,10,"Codigo de Control",1,0,"C");
	$pdf->Cell(30,10,"",$borde,0,"C");
	$pdf->Cell(50,10,utf8_decode("Fecha Próximo Pago"),1,0,"C");
	$pdf->ln(10);
	$pdf->SetFont("Arial","",12);
	$pdf->Cell(100,10,mb_strtoupper($arren['NombreEsposo']),"LR",0,"L");
	$pdf->Cell(30,10,mb_strtoupper($arren['CiEsposo']),"LR",0,"C");
	$pdf->Cell(30,10,"",$borde,0,"C");
	$pdf->Cell(45,10,date("d/m/Y H:i:s"),1,0,"C");
	$pdf->Cell(30,10,"",$borde,0,"C");
	$pdf->Cell(50,10,strtoupper(RandomString(12,FALSE)),1,0,"C");
	$pdf->Cell(30,10,"",$borde,0,"C");
	$pdf->Cell(50,10,date("d/m/Y",strtotime($proximoMes)),1,0,"C");
	$pdf->ln(10);
	$pdf->Cell(100,10,mb_strtoupper($arren['NombreEsposa']),"LRB",0,"L");
	$pdf->Cell(30,10,mb_strtoupper($arren['CiEsposa']),"LRB",0,"C");
	$pdf->ln(25);
	//$pdf->SetXY(10,25);
	$pdf->SetFont("Arial","B",12);
	$pdf->Cell(200,10,"CONCEPTO",1,0,"C");
	$pdf->Cell(50,10,"IMPORTE",1,0,"C");
	$pdf->Ln(10);
	$pdf->SetFont("Arial","",12);
	$pdf->MultiCell(200,10,implode("\n",$valorConcepto),1,"L",0);
	$pdf->SetXY(210,90);
	$pdf->MultiCell(50,10,implode("\n",$valorImporte),1,"C",0);
	$pdf->Cell(200,10,"TOTAL",$borde,0,"C");
	$pdf->Cell(50,10,$pagoTotal." Bs.",$borde,0,"C");
	$pdf->Ln(10);
	$pdf->Cell(20,10,"SON:",1,0,"C");
	$pdf->Cell(200,10,num2letras($pagoTotal,0,0),1,0,"C");
	$pdf->Cell(30,10," Bolivianos",1,0,"C");
	
	//$pdf->Rect(10,60,200,10);
	$pdf->SetXY(280,80);
	$pdf->SetFont("Arial","B",12);
	$pdf->Cell(100,10,"PAGO HISTORICO",1,10,"C");
	$pdf->SetFont("Arial","",12);
	$pdf->MultiCell(35,10,implode("\n",array_reverse($valorHistoricoMes)),1,"L",0);
	$pdf->SetXY(315,90);
	$pdf->MultiCell(35,10,implode("\n",array_reverse($valorHistoricoFecha)),1,"C",0);
	$pdf->SetXY(350,90);
	$pdf->MultiCell(30,10,implode("\n",array_reverse($valorHistoricoBs)),1,"R",0);
	$pdf->Ln(10);
	$pdf->SetXY(280,150);
	$pdf->SetFont("Arial","B",12);
	$pdf->Cell(50,10,"MONTO PENDIENTE",1,0,"C");
	$pdf->Cell(50,10,$montoPendiente." Bs.",1,10,"C");
	$pdf->SetFont('Arial','I',8);
	$pdf->Cell(30,5,"Incluye deuda pendiente + mes a pagar");
	$pdf->Output();
}

function RandomString($length=10,$uc=TRUE,$n=TRUE,$sc=FALSE)
{
	$source = 'abcdefghijklmnopqrstuvwxyz';
	if($uc==1) $source .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	if($n==1) $source .= '1234567890';
	if($sc==1) $source .= '|@#~$%()=^*+[]{}-_';
	if($length>0){
		$rstr = "";
		$source = str_split($source,1);
		for($i=1; $i<=$length; $i++){
			mt_srand((double)microtime() * 1000000);
			$num = mt_rand(1,count($source));
			$rstr .= $source[$num-1];
		}

	}
	return $rstr;
}

?>