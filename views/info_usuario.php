<?php
if(!empty($res)){
    echo "<div class='logger logger-login' role='alert'>" .$message . "</div>";

    if ($cargo){
        echo "<div class='logger logger-login' role='alert'> Àmbit: " ;
        foreach ($ambitos as $ambito){
            echo "<li> ".$ambito."</li>";
        }

        echo "Càrrecs:";
        echo "<li>".$cargo[0]['descripcion']."</li></div>";
    }else{
        if ($asigs){
            echo "<div class='logger logger-login' role='alert'> Àmbit: " ;
            echo "<li> ".$ambitos[0]."</li></div>";
        }

        echo "<div class='logger logger-login' role='alert'> No te cap càrrec. </div>" ;
    }

    if ($asigs){
        echo "<div class='logger logger-login' role='alert'> Assignatures: <br>" ;
        foreach ($asigs as $asig){
            echo "<li>".$asig['nombre']." - ".$asig['idAsignaturas']."</li>";
        }echo "</div>";
    }else{
        echo "<div class='logger logger-login' role='alert'> No dóna cap asignatura. </div>" ;
    }

    if (count($ambitos) != 1){
        echo " Amb quin àmbit vol accedir? <br><br>";
        echo "<form  method='post' autocomplete='on'  action='?action=info_usuario'>";
        foreach ($ambitos as $ambit){
            echo "<button type='submit' name='ambit_selec' class='btn btn-default' value='$ambit'> $ambit </button>  ";
        }
        echo "</form>";
        echo "<br><br>";
    }else{
        //echo "<div class='logger logger-login' role='alert'>";
        echo "<form  method='post' autocomplete='on'  action='?action=info_usuario'>";
        echo "<button type='submit' class='btn btn-default' name='ambit_selec' value='$ambitos[0]'> Especificar enquesta </button><br><br>";
        echo "</form>";//echo "</div><br><br>";
    }

}else{
    echo "<div class='logger logger-login' role='alert'> Àmbit: " ;
    echo "<li> ".$ambitos."</li>";
    echo "</div>";
    echo "<div class='logger logger-login' role='alert'>" .$mensaje2 . "</div>";
    //header("Refresh:5; url=/silvia_visor_encuestas_v2/login.php");
    echo "<form  method='post' autocomplete='on'  action='?action=info_usuario'>";
    echo "<button type='submit' name='ambit_selec' class='btn btn-default' value='$ambitos' > Especificar enquesta </button><br><br>";
    echo "</form>";
}

?>