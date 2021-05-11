
<?php
require_once("models/connection.php");
require_once("models/preguntes.php");
require_once("models/ediciones_de_asig.php");
require_once("models/llistar_versions.php");
require_once("models/taula_results_tots.php");
require_once("models/resultados_preg.php");
require_once("models/mitjana_total.php");
require_once("models/return_nombre_asig.php");
require_once("models/taula_resultats.php");
require_once("models/matriculats_total.php");

if(isset($_POST['id_assignatura'])){

    $version = llistar_versions(connection());
    $nom_asignatura = return_nombre_asig(connection(),$_POST['id_assignatura']);
    $preguntes = preguntes(connection(), $version[0]['nom']);
    $ediciones = ediciones_de_asig(connection(), $_POST['id_assignatura']);

    $matriculats = matriculats_total(connection(), $_POST['id_assignatura']);

    $preg1 = array();
    $preg2 = array();
    $preg3 = array();
    $preg4 = array();
    $preg5 = array();
    $preg6 = array();
    $preg7 = array();
    $preg8 = array();
    $preg9 = array();
    //taula_resultats(connection(), "AssigG02", "$edicio", "$pla", "$assignatura");
    //$tmp = taula_resultats(connection(), "AssigG02", $ediciones[0]['nom'],'958',$_POST['id_assignatura']);

    for ($i =0; $i <sizeof($ediciones);$i++){
        array_push($preg1, resultados_preg(connection(), "AssigG01", $ediciones[$i]['nom'],$_POST['id_assignatura']));
        array_push($preg2, resultados_preg(connection(), "AssigG02", $ediciones[$i]['nom'],$_POST['id_assignatura']));
        array_push($preg3, resultados_preg(connection(), "AssigG03", $ediciones[$i]['nom'],$_POST['id_assignatura']));
        array_push($preg4, mitjana_total(connection(), "AssigG04", $ediciones[$i]['nom'],$_POST['id_assignatura'])[0]);
        array_push($preg5, mitjana_total(connection(), "AssigG05", $ediciones[$i]['nom'],$_POST['id_assignatura'])[0]);
        array_push($preg6, mitjana_total(connection(), "AssigG06", $ediciones[$i]['nom'],$_POST['id_assignatura'])[0]);
        array_push($preg7, mitjana_total(connection(), "AssigG07", $ediciones[$i]['nom'],$_POST['id_assignatura'])[0]);
        array_push($preg8, mitjana_total(connection(), "AssigG08", $ediciones[$i]['nom'],$_POST['id_assignatura'])[0]);
        array_push($preg9, mitjana_total(connection(), "AssigG09", $ediciones[$i]['nom'],$_POST['id_assignatura'])[0]);
    }
    //var_dump($tmp);

    //$preg1 = resultados_preg(connection(), "AssigG01", $ediciones[0]['nom'],$_POST['assignatura']);
    //$preg2 = resultados_preg(connection(), "AssigG02", $ediciones[0]['nom'],$_POST['assignatura']);
    //$preg3 = resultados_preg(connection(), "AssigG03", $ediciones[0]['nom'],$_POST['assignatura']);
    //$preg4 = mitjana_total(connection(), 'AssigG04',$ediciones[0]['nom'],$_POST['assignatura']);
    //$preg5 = mitjana_total(connection(), 'AssigG05',$ediciones[0]['nom'],$_POST['assignatura']);

    //$er = mitjana_total(connection(), 'AssigG04',$ediciones[0]['nom'],$_POST['assignatura']);
    //$mitja4 = $er[0];
    for ($i =0; $i < sizeof($ediciones);$i++){
        array_push($ediciones[$i], $preg1[$i]);
        array_push($ediciones[$i], $preg2[$i]);
        array_push($ediciones[$i], $preg3[$i]);
        array_push($ediciones[$i], $preg4[$i]);
        array_push($ediciones[$i], $preg5[$i]);
        array_push($ediciones[$i], $preg6[$i]);
        array_push($ediciones[$i], $preg7[$i]);
        array_push($ediciones[$i], $preg8[$i]);
        array_push($ediciones[$i], $preg9[$i]);
    }
}


require("views/tabla_compare.php");
?>

