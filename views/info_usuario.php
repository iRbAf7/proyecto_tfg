<?php
if(!empty($res)){
    echo "<div class='alert alert-danger' role='alert'>" .$message . "</div>";

    if ($cargo){
        echo "<div class='alert alert-danger' role='alert'> Càrrecs: " ;
        echo "<li>".$cargo[0]['descripcion']."</li></div>";
    }else{
        echo "<div class='alert alert-danger' role='alert'> No te cap càrrec. </div>" ;
    }
    if ($asigs){
        echo "<div class='alert alert-danger' role='alert'> Assignatures: <br>" ;
        foreach ($asigs as $asig){
            echo "<li>".$asig['nombre']."</li>";
        }echo "</div>";
    }else{
        echo "<div class='alert alert-danger' role='alert'> No dóna cap asignatura. </div>" ;
    }
    echo "<div class='alert alert-danger' role='alert'>" .$mensaje1 . "</div>";
    //header("Refresh:6; url=/silvia_visor_encuestas_v2/index.php?action=especifica_enquesta");
    echo "<button id='myButton'> Siguiente </button>";

}else{
    echo "<div class='alert alert-danger' role='alert'>" .$mensaje2 . "</div>";
    //header("Refresh:5; url=/silvia_visor_encuestas_v2/login.php");
    echo "<button id='myButton'> Siguiente </button>";
}

?>
<script>
    document.getElementById("myButton").onclick = function () {
        location.href = "/silvia_visor_encuestas_v2/index.php?action=especifica_enquesta";
    };

</script>