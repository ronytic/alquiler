<?php
include_once("../login/check.php");
$folder="../";
$titulo="Registrar Gastos";
include_once("../cabecerahtml.php");
?>
</head>
<body>
<?php include_once("../cabecera.php"); ?>
<div class="container_12" id="cuerpo">
<div class="prefix_2 grid_8 suffix_2">
	<div class="titulo">Registro de Gasto</div>
	<div class="cuerpo">
		<form action="registrar.php" autocomplete="off" method="post">
        <table>
        <tr><td>Detalle del Gasto:</td><td><input type="text" name="detalle" size="50"/></td></tr>
        <tr><td>Monto Gasto:</td><td><input type="number" name="monto" autocomplete="off" min="0" step="1" class="der"/>Bs.</td></tr>
        <tr><td>Fecha de Gasto:</td><td><input type="date" name="fecha" /></td></tr>
 
        <tr><td>Observaciones:</td><td><textarea name="observaciones" rows="5" cols="30"></textarea></td></tr>
        <tr><td></td><td><input type="submit" value="Registrar" class="corner-all"><input type="reset" class="corner-all"></td></tr>
        </table>
        </form>
	</div>
</div>
<div class="clear"></div>
</div>

<?php include_once("../pie.php");?>
