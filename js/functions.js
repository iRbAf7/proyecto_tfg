

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
                $("#assignatura").html(res);
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
        var selected = $("#pla_estudis option:selected").text();
        var selected2 = $("#assignatura option:selected").val();
        $.ajax({
            url:"/silvia_visor_encuestas_v2_1/index.php?action=tabla_compare",
            method: "POST",
            data:{pla:selected,assignatura:selected2},//$("#asig_to_compare").serialize(), //id_assignatura
            success:function(res){
                $("#show_table").html(res);
            }
        });
    });
});

function functionHide() {
    var x = document.getElementById("divToHide");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}

function mostraEnunciados(id) {
    var formEdicio = document.getElementById("enunciado-"+id);

    if (formEdicio.style.display === "none") {
        formEdicio.style.display = "block";
    } else {
        formEdicio.style.display = "none";
    }
}
