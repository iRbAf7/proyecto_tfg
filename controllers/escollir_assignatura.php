<?php
require_once("models/connection.php");
require_once("models/llistar_assignatures.php");
require_once("models/llistar_assig_totes.php");
require_once("models/llistar_assignatures_dept.php");
require_once("models/nom_pla.php");
require_once("models/nom_model.php");
require_once("models/nom_versio.php");
require_once("models/nom_edicio.php");

if (isset($_SESSION['niu']) ) {
    if (isset($_SESSION['form']) && $_SESSION['permiso_ambito'] != "ninguno") {

        $model = $_SESSION['form'][0];
        $versio = $_SESSION['form'][1];
        $edicio = $_SESSION['form'][2];
        $pla = $_SESSION['form'][3];

        $nom_model = nom_model(connection(), "$model");
        $nom_versio = nom_versio(connection(), "$versio");
        $nom_edicio = nom_edicio(connection(), "$edicio");
        $nom_pla = nom_pla(connection(), "$pla");

        if($_SESSION['ambit_selec'] == 'Departaments' || isset($_SESSION['entra_dept']))
        {
            $_SESSION['asigs_dept'] = llistar_assignatures_dept(connection(),$_SESSION['idEnAmbito'],"$edicio", "$pla");
        }

        /*
         * Estas condiciones se comprueban porque la lista de asignaturas que se
         * muestra cuando solo se han de mostrar de los correspondientes, en el caso
         * del ambito departamento solo seran aquellos que hayan profesores del departamento en cuestion
         * */
        if($pla != 0) {//escoge estudio concreto
            if(($_SESSION['ambit_selec'] == 'Departaments' || $_SESSION['ambit_selec'] == 'Professors') && isset($_SESSION['permiso_superior'])){
                if($_SESSION['permiso_superior'] == $_SESSION['permiso_ambito']){
                    if ($_SESSION['ambit_selec'] == 'Departaments'){
                        $result_llistar_assignatures = $_SESSION['asigs_dept'];
                    }else{//en caso de Professor
                        $result_llistar_assignatures = llistar_asigs_profes(connection(),$_SESSION['niu'] ,"$edicio", "$pla");
                    }
                }else{
                    $result_llistar_assignatures = llistar_assignatures(connection(), "$edicio", "$pla");
                }
            }else{
                $result_llistar_assignatures = llistar_assignatures(connection(), "$edicio", "$pla");
            }
        }else {
            if(($_SESSION['ambit_selec'] == 'Departaments' || $_SESSION['ambit_selec'] == 'Professors')&& isset($_SESSION['permiso_superior'])){
                if($_SESSION['permiso_superior'] == $_SESSION['permiso_ambito']){
                    if ($_SESSION['ambit_selec'] == 'Departaments'){
                        $result_llistar_assignatures = $_SESSION['asigs_dept'];
                    }else{//en caso de Professor
                        $result_llistar_assignatures = llistar_asigs_profes(connection(),$_SESSION['niu'] ,"$edicio", "$pla");
                    }
                }else{
                    $result_llistar_assignatures = llistar_assig_totes(connection(), "$edicio");
                }
            }else{
                $result_llistar_assignatures = llistar_assig_totes(connection(), "$edicio");
            }

        }

        if (isset($_POST['assignatures'])) {
            if (!isset($_SESSION['id_assig'])){
                $_SESSION['id_assig'] = array();
            }

            $assignatures = $_POST['assignatures'];//Guarda la id de la asignatura
            array_push($_SESSION['id_assig'], $assignatures);

            header("Refresh: 0; url=/silvia_visor_encuestas_v2/index.php?action=res&ve=$versio&ed=$edicio&pla=$pla&as=$assignatures");
        } else {
            unset($_SESSION["id_assig"]);
            require("views/escollir_assignatura.php");
        }
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