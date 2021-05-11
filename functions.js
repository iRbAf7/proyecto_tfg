

function visitPage(){
    //header("Refresh:0; url=/silvia_visor_encuestas_v2/index.php?action=especifica_enquesta");
   // window.location='/silvia_visor_encuestas_v2/index.php?action=especifica_enquesta';
}

/*$(document).ready(function(){
    $("#nom_edicio").on('change', function () {
        $("#nom_edicio option:selected").each(function () {
            elegido=$(this).val();
            $.post("/../controllers/especifica_enquesta.php", { elegido: elegido }, function(data){
                $("#pla_estudis").html(data);
            });
        });
    });
});
*/

$(document).ready(function (){
    $("#pla_estudis").change(function (){
        var parametros = "id="+$("#pla_estudis").val();
        $.ajax({
            url:'./controllers/prueba.php',
            method: 'post',
            data: parametros,//$("#asig_to_compare").serialize(),
            success:function(res){
                $("#id_assignatura").html(res);
            }
        });
    })

   /* $("#pla_estudis").on('change', function () {
        $("#nom_edicio option:selected").each(function () {
            var elegido=$(this).val();
            $.post("../controllers/prueba.php", { elegido: elegido }, function(data){
                $("#assignatura").html(data);
            });
        });
    });*/


    /*
    $('#comparar').on('click', function() {
        $("#show_table").load('index.php?action=tabla_compare');
        return false;
    });*/


    //esgto esta bieee
    $(document).on("click", '#comparar',function () {
        $.ajax({
            url:"/silvia_visor_encuestas_v2/index.php?action=tabla_compare",
            method: "POST",
            data:$("#id_assignatura").serialize(),
            success:function(res){
                $("#show_table").html(res);
            }
        });
    });
});
//esta bieeen, dsps descomenatr
function functionHide() {
    var x = document.getElementById("divToHide");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}