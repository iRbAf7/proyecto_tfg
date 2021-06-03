<?php
require_once("models/connection.php");
require_once("models/llistar_models.php");
require_once("models/llistar_versions.php");
require_once("models/llistar_assig_totes.php");

if (isset($_SESSION['niu']) ) {
    if ($_SESSION['permiso_ambito'] == "ninguno" && $_SESSION['permiso_defecto'] == "ninguno") {

        /*if ($_SESSION['permiso_ambito'] == "ninguno")
        {
            $message = "No te permisos per visualitzar cap enquesta.";
        }else{
            $message = "Cal especificar l'enquesta. Serà redirigit en pocs segons.";
        }*/
        $message = "No te permisos per visualitzar cap enquesta.";
        echo "<div class='alert alert-danger' role='alert'>" .$message . "</div>";
        header("Refresh:3; url=/silvia_visor_encuestas_v2_1/index.php?action=especifica_enquesta");

    } else {
        $model_compare = llistar_models(connection());
        $versio_compare = llistar_versions(connection());

        //$llista_asignatures = llistar_assig_totes(connection());
        /*if (isset($_POST['elegido'])){
            $pla = $_POST['elegido'];
            if($_SESSION['ambit_selec'] == 'Departaments' || isset($_SESSION['entra_dept']))
            {
                $_SESSION['asigs_dept'] = llistar_assignatures_dept(connection(),$_SESSION['idEnAmbito'],"", "$pla");
            }
            if($_SESSION['ambit_selec'] == 'Professors' || isset($_SESSION['entra_profes']))
            {
                $_SESSION['lista_asigs_profes'] = llistar_asigs_profes(connection(),$_SESSION['niu'] ,"", "$pla");

            }

            if(($_SESSION['ambit_selec'] == 'Departaments' || $_SESSION['ambit_selec'] == 'Professors') && isset($_SESSION['permiso_superior'])){
                if($_SESSION['permiso_superior'] == $_SESSION['permiso_ambito']){
                    if ($_SESSION['ambit_selec'] == 'Departaments'){
                        $llista_asignatures = $_SESSION['asigs_dept'];
                    }else{//en caso de Professor
                        $llista_asignatures = $_SESSION['lista_asigs_profes'];
                    }
                }else{
                    $llista_asignatures = llistar_assignatures(connection(), "", "$pla");
                }
            }else{
                $llista_asignatures = llistar_assignatures(connection(), "", "$pla");
            }
            var_dump($llista_asignatures);
            //echo $llista_asignatures;
        }else{
            require("views/comparar_enquestes.php");
        }*/
        require("views/comparar_enquestes.php");
    }
} else {
    require("c_login.php");
}