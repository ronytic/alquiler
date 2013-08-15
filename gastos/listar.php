<?php
include_once("../login/check.php");
$folder="../";
$titulo="Registrar Gastos";
include_once("../cabecerahtml.php");
include_once("../class/gasto.php");
$gasto=new gasto;
?>
<script language="javascript" type="text/javascript" src="../js/gasto.js"></script>
</head>
<body>
<?php include_once("../cabecera.php"); ?>
<div class="container_12" id="cuerpo">
<div class="prefix_2 grid_8 suffix_2">
	<div class="titulo">Lista de Gastos</div>
	<div class="cuerpo">
		<table class="tabla">
        	<tr class="cabecera"><td>Detalle</td><td>Monto</td><td>Fecha</td><td>Observaciones</td></tr>
            <?php
            foreach($gasto->mostrarTodo() as $ga){
			?>
            <tr class="contenido"><td><?php echo $ga['Detalle']?></td><td><?php echo $ga['Monto']?></td><td><?php echo $ga['FechaGasto']?></td><td><?php echo $ga['Observaciones']?></td><td><a href="modificar.php?CodGasto=<?php echo $ga['CodGasto']?>" class="botonSec modificar" rel="">Modificar</a><a href="#" class="botonSec eliminar" rel="<?php echo $ga['CodGasto']?>">Eliminar</a></td></tr>
            <?php	
			}
			?>
        </table>
	</div>
</div>
<div class="clear"></div>
</div>

<?php include_once("../pie.php");?>
