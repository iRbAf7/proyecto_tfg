<?php
require_once("models/connection.php");
require_once("models/comprobar_permiso_ambito.php");
require_once("models/comprobar_permiso_defecto.php");
require_once("models/llistar_models.php");
require_once("models/llistar_versions.php");
require_once("models/llistar_edicions.php");
require_once("models/llistar_pla.php");



$result_llistar_models = llistar_models(connection());
$permiso_defecto = comprobar_permiso_defecto(connection(),8,$result_llistar_models[0]['Objeto_idObjeto']);
$permiso_ambito = comprobar_permiso_ambito(connection(),$_SESSION['ambit_selec'],$result_llistar_models[0]['Objeto_idObjeto']);
$result_llistar_versions = llistar_versions(connection());
$result_llistar_edicions = llistar_edicions(connection());
$result_llistar_pla = llistar_pla(connection());

if (isset($_SESSION['niu'])){

    if (isset($_POST['nom_model'])) {
        if (!isset($_SESSION['form'])){
            $_SESSION['form'] = array();
        }


        $nom_model = $_POST['nom_model'];
        array_push($_SESSION['form'], $nom_model);
        $nom_versio = $_POST['nom_versio'];
        array_push($_SESSION['form'],$nom_versio);
        $nom_edicio = $_POST['nom_edicio'];
        array_push($_SESSION['form'], $nom_edicio);
        $pla_estudis = $_POST['pla_estudis'];
        array_push($_SESSION['form'], $pla_estudis);

        header("Refresh: 0; url=/silvia_visor_encuestas_v2/index.php?action=escollir_assignatura");
    } else {
        unset($_SESSION["form"]);
        if (isset($_SESSION['assig'])){
            unset($_SESSION["assig"]);
        }
        require("views/especifica_enquesta.php");
    }
}else{
    $message = "Cal iniciar sessió. Serà redirigit en pocs segons.";
    echo "<div class='alert alert-danger' role='alert'>" .$message . "</div>";
    header("Refresh:10; url=/silvia_visor_encuestas_v2/index.php?action=login");
}
