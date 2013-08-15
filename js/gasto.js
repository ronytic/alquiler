$(document).ready(function(e) {
    $(".modificar").click(function(e) {
        if(!confirm("¿Desea modificar este Gasto?")){
			e.preventDefault();
			e.stopPropagation();	
		}
    });
	$(".eliminar").click(function(e) {
		var cod=$(this).attr("rel");
		if(confirm("¿Desea eliminar este Gasto?")){
        $.post("eliminar.php",{"CodGasto":cod},recargar);
		}
		e.preventDefault();
		e.stopPropagation();
    });
	function recargar(){
		location.reload();	
	}
});