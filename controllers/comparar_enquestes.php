<?php
require_once("models/connection.php");
require_once("models/llistar_models.php");
require_once("models/llistar_versions.php");
require_once("models/llistar_assig_totes.php");
require_once("models/nom_model.php");
require_once("models/nom_versio.php");

if (isset($_SESSION['niu']) ) {
    if ($_SESSION['permiso_ambito'] != "ninguno") {
        $model_compare = llistar_models(connection());
        $versio_compare = llistar_versions(connection());
        $llista_asignatures = llistar_assig_totes(connection());
        require("views/comparar_enquestes.php");
    } else {
        if ($_SESSION['permiso_ambito'] == "ninguno")
        {
            $message = "No te permisos per visualitzar cap enquesta.";
        }else{
            $message = "Cal especificar l'enquesta. Serà redirigit en pocs segons.";
        }

        echo "<div class='alert alert-danger' role='alert'>" .$message . "</div>";
        header("Refresh:4; url=/silvia_visor_encuestas_v2/index.php?action=especifica_enquesta");
    }
} else {
    require("c_login.php");
}