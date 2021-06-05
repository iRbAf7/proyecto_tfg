<?php
require_once("models/connection.php");
require_once("models/niu_existent.php");
require_once("models/consultarCargos.php");
require_once("models/consultarAsigsUser.php");

if(isset($_POST['submit'])){
    $_SESSION['niu'] =  $_POST['niu'];

    /*$res = niu_existent(connection(), $niu);
    if(!empty($res)){

        //$_SESSION['niu'] = $res[0]['niu'];
        $message = "Hola ".$res[0]['nombre']." ".$res[0]['apellido']."!";

        $cargo= consultarCargos(connection(),$res[0]['niu']);//comprueba cargos y ambitos
        $_SESSION['ambitos'] = array();
        if ($cargo){

            array_push($_SESSION['ambitos'], $cargo[0]['nom']);
        }

        $asigs = consultarAsigsUser(connection(),$niu);
        if ($asigs)
        {
            array_push($_SESSION['ambitos'], "Profesors");
        }


    }else{

        $mensaje2 = "Es un estudiant.";
        //$_SESSION['niu'] = $niu;
        $_SESSION['ambitos'] = "Estudiant";

    }*/
    header("Refresh: 0; url=/silvia_visor_encuestas_v2_1/index.php?action=info_usuario");

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