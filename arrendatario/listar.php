<?php
include_once("../login/check.php");
$folder="../";
$titulo="Listar Arrendatarios";
include_once("../cabecerahtml.php");
include_once("../class/arrendatario.php");
$arrendatarios=new arrendatario;
?>
<script language="javascript" type="text/javascript" src="../js/arrendatario.js"></script>
</head>
<body>
<?php include_once("../cabecera.php"); ?>
<div class="container_12" id="cuerpo">
<div class="prefix_1 grid_10 suffix_1">
	<div class="titulo">Listado de Arrendatarios</div>
	<div class="cuerpo">
		<table class="tabla">
        	<tr class="cabecera"><td>Nombre Esposo</td><td>CI Esposo</td><td>Nombre Esposa</td><td>CI Esposa</td><td>Monto</td><td>Observaciones</td></tr>
            <?php foreach($arrendatarios->mostrarTodo() as $arren){
				?>
				<tr class="contenido"><td><?php echo $arren['NombreEsposo']?></td><td><?php echo $arren['CiEsposo']?></td><td><?php echo $arren['NombreEsposa']?></td><td><?php echo $arren['CiEsposa']?></td><td><?php echo $arren['Monto']?></td><td><?php echo $arren['Observaciones']?></td><td><a href="modificar.php?CodArrendatario=<?php echo $arren['CodArrendatario']?>" class="botonSec modificar" rel="">Modificar</a><a href="#" class="botonSec eliminar" rel="<?php echo $arren['CodArrendatario']?>">Eliminar</a></td></tr>
				<?php	
			}?>
        </table>
	</div>
</div>
<div class="clear"></div>
</div>

<?php include_once("../pie.php");?>
