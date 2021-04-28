

function visitPage(){
    //header("Refresh:0; url=/silvia_visor_encuestas_v2/index.php?action=especifica_enquesta");
   // window.location='/silvia_visor_encuestas_v2/index.php?action=especifica_enquesta';
}
$(document).ready(function (){

    $(document).on("click", '#comparar',function () {
        $.ajax({
            url:"views/tabla_compare.php",
            method: "POST",
            data:$("#asig_to_compare").serialize(),
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