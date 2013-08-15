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
<script language="javascript" type="text/javascript" src="../js/script.js"></script>
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
        <table class="tabla">
        	<tr class="cabecera"><td>Nº</td><td>Fecha de Cancelación</td><td>Fecha de Cancelado</td><td>Estado</td><td>Monto</td><td>Observaciones</td></tr>
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
				//if(count($pagomes)<1){$total+=$arren['Monto'];
				$total+=$pagmes['Monto'];
					?>
                    <tr class="contenido">
                    	<td><?php echo $i;?></td>
                        <td><?php echo $fecha;?></td>
                        <td><?php if(count($pagomes)>=1){?><input type="text" value="<?php echo $pagmes['FechaCancelado']?>" size="10" class="der fechas" rel="<?php echo $pagmes['CodPago']?>"/><?php }?></td>
                        <td><?php echo count($pagomes)>=1?'Cancelado':'Pendiente';?></td>
                        <td><?php if(count($pagomes)>=1){?><input type="text" value="<?php echo $pagmes['Monto']?>" size="4" class="der monto" rel="<?php echo $pagmes['CodPago']?>"/><?php }?></td>
                        <td><?php if(count($pagomes)>=1){?><input type="text" value="<?php echo $pagmes['Observaciones']?>" size="15" class="der observaciones" rel="<?php echo $pagmes['CodPago']?>"/><?php }?></td>
                        <td><?php if(count($pagomes)<1){?><a href="#" class="botonSec cancelar" data-mes="<?php echo $fechaMes?>" data-anio="<?php echo $fechaAnio?>" data-monto="<?php echo $arren['Monto']?>" data-fecha="<?php echo $fecha?>" rel="<?php echo $cod;?>">Cancelar</a><?php }else{?><a href="#" class="botonSec eliminar" rel="<?php echo $pagmes['CodPago']?>">Eliminar</a><?php }?></td>
                    </tr>
                    <?php
				}
			?>
            <tr class="pie"><td></td><td></td><td class="der">Pendiente:<?php echo $totalTodo-$total?></td><td></td><td></td></tr>
        </table>
	</div>
</div>
<div class="clear"></div>
</div>

<?php include_once("../pie.php");?>
<?php
}

?>
