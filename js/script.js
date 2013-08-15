$(document).ready(function(e) {
	$(".fechas").datepicker({maxDate: "0D"});
	$(".fechas").change(function(e) {
        var fecha=$(this).val();
		var cod=$(this).attr("rel")
		$.post("modificar.php",{'CodPago':cod,'Fecha':fecha,'Tipo':"Fecha"})
    });
    $(".eliminar").click(function(e) {
        if(confirm("¿Desea Elminar este Pago?")){
			var cod=$(this).attr("rel");
			$.post("eliminar.php",{'CodPago':cod},recargar)
		}
		e.preventDefault();
		e.stopPropagation();
    });
	$(".monto").keyup(function(e) {
		e.preventDefault();
		e.stopPropagation();
		var monto=$(this).val();
		var cod=$(this).attr("rel");
		$.post("modificar.php",{'CodPago':cod,'Monto':monto,'Tipo':"Monto"})
    });
	$(".observaciones").keyup(function(e) {
		e.preventDefault();
		e.stopPropagation();
		var obs=$(this).val();
		var cod=$(this).attr("rel");
		$.post("modificar.php",{'CodPago':cod,'Obs':obs,'Tipo':"Observaciones"})
    });
	$(".cancelar").click(function(e) {
		e.preventDefault();
		e.stopPropagation();
		var monto=$(this).attr("data-monto");
		var mes=$(this).attr("data-mes");
		var anio=$(this).attr("data-anio");
		var fecha=$(this).attr("data-fecha");
		var cod=$(this).attr("rel");
		$.post("cancela.php",{'CodArrendatario':cod,'Monto':monto,'Mes':mes,'Anio':anio,'FechaCancelado':fecha},recargar)
    });
	function recargar(){
		location.reload();	
	}
});