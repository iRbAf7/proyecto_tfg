<?php
require_once("models/connection.php");
require_once("models/niu_existent.php");
require_once("models/consultarCargos.php");
require_once("models/consultarAsigsUser.php");

if(isset($_POST['submit'])){
    //var_dump($_POST['niu']);
    $niu = $_POST['niu'];
    $res = niu_existent(connection(), $niu);
    if(!empty($res)){
        session_start();
        $_SESSION['niu'] = $res[0]['niu'];
        $message = "Hola! ".$res[0]['nombre']." ".$res[0]['apellido'];
        //echo "<div class='alert alert-danger' role='alert'>" .$message . "</div>";

        $cargo= consultarCargos(connection(),$res[0]['niu']);
        
        /*if ($cargo){
            echo "<div class='alert alert-danger' role='alert'> Càrrecs: " ;
            echo "<li>".$cargo[0]['descripcion']."</li></div>";
        }else{
            echo "<div class='alert alert-danger' role='alert'> No te cap càrrec. </div>" ;
        }*/

        $asigs = consultarAsigsUser(connection(),$niu);
        /*if ($asigs){
            echo "<div class='alert alert-danger' role='alert'> Assignatures: <br>" ;
            foreach ($asigs as $asig){
                echo "<li>".$asig['nombre']."</li>";
            }echo "</div>";
        }else{
            echo "<div class='alert alert-danger' role='alert'> No dóna cap asignatura. </div>" ;
        }*/

        $mensaje1 = "Serà dirigit a l'aplicació en pocs segons.";
        //echo "<div class='alert alert-danger' role='alert'>" .$mensaje1 . "</div>";
        //header("Refresh:6; url= ");
    }else{
        //$mensaje2 = "El niu no es troba a la base de dades. Serà redirigit en pocs segons.";
        $mensaje2 = "Es un estudiante.";
        $_SESSION['niu'] = $niu;
        //echo "<div class='alert alert-danger' role='alert'>" .$mensaje2 . "</div>";
        //header("Refresh:5; url=/silvia_visor_encuestas_v2/login.php");//index.php?action=login");
    }
    require("views/info_usuario.php");
}else{
    require("views/login.php");
}
/*
$_SESSION["niu"] = '1458707';//phpCAS::getUser(); //despues descomentar---------------------------------------------
if(!empty($_GET['ed'])) {
    //echo "holaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa";
    $versio = $_GET['ve'];
    $edicio = $_GET['ed'];
    $pla = $_GET['pla'];
    $assignatura = $_GET['as'];
    header("Refresh: 0; url=/silvia_visor_encuestas_v2/index.php?action=res&ve=$versio&ed=$edicio&pla=$pla&as=$assignatura");
} else {
    header("Refresh:0; url=/silvia_visor_encuestas_v2/index.php?action=especifica_enquesta");
}*/