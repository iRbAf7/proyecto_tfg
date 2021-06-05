/*
 * AJAX para especifica_enquestes
 * */

$(document).ready(function () {

    var nom_edicio = "nom_edicio="+$("#nom_edicio").val();
    get_estudis_corresponents(nom_edicio);

    $("#nom_edicio").change(function () {
        var nom_edicio = "nom_edicio="+$("#nom_edicio").val();
        //console.log(parametros);
        get_estudis_corresponents(nom_edicio);
    })
});
function get_estudis_corresponents(nom_edicio){
    $.ajax({
        url: 'index.php?action=estudis_ajax',
        data: nom_edicio,
        method: 'post',
        success: function (output) {
            console.log(output);
            $('#pla_estudis').html(output);
        }
    });
}



/**
 * AJAX para comparar_enquestes
 * */
$(document).ready(function () {

    var parametros = "id="+$("#estudis").val();
    recarga(parametros);

    $("#estudis").change(function () {
        var parametros = "id="+$("#estudis").val();
        //console.log(parametros);
        recarga(parametros);
    })
});
function recarga(parametros){
    $.ajax({
        url: 'index.php?action=asigs_ajax',
        data: parametros,
        method: 'post',
        success: function (output) {
            console.log(output);
            $('#assignatura').html(output);
        }
    });
}
   /*
   $.ajax({
            url:'index.php?accion=,
            method: 'post',
            data: parametros,//$("#asig_to_compare").serialize(),
            success:function(res){
                console.log(res)
                $("#assignatura").html(res);
            }
        });
   * */




$(document).ready(function (){
    $(document).on("click", '#comparar',function () {
        var selected = $("#estudis option:selected").val();
        var selected2 = $("#assignatura option:selected").val();
        console.log(selected);
        console.log(selected2);
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
    console.log(id);
    var tmp;
    for (var i =0;i<9;i++){
        if (i !== id){
            tmp = document.getElementById("enunciado-"+i);
            if (tmp.style.display === "block"){
                tmp.style.display = "none";
            }
        }
    }
    if (formEdicio.style.display === "none") {
        formEdicio.style.display = "block";
    } else {
        formEdicio.style.display = "none";
    }
}
