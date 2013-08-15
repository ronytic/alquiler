<?php
include_once("../login/check.php");
if(!empty($_GET)){
$folder="../";
include_once("../class/gasto.php");
$gasto=new gasto;
$cod=$_GET['CodGasto'];
$titulo="Modificar Gastos";
$g=array_shift($gasto->mostrarTodo(0,"CodGasto=$cod"));
include_once("../cabecerahtml.php");
?>
</head>
<body>
<?php include_once("../cabecera.php"); ?>
<div class="container_12" id="cuerpo">
<div class="prefix_2 grid_8 suffix_2">
	<div class="titulo">Modificar Gasto</div>
	<div class="cuerpo">
		<form action="guardarmodificacion.php" autocomplete="off" method="post"><input type="hidden" name="CodGasto" value="<?php echo $cod;?>">
        <table>
        <tr><td>Detalle del Gasto:</td><td><input type="text" name="detalle" size="50" value="<?php echo $g['Detalle']?>"/></td></tr>
        <tr><td>Monto Gasto:</td><td><input type="number" name="monto" autocomplete="off" min="0" step="1" class="der" value="<?php echo $g['Monto']?>"/>Bs.</td></tr>
        <tr><td>Fecha de Gasto:</td><td><input type="date" name="fecha" value="<?php echo $g['FechaGasto']?>"/></td></tr>
 
        <tr><td>Observaciones:</td><td><textarea name="observaciones" rows="5" cols="30"><?php echo $g['Observaciones']?></textarea></td></tr>
        <tr><td></td><td><input type="submit" value="Registrar" class="corner-all"><input type="reset" class="corner-all"></td></tr>
        </table>
        </form>
	</div>
</div>
<div class="clear"></div>
</div>

<?php include_once("../pie.php");}?>
