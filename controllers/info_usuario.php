<?php
require_once("models/connection.php");
require_once("models/niu_existent.php");
require_once("models/consultarCargos.php");
require_once("models/consultarAsigsUser.php");


if (isset($_POST['ambit_selec'])){
    $_SESSION['ambit_selec']= $_POST['ambit_selec'];
    $_SESSION['ambito_defecto']='Estudiant';
    header("Refresh: 0; url=/silvia_visor_encuestas_v2_1/index.php?action=especifica_enquesta");
}else{
    $res = niu_existent(connection(), $_SESSION['niu']);
    if(!empty($res)){

        //$_SESSION['niu'] = $res[0]['niu'];
        $message = "Hola ".$res[0]['nombre']." ".$res[0]['apellido']."!";

        $cargo= consultarCargos(connection(),$res[0]['niu']);//devuelve cargos.descripcion, ambitos.nom
        if (!empty($cargo))
        {
            $_SESSION['idEnAmbito'] =  $cargo[0]['idEnAmbito'];
        }
        $asigs = consultarAsigsUser(connection(),$_SESSION['niu']);

        $ambitos = array();
        if ($cargo){
            array_push($ambitos, $cargo[0]['nom']);
        }
        //var_dump($cargo[0]['idEnAmbito']);
        if ($asigs){
            array_push($ambitos, "Professors");
        }

    }else{

        $mensaje2 = "El usuario ".$_SESSION['niu']." es un estudiant.";
        $ambitos = "Estudiant";

    }

    require("views/info_usuario.php");
}
