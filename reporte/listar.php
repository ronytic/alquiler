<?php
include_once("../login/check.php");
$folder="../";
$titulo="Listado de Arrendatarios Recibo";
include_once("../cabecerahtml.php");
include_once("../class/arrendatario.php");
$arrendatario=new arrendatario;
?>
</head>
<body>
<?php include_once("../cabecera.php"); ?>
<div class="container_12" id="cuerpo">
<div class="prefix_1 grid_10 suffix_1">
	<div class="titulo">Listado de Arrendatarios - Recibo</div>
	<div class="cuerpo">
    	<table class="tabla">
        <tr class="cabecera"><td>Nombre Esposo</td><td>Nombre Esposa</td><td>Monto</td><td>Fecha de Cancelación</td></tr>
		<?php
        	foreach($arrendatario->mostrarTodo() as $arren){
				?>
				<tr class="contenido"><td><?php echo $arren['NombreEsposo']?></td><td><?php echo $arren['NombreEsposa']?></td><td><?php echo $arren['Monto']?></td><td><?php echo $arren['FechaCancela']?></td><td><a href="pagos.php?CodArrendatario=<?php echo $arren['CodArrendatario']?>" class="botonSec">Ver Recibo</a></td></tr>
				<?php	
			}
		?>
        </table>
	</div>
</div>
<div class="clear"></div>
</div>

<?php include_once("../pie.php");?>
