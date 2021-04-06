<?php
require_once("models/connection.php");
require_once("models/llistar_assignatures.php");
require_once("models/llistar_assig_totes.php");
require_once("models/nom_pla.php");
require_once("models/nom_model.php");
require_once("models/nom_versio.php");
require_once("models/nom_edicio.php");

if (isset($_SESSION['niu'])) {
    if (isset($_SESSION['form'])) {

        $model = $_SESSION['form'][0];
        $versio = $_SESSION['form'][1];
        $edicio = $_SESSION['form'][2];
        $pla = $_SESSION['form'][3];

        $nom_pla = nom_pla(connection(), "$pla");
        $nom_edicio = nom_edicio(connection(), "$edicio");
        $nom_versio = nom_versio(connection(), "$versio");
        $nom_model = nom_model(connection(), "$model");

        if($pla != 0) {
            $result_llistar_assignatures = llistar_assignatures(connection(), "$edicio", "$pla");
        }else {
            $result_llistar_assignatures = llistar_assig_totes(connection(), "$edicio");
        }
        if (isset($_POST['assignatures'])) {
            if (!isset($_SESSION['assig'])){
                $_SESSION['assig'] = array();
            }
            $assignatures = $_POST['assignatures'];
            array_push($_SESSION['assig'], $assignatures);

            header("Refresh: 0; url=/silvia_visor_encuestas_v2/index.php?action=res&ve=$versio&ed=$edicio&pla=$pla&as=$assignatures");
        } else {
            unset($_SESSION["assig"]);
            require("views/escollir_assignatura.php");
        }
    } else {
        $message = "Cal especificar l'enquesta. Serà redirigit en pocs segons.";
        echo "<div class='alert alert-danger' role='alert'>" .$message . "</div>";
        header("Refresh:7; url=/silvia_visor_encuestas_v2/index.php?action=especifica_enquesta");
    }
} else {
    require("c_login.php");
}