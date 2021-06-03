

$(document).ready(function () {
    $("#pla_estudis").change(function () {
        var parametros = "id="+$("#pla_estudis").val();
        console.log(parametros);
        $.ajax({
            url: './controllers/prueba.php',
            data: parametros,
            method: 'post',
            success: function (output) {
                console.log(output);
                $('#assignatura').html(output);
            }
        });
    })
});



//function cambio_de_pla(id_plan) {
    $(document).ready(function () {
        $("#pla_estudis").change(function () {
            var parametros = "id="+$("#pla_estudis").val();
            console.log(parametros);
            $.ajax({
                url: './controllers/prueba.php',
                data: parametros,
                method: 'post',
                success: function (output) {
                    console.log(output);
                    $('#assignatura').html(output);
                }
            });
        })
    });
//}
   /*
   $.ajax({
            url:'index.php?accion=prueba',//'./controllers/prueba.php',
            method: 'post',
            data: parametros,//$("#asig_to_compare").serialize(),
            success:function(res){
                console.log(res)
                $("#assignatura").html(res);
            }
        });
   * */




$(document).ready(function (){
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
