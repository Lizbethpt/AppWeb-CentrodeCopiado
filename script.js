$(document).ready(function(){
    $("#cargarDatos").click(function(){
        $.get("process.php", function(data, status){
            $("#datos").html(data);
        });
    });
});
