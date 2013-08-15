$(document).ready(function(e) {
    $("#revisar").click(function(e) {
        var FechaInicio=$("input[name=fechaInicio]").val();
		var FechaFin=$("input[name=fechaFin]").val();
		$.post("general.php",{'FechaInicio':FechaInicio,'FechaFin':FechaFin},respuesta)
    });
	function respuesta(data){
		$("#respuesta").html(data);
	}
});