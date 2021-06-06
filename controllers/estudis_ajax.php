<?php
require_once("models/connection.php");
require_once("models/llistar_models.php");
require_once("models/llistar_versions.php");
require_once("models/llistar_assig_totes.php");
require_once("models/llistar_pla_segons_edicio.php");

require_once("models/consulta_graus_estudis.php");
require_once("models/consulta_graus_centres.php");
require_once("models/consulta_graus_departaments.php");
require_once("models/consulta_graus_profes.php");
session_start();
if (isset($_POST['nom_edicio'])){//despues comoprobar q no me de error por usar post[nom_edicio]

    $nom_edicio = $_POST['nom_edicio'];
    $niu = $_SESSION['niu'];
    switch ($_SESSION['ambit_selec']){
        case 'Estudis':
            if ($_SESSION['permiso_defecto'] == "ninguno" && $_SESSION['permiso_ambito'] != "ninguno"){

                $_SESSION['result_llistar_pla'] = consulta_graus_estudis(connection(),$_SESSION['idEnAmbito'],$nom_edicio );
            }else{
                if ($_SESSION['permiso_defecto'] == "basico" && $_SESSION['permiso_ambito'] == "total"){

                    $_SESSION['result_llistar_pla'] = llistar_pla_segons_edicio(connection(),$nom_edicio);
                }else{

                    $_SESSION['result_llistar_pla'] = llistar_pla_segons_edicio(connection(),$nom_edicio);
                }
            }
            break;
        case 'Centres':
            if ($_SESSION['permiso_defecto'] == "ninguno" && $_SESSION['permiso_ambito'] != "ninguno"){

                $_SESSION['result_llistar_pla'] = consulta_graus_centres(connection(),$_SESSION['idEnAmbito'] );
            }else{
                if ($_SESSION['permiso_defecto'] == "basico" && $_SESSION['permiso_ambito'] == "total"){

                    $_SESSION['result_llistar_pla'] = llistar_pla_segons_edicio(connection(),$nom_edicio);

                }else{

                    $_SESSION['result_llistar_pla'] = llistar_pla_segons_edicio(connection(),$nom_edicio);
                }
            }
            break;
        case 'Departaments':
            if ($_SESSION['permiso_defecto'] == "ninguno" && $_SESSION['permiso_ambito'] != "ninguno"){

                $_SESSION['result_llistar_pla'] = consulta_graus_departaments(connection(),$_SESSION['idEnAmbito'], $nom_edicio);
            }else{
                if ($_SESSION['permiso_defecto'] == "basico" && $_SESSION['permiso_ambito'] == "total"){

                    $_SESSION['result_llistar_pla'] = llistar_pla_segons_edicio(connection(),$nom_edicio);
                }else{

                    $_SESSION['result_llistar_pla'] = llistar_pla_segons_edicio(connection(),$nom_edicio);
                }
            }
            break;
        case 'Professors':
            if ($_SESSION['permiso_defecto'] == "ninguno" && $_SESSION['permiso_ambito'] != "ninguno"){

                $_SESSION['result_llistar_pla'] = consulta_graus_profes(connection(),"$niu",$nom_edicio);
            }else{
                if ($_SESSION['permiso_defecto'] == "basico" && $_SESSION['permiso_ambito'] == "total"){

                    $_SESSION['result_llistar_pla'] = llistar_pla_segons_edicio(connection(),$nom_edicio);
                }else{

                    $_SESSION['result_llistar_pla'] = llistar_pla_segons_edicio(connection(),$nom_edicio);

                }
            }
            break;
        default://universitat y estudiants
            $_SESSION['permiso_superior'] = $_SESSION['permiso_ambito'];
            $_SESSION['result_llistar_pla'] = llistar_pla_segons_edicio(connection(),$nom_edicio);
            break;
    }
    $html = '';

    foreach ($_SESSION['result_llistar_pla'] as $pla){

        $html .= "<option value='".$pla['idEstudio']."'>".$pla['nombre']."</option>";
    }
    echo $html;
}