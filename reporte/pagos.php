<?php
include_once("../login/check.php");
if(!empty($_GET)){
$folder="../";
$cod=$_GET['CodArrendatario'];
$titulo="Pagar Arrendatario";
include_once("../cabecerahtml.php");
include_once("../class/arrendatario.php");
include_once("../class/pago.php");
include_once("../funciones.php");
$arrendatario=new arrendatario;
$pago=new pago;
$arren=array_shift($arrendatario->mostrarTodo(1,"CodArrendatario=$cod"));
$fechaCancela=$arren['FechaCancela'];
$fechaHoy=date("Y-m-d");
?>
</head>
<body>
<?php include_once("../cabecera.php"); ?>
<div class="container_12" id="cuerpo">
<div class="prefix_2 grid_8 suffix_2">
	<div class="titulo">Listado de Arrendatarios</div>
	<div class="cuerpo">
    	<table class="tabla">
        <tr class="cabecera"><td>Nombre Esposo</td><td>Nombre Esposa</td><td>Monto</td><td>Fecha de Cancelación</td></tr>
				<tr class="contenido"><td><?php echo $arren['NombreEsposo']?></td><td><?php echo $arren['NombreEsposa']?></td><td><?php echo $arren['Monto']?></td><td><?php echo $arren['FechaCancela']?></td></tr>
        </table>
        <form action="recibo.php" method="post"><input type="hidden" name="CodArrendatario" value="<?php echo $cod;?>"/>
        <table class="tabla">
        	<tr class="cabecera"><td>Nº</td><td>Fecha de Cancelación</td><td>Estado</td><td>Monto</td><td>Observaciones</td><td>Pagos en Recibo</td></tr>
            <?php
				$i=0;
				$total=0;
				$totalTodo=0;
				foreach(rangoFechas($fechaCancela,$fechaHoy) as $fecha){$i++;
				$fechaMes=date("m",strtotime($fecha));
				$fechaAnio=date("Y",strtotime($fecha));
				$pagomes=$pago->mostrarTodo(0,"Mes=$fechaMes and Anio=$fechaAnio and CodArrendatario=$cod");
				$pagmes=array_shift($pago->mostrarTodo(0,"Mes=$fechaMes and Anio=$fechaAnio and CodArrendatario=$cod"));
				$totalTodo+=$arren['Monto'];
				//if(count($pagomes)<1){$total+=$arren['Monto'];}
				$total+=$pagmes['Monto'];
					?>
                    <tr class="contenido">
                    	<td><?php echo $i;?></td>
                        <td><?php echo $fecha;?></td>
                        <td><?php echo count($pagomes)>=1?'Cancelado':'Pendiente';?></td>
                        <td><?php if(count($pagomes)>=1){echo $pagmes['Monto'];}?></td>
                        <td><?php if(count($pagomes)>=1){echo $pagmes['Observaciones'];}?></td>
                        <td><?php if(count($pagomes)>=1){?>
                        	<input type="checkbox" name="CodPago[]" value="<?php echo $pagmes['CodPago'];?>"/>
<?php }?></td>
                    </tr>
                    <?php
				}
				
			?>
            
            <tr class="pie"><td></td><td></td><td class="der">Pendiente:<?php echo $totalTodo-$total?></td><td><input type="hidden" name="pendiente" value="<?php echo $totalTodo-$total;?>"/></td><td></td></tr>
            <tr><td></td><td><input type="hidden" name="proximoMes" value="<?php echo $fecha;?>"> </td><td><input type="submit" value="Ver Recibo" class="corner-all"></td></tr>
        </table>
        </form>
	</div>
</div>
<div class="clear"></div>
</div>

<?php include_once("../pie.php");?>
<?php
}

?>
