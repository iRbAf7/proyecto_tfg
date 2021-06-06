<?php
session_start();
require_once("models/connection.php");
require_once("models/comprobar_permiso_ambito.php");
require_once("models/comprobar_permiso_defecto.php");
require_once("models/llistar_models.php");
require_once("models/llistar_versions.php");
require_once("models/llistar_edicions.php");
require_once("models/llistar_edicions_profes.php");
require_once("models/llistar_edicions_centres.php");
require_once("models/llistar_edicions_depts.php");
require_once("models/llistar_edicions_estudis.php");

require_once("models/llistar_pla.php");
require_once("models/comprobar_idAmbito_defecto.php");

require_once("models/consulta_graus_estudis.php");
require_once("models/consulta_graus_centres.php");
require_once("models/consulta_graus_departaments.php");
require_once("models/consulta_graus_profes.php");
//session_start();
if (isset($_SESSION['niu'])){
    $result_llistar_models = llistar_models(connection());
    $idAmbito_defecto = comprobar_idAmbito_defecto(connection(),$_SESSION['ambito_defecto']);
    $_SESSION['permiso_defecto'] = comprobar_permiso_defecto(connection(),$idAmbito_defecto[0]['idAmbitos'],$result_llistar_models[0]['Objeto_idObjeto']);
    $_SESSION['permiso_ambito'] = comprobar_permiso_ambito(connection(),$_SESSION['ambit_selec'],$result_llistar_models[0]['Objeto_idObjeto']);

    $result_llistar_versions = llistar_versions(connection());
    $result_llistar_edicions = llistar_edicions(connection());
    $niu = $_SESSION['niu'];

    if ($_SESSION['permiso_defecto'] == "ninguno" && $_SESSION['permiso_ambito'] == "ninguno"){
        $result_llistar_models = "";
        $result_llistar_versions = "";
        $result_llistar_edicions = "";
        $_SESSION['result_llistar_pla'] = "";
        $sin_permisos = "No te permisos per visualitzar cap enquesta.";
    }else{
        switch ($_SESSION['ambit_selec']){
            case 'Estudis':
                if ($_SESSION['permiso_defecto'] == "ninguno" && $_SESSION['permiso_ambito'] != "ninguno"){

                    $_SESSION['in']="";
                    $_SESSION['permiso_superior'] = $_SESSION['permiso_ambito'];
                    $result_llistar_edicions = llistar_edicions_estudis(connection(),$_SESSION['idEnAmbito'],"");
                    //$_SESSION['result_llistar_pla'] = consulta_graus_estudis(connection(),$_SESSION['idEnAmbito'] );

                }else{
                    if ($_SESSION['permiso_defecto'] == "basico" && $_SESSION['permiso_ambito'] == "total"){


                        $_SESSION['lista_graus_estudis'] = consulta_graus_estudis(connection(),$_SESSION['idEnAmbito'] ,"");
                        //$_SESSION['result_llistar_pla'] = llistar_pla(connection());
                    }else{

                        $_SESSION['permiso_superior'] = $_SESSION['permiso_defecto'];
                        //$_SESSION['result_llistar_pla'] = llistar_pla(connection());
                    }
                }
                break;
            case 'Centres':
                if ($_SESSION['permiso_defecto'] == "ninguno" && $_SESSION['permiso_ambito'] != "ninguno"){

                    $_SESSION['in']="";
                    $_SESSION['permiso_superior'] = $_SESSION['permiso_ambito'];
                    $result_llistar_edicions = llistar_edicions_centres(connection(),$_SESSION['idEnAmbito'],"");
                    //$_SESSION['result_llistar_pla'] = consulta_graus_centres(connection(),$_SESSION['idEnAmbito'] );
                }else{
                    if ($_SESSION['permiso_defecto'] == "basico" && $_SESSION['permiso_ambito'] == "total"){

                        $_SESSION['lista_graus_centres'] = consulta_graus_centres(connection(),$_SESSION['idEnAmbito'] );
                        //$_SESSION['result_llistar_pla'] = llistar_pla(connection());
                    }else{
                        $_SESSION['permiso_superior'] = $_SESSION['permiso_defecto'];
                        //$_SESSION['result_llistar_pla'] = llistar_pla(connection());
                    }
                }
                break;
            case 'Departaments':
                if ($_SESSION['permiso_defecto'] == "ninguno" && $_SESSION['permiso_ambito'] != "ninguno"){

                    $_SESSION['in']="";
                    $_SESSION['permiso_superior'] = $_SESSION['permiso_ambito'];
                    $result_llistar_edicions = llistar_edicions_depts(connection(),$_SESSION['idEnAmbito'],"");
                    //$_SESSION['result_llistar_pla'] = consulta_graus_departaments(connection(),$_SESSION['idEnAmbito'] );
                }else{
                    if ($_SESSION['permiso_defecto'] == "basico" && $_SESSION['permiso_ambito'] == "total"){

                        $_SESSION['entra_dept'] = true;
                        //$_SESSION['result_llistar_pla'] = llistar_pla(connection());
                    }else{

                        $_SESSION['permiso_superior'] = $_SESSION['permiso_defecto'];
                        //$_SESSION['result_llistar_pla'] = llistar_pla(connection());
                    }
                }
                break;
            case 'Professors':
                if ($_SESSION['permiso_defecto'] == "ninguno" && $_SESSION['permiso_ambito'] != "ninguno"){

                    $_SESSION['in']="";
                    $_SESSION['permiso_superior'] = $_SESSION['permiso_ambito'];
                    $result_llistar_edicions = llistar_edicions_profes(connection(),"$niu","");
                    //$_SESSION['result_llistar_pla'] = consulta_graus_profes(connection(),"$niu");
                }else{
                    if ($_SESSION['permiso_defecto'] == "basico" && $_SESSION['permiso_ambito'] == "total"){

                        $_SESSION['entra_profes'] = true;
                        //$_SESSION['result_llistar_pla'] = llistar_pla(connection());
                    }else{

                        $_SESSION['permiso_superior'] = $_SESSION['permiso_defecto'];
                        //$_SESSION['result_llistar_pla'] = llistar_pla(connection());
                    }
                }
                break;
            default://universitat y estudiants
                $_SESSION['permiso_superior'] = $_SESSION['permiso_ambito'];
                //$_SESSION['result_llistar_pla'] = llistar_pla(connection());
                break;
        }
    }

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

        header("Refresh: 0; url=/silvia_visor_encuestas_v2_1/index.php?action=escollir_assignatura");
    } else {
        unset($_SESSION["form"]);
        if (isset($_SESSION['id_assig'])){
            unset($_SESSION["id_assig"]);
        }
        require("views/especifica_enquesta.php");
    }
}else{
    $message = "Cal iniciar sessió. Serà redirigit en pocs segons.";
    require("views/especifica_enquesta.php");
    //echo "<div class='alert alert-danger' role='alert'>" .$message . "</div>";
    header("Refresh:3; url=/silvia_visor_encuestas_v2_1/index.php?action=login");
}
