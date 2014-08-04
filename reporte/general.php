<?php
include_once("../login/check.php");
if(!empty($_POST)){
	include_once("../funciones.php");
	include_once("../class/pago.php");
	include_once("../class/gasto.php");
	include_once("../class/arrendatario.php");
	$gasto=new gasto;
	$pago=new pago;
	$arrendatario=new arrendatario;
	$fechaInicio=$_POST['FechaInicio'];	
	$fechaFin=$_POST['FechaFin'];
	?>
    <a href="reportetotal.php?FechaInicio=<?php echo $fechaInicio?>&FechaFin=<?php echo $fechaFin?>" class="botonSec" target="_blank">Reporte para Imprimir</a>
    <table class="tabla"><?php
	$totalpagos=0;
	$totalgastos=0;
	foreach(rangoFechas($fechaInicio,$fechaFin,"+ 1 month",1) as $rfechas){
		$mespagos=0;
		$mesgastos=0;
		$mes=date("m",strtotime($rfechas));
		$anio=date("Y",strtotime($rfechas));
		$gas=$gasto->mostrarTodo(0,"MONTH(FechaGasto)=$mes and YEAR(FechaGasto)=$anio");
		$pag=$pago->mostrarTodo(0,"MONTH(FechaCancelado)=$mes and YEAR(FechaCancelado)=$anio");
		?><tr><td><span class="resaltar"><?php echo ucfirst(strftime("%B de %Y ",strtotime($rfechas)));?></span></td></tr>
        <tr class="cabecera"><td colspan="4">Pagos</td><td colspan="3">Gastos</td></tr>
        <tr class="cabecera">
        	<td>Fecha de Pago</td><td>Fecha Cancelado</td><td>Nombre Pago</td><td>Monto</td>
        	<td>Fecha de Gasto</td><td>Detalle</td><td>Monto</td>
        </tr>
        
        	<?php foreach($pag as  $p){
				$paci=array_shift($arrendatario->mostrarTodo(0,"CodArrendatario=".$p['CodArrendatario']));
				$pacih=explode(" ",$paci['NombreEsposo']);
				$pacim=explode(" ",$paci['NombreEsposa']);
				$totalpagos+=$p['Monto'];
				$mespagos+=$p['Monto'];
				?>
                <tr>
                <td class="verdebajo"><?php echo $p['FechaPago']?></td>
				<td class="verdebajo"><?php echo $p['FechaCancelado']?></td>
                <td class="verdebajo"><?php echo $pacih[2]?> | <?php echo $pacim[2]?></td>
                <td class="verdebajo der"><?php echo $p['Monto']?> Bs</td>
				</tr>
				<?php	
			}?>
        	
        
        	<?php foreach($gas as  $g){
				$totalgastos+=$g['Monto'];
				$mesgastos+=$g['Monto'];
				?>
                <tr>
                <td colspan="4"></td>
                <td class="rojobajo"><?php echo $g['FechaGasto']?></td>
				<td class="rojobajo"><?php echo $g['Detalle']?></td>
                <td class="rojobajo der"><?php echo $g['Monto']?> Bs</td>
				</tr>
				<?php	
			}?>
        <tr class="pie"><td colspan="3">Total Mes: </td><td class="der"><?php echo $mespagos;?> Bs</td><td colspan="2">Total Gastos:</td><td class="der"><?php echo $mesgastos;?> Bs</td></tr>
	<?php
	}
	?>
    <tr class="cabecera"><td colspan="4">Total Pagos</td><td colspan="2">Total Gastos</td><td>Saldo en Caja</td></tr>
    <tr class="pie"><td colspan="3" class="der"><?php echo $totalpagos?> Bs</td><td colspan="3" class="der"><?php echo $totalgastos?> Bs</td><td class="rojo der"><?php echo $totalpagos-$totalgastos;?> Bs</td></tr>
    </table>
	<?php
}
?>