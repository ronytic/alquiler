<?php
include_once("../login/check.php");
$folder="../";
$titulo="Registrar Nuevo Arrendatario";
include_once("../cabecerahtml.php");
?>
</head>
<body>
<?php include_once("../cabecera.php"); ?>
<div class="container_12" id="cuerpo">
<div class="prefix_2 grid_8 suffix_2">
	<div class="titulo">Registro de Nuevo Arrendatario</div>
	<div class="cuerpo">
		<form action="registrar.php" autocomplete="off" method="post">
        <table>
        <tr><td>Nombre del Esposo:</td><td><input type="text" name="nombreEsposo" size="50"/></td></tr>
        <tr><td>C.I. del Esposo:</td><td><input type="text" name="ciEsposo"/></td></tr>
        <tr><td>Nombre de la Esposa:</td><td><input type="text" name="nombreEsposa" size="50"/></td></tr>
        <tr><td>C.I. de la Esposa:</td><td><input type="text" name="ciEsposa"/></td></tr>
        <tr><td>Garante Personal:</td><td><input type="text" name="nombreGarante" size="50"/></td></tr>
        <tr><td>C.I. del Garante:</td><td><input type="text" name="ciGarante"/></td></tr>
        <tr><td>Fecha de Ingreso:</td><td><input type="date" name="fechaIngreso" autocomplete="off"/></td></tr>
        <tr><td>Monto Mensual de Cancelación:</td><td><input type="number" name="monto" autocomplete="off" min="0" step="5" class="der"/>Bs.</td></tr>
        <tr><td>Fecha de Cancelación:</td><td><input type="date" name="fechaCancela" /></td></tr>
        <tr><td>Tiempo de Contrato:</td><td><input type="text" name="tiempoContrato" /></td></tr>
        <tr><td>Observaciones:</td><td><textarea name="observaciones" rows="5" cols="30"></textarea></td></tr>
        <tr><td></td><td><input type="submit" value="Registrar" class="corner-all"><input type="reset" class="corner-all"></td></tr>
        </table>
        </form>
	</div>
</div>
<div class="clear"></div>
</div>

<?php include_once("../pie.php");?>
