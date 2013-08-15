<?php
include_once("config.php");
if(empty($titulo)){$titulo=""; }
include_once("class/usuarios.php");
include_once("class/menu.php");
include_once("class/submenu.php");
$usuarios= new usuarios;
$menu=new menu;
$submenu=new submenu;
$CodUsuario=$_SESSION['CodUsuarioLog'];
$Nivel=$_SESSION['Nivel'];
switch($Nivel){
	case 1:{$datosUsuario=$usuarios->mostrarDatos($CodUsuario);
			$datosUsuario=array_shift($datosUsuario);
			$Apodo=$datosUsuario['Nick'];	
	}break;
	case 2:{$datosUsuario=$usuarios->mostrarDatos($CodUsuario);
			$datosUsuario=array_shift($datosUsuario);
			$Apodo=$datosUsuario['Nick'];	
	}break;
	case 3:{$datosUsuario=$usuarios->mostrarDatos($CodUsuario);
			$datosUsuario=array_shift($datosUsuario);
			$Apodo="Docente";	
	}break;
	case 4:{$datosUsuario=$usuarios->mostrarDatos($CodUsuario);
			$datosUsuario=array_shift($datosUsuario);
			$Apodo=$datosUsuario['Nick'];	
	}break;
}
$Paterno=$datosUsuario['Paterno'];
$Materno=$datosUsuario['Materno'];
$Nombres=$datosUsuario['Nombres'];

?>
<div class="container_12 corner-tl corner-tr" id="cabecera">
	<div class="grid_6"><?php echo $title;?> | <?php echo $titulo;?></div>
    <div class="grid_2"><div class="cargando corner-all" id="cargando"></div>|</div>
    <div class="prefix_1 grid_2 der">
    	<span title="<?php echo $Paterno;?> <?php echo $Materno;?> <?php echo $Nombres;?>"><?php echo $Apodo;?></span>
    </div>
		
    <div class="clear"></div>
    <div class="grid_12">

    	<ul id="css3menu1" class="topmenu" style="margin:15px 0px 15px 0px;">
	<li class="topfirst"><a href="<?php echo $url.$directory;?>/" style="height:15px;line-height:15px;" class="pressed">Inicio</a></li>
    <?php foreach($menu->mostrar($Nivel) as $m){
		?><li class="topmenu"><a href="#" style="height:15px;line-height:15px;"><span><?php echo $m['Nombre']?></span></a><?php
		if($m['SubMenu']){
			?><ul><?php
			$i=0;
			foreach($submenu->mostrar($Nivel,$m['CodMenu'])	as $sm){$i++;
				if($i==1){
					?><li class="subfirst"><a href="<?php echo $folder;?><?php echo $m['Url'];?><?php echo $sm['Url'];?>"><?php echo $sm['Nombre'];?></a></li><?php	
				}else{
					?><li><a href="<?php echo $folder;?><?php echo $m['Url'];?><?php echo $sm['Url'];?>"><?php echo $sm['Nombre'];?></a></li><?php
				}
				$i++;
			}
			?></ul><?php
		}
		?></li><?php
	}?>
	<li class="toplast"><a href="<?php echo $url.$directory;?>/login/logout.php" style="height:15px;line-height:15px;">Salir</a></li>
</ul>
    </div>
</div>