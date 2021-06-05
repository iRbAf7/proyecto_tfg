<?php
require_once("models/connection.php");
require_once("models/llistar_models.php");
require_once("models/llistar_versions.php");
require_once("models/llistar_assig_totes.php");
require_once("models/llistar_pla.php");

require_once("models/consulta_graus_estudis.php");
require_once("models/consulta_graus_centres.php");
require_once("models/consulta_graus_departaments.php");
require_once("models/consulta_graus_profes.php");


if (isset($_SESSION['niu']) ) {
    if ($_SESSION['permiso_ambito'] == "ninguno" && $_SESSION['permiso_defecto'] == "ninguno") {

        $sin_permisos = "No te permisos per visualitzar cap enquesta.";
        require("views/comparar_enquestes.php");
        //echo "<div class='alert alert-danger' role='alert'>" .$sin_permisos . "</div>";
        header("Refresh:3; url=/silvia_visor_encuestas_v2_1/index.php?action=especifica_enquesta");

    } else {
        $model_compare = llistar_models(connection());
        $versio_compare = llistar_versions(connection());
        $usuari = $_SESSION['niu'];

        switch ($_SESSION['ambit_selec']){
            case 'Estudis':
                if ($_SESSION['permiso_defecto'] == "ninguno" && $_SESSION['permiso_ambito'] != "ninguno"){

                    $lista_estudios = consulta_graus_estudis(connection(),$_SESSION['idEnAmbito'] ,"");
                }else{
                    if ($_SESSION['permiso_defecto'] == "basico" && $_SESSION['permiso_ambito'] == "total"){

                        $lista_estudios = llistar_pla(connection());
                    }else{

                        $lista_estudios = llistar_pla(connection());
                    }
                }
                break;
            case 'Centres':
                if ($_SESSION['permiso_defecto'] == "ninguno" && $_SESSION['permiso_ambito'] != "ninguno"){

                    $lista_estudios = consulta_graus_centres(connection(),$_SESSION['idEnAmbito'] );
                }else{
                    if ($_SESSION['permiso_defecto'] == "basico" && $_SESSION['permiso_ambito'] == "total"){

                        $lista_estudios = llistar_pla(connection());
                    }else{
                        $lista_estudios = llistar_pla(connection());
                    }
                }
                break;
            case 'Departaments':
                if ($_SESSION['permiso_defecto'] == "ninguno" && $_SESSION['permiso_ambito'] != "ninguno"){

                    $lista_estudios = consulta_graus_departaments(connection(),$_SESSION['idEnAmbito'],"" );
                }else{
                    if ($_SESSION['permiso_defecto'] == "basico" && $_SESSION['permiso_ambito'] == "total"){


                       $lista_estudios = llistar_pla(connection());
                    }else{

                        $lista_estudios = llistar_pla(connection());
                    }
                }
                break;
            case 'Professors':
                if ($_SESSION['permiso_defecto'] == "ninguno" && $_SESSION['permiso_ambito'] != "ninguno"){

                    $lista_estudios= consulta_graus_profes(connection(),"$usuari","");
                }else{
                    if ($_SESSION['permiso_defecto'] == "basico" && $_SESSION['permiso_ambito'] == "total"){

                        $lista_estudios = llistar_pla(connection());
                    }else{

                        $lista_estudios = llistar_pla(connection());
                    }
                }
                break;
            default://universitat y estudiants

                $lista_estudios = llistar_pla(connection());
                break;
        }
        require("views/comparar_enquestes.php");
    }
} else {
    $message = "Cal iniciar sessió. Serà redirigit en pocs segons.";
    require("views/comparar_enquestes.php");
    header("Refresh:3; url=/silvia_visor_encuestas_v2_1/index.php?action=login");
}