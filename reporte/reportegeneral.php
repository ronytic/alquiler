<?php
include_once("../login/check.php");
$folder="../";
$titulo="Reporte General";
include_once("../cabecerahtml.php");
include_once("../class/arrendatario.php");
$arrendatario=new arrendatario;
?>
<script language="javascript" type="text/javascript" src="../js/reporte.js"></script>
</head>
<body>
<?php include_once("../cabecera.php"); ?>
<div class="container_12" id="cuerpo">
<div class="prefix_2 grid_8 suffix_2">
	<div class="cuerpo">
    	<table>
        	<tr><td>Fecha Inicio</td><td><input type="date" name="fechaInicio" value="2011-12-01"></td><td>Fecha Fin</td><td><input type="date" name="fechaFin" value="<?php echo date("Y-m-d")?>"></td><td><input type="submit" class="corner-all" value="Revisar" id="revisar"></td></tr>
        </table>
    </div>
</div>
<div class="prefix_1 grid_10 suffix_1">
	<div class="titulo">Listado de Arrendatarios - Reporte General</div>
	<div class="cuerpo" id="respuesta">
    	
	</div>
</div>
<div class="clear"></div>
</div>

<?php include_once("../pie.php");?>
