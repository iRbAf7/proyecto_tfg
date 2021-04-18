<?php
require_once("models/connection.php");
require_once("models/comprobar_permiso_ambito.php");
require_once("models/comprobar_permiso_defecto.php");
require_once("models/llistar_models.php");
require_once("models/llistar_versions.php");
require_once("models/llistar_edicions.php");
require_once("models/llistar_pla.php");
require_once("models/comprobar_idAmbito_defecto.php");

require_once("models/consulta_graus_estudis.php");
require_once("models/consulta_graus_centres.php");
require_once("models/consulta_graus_departaments.php");




if (isset($_SESSION['niu'])){
    $result_llistar_models = llistar_models(connection());

    $idAmbito_defecto = comprobar_idAmbito_defecto(connection(),$_SESSION['ambito_defecto']);
    $_SESSION['permiso_defecto'] = comprobar_permiso_defecto(connection(),$idAmbito_defecto[0]['idAmbitos'],$result_llistar_models[0]['Objeto_idObjeto']);
    $_SESSION['permiso_ambito'] = comprobar_permiso_ambito(connection(),$_SESSION['ambit_selec'],$result_llistar_models[0]['Objeto_idObjeto']);

    $result_llistar_versions = llistar_versions(connection());
    $result_llistar_edicions = llistar_edicions(connection());
    //$result_llistar_pla = llistar_pla(connection());


    if ($_SESSION['permiso_defecto'] == "ninguno" && $_SESSION['permiso_ambito'] == "ninguno"){
        $result_llistar_models = "";
        $result_llistar_versions = "";
        $result_llistar_edicions = "";
        $result_llistar_edicions = "";
        $result_llistar_pla = "";
        $sin_permisos = "No te permisos per visualitzar cap enquesta.";
    }else{

        switch ($_SESSION['ambit_selec']){
            case 'Estudis':
                if ($_SESSION['permiso_defecto'] == "ninguno" && $_SESSION['permiso_ambito'] != "ninguno"){
                    echo"1";
                    //Accés * als graus “corresponents” i a totes les assignatures d’aquests graus
                    //llista de graus -- tots asigs de llista
                    $_SESSION['permiso_superior'] = $_SESSION['permiso_ambito'];
                    $result_llistar_pla = consulta_graus_estudis(connection(),$_SESSION['idEnAmbito'] );
                }else{
                    if ($_SESSION['permiso_defecto'] == "basico" && $_SESSION['permiso_ambito'] == "total"){
                        echo "2";
                        //Accés BÀSIC a tots els graus i a totes les assignatures
                        //Accés TOTAL als graus “corresponents” i a totes les assignatures d’aquests graus
                        $_SESSION['lista_graus_estudis'] = consulta_graus_estudis(connection(),$_SESSION['idEnAmbito'] );
                        $result_llistar_pla = llistar_pla(connection()); //a la hora de mostrar los resultados de las encuestas
                                                                        // comprobar si la asignatura esta dentro de la otra lista
                        /*ejemplo
<?php
// Your code here!

$array2 = array(
    "e"  => "total",
    "f"  => "total",
    "g"  => "total",
    "h"  => "total",
);
$array = array(
    0  => array(
        "id" => "958",
        "nombre" => "Grau en pepe"),
    1  => array(
        "id" => "123",
        "nombre" => "Grau en jijij"),
    2  => array(
        "id" => "456",
        "nombre" => "Grau en kekek"),
    3  => array(
        "id" => "789",
        "nombre" => "Grau en bubu"),
);
foreach ($array as $arr){
    if($arr['nombre'] == "Grau en kekek")
    {
     echo "esta dentroo ";
    }
}
?>
                        */
                    }else{
                        echo "3";
                        $_SESSION['permiso_superior'] = $_SESSION['permiso_defecto'];
                        //Accés * a tots els graus i a totes les assignatures
                        //llista tota graus y totes asigs
                        $result_llistar_pla = llistar_pla(connection());
                    }
                }
                break;
            case 'Centres':
                if ($_SESSION['permiso_defecto'] == "ninguno" && $_SESSION['permiso_ambito'] != "ninguno"){
                    echo"4";
                    //Accés * als graus “corresponents” i a totes les assignatures d’aquests graus
                    //llista de graus -- tots asigs de llista
                    $_SESSION['permiso_superior'] = $_SESSION['permiso_ambito'];
                    $result_llistar_pla = consulta_graus_centres(connection(),$_SESSION['idEnAmbito'] );
                }else{
                    if ($_SESSION['permiso_defecto'] == "basico" && $_SESSION['permiso_ambito'] == "total"){
                        echo "5";
                        //Accés BÀSIC a tots els graus i a totes les assignatures
                        //Accés TOTAL als graus “corresponents” i a totes les assignatures d’aquests graus
                        //falta cambiar nombre de la sesiion a lista_graus_centres
                        $_SESSION['lista_graus_centres'] = consulta_graus_centres(connection(),$_SESSION['idEnAmbito'] );///
                        $result_llistar_pla = llistar_pla(connection()); //a la hora de mostrar los resultados de las encuestas
                        // comprobar si la asignatura esta dentro de la otra lista
                    }else{
                        echo "6";
                        $_SESSION['permiso_superior'] = $_SESSION['permiso_defecto'];
                        //Accés * a tots els graus i a totes les assignatures
                        //llista tota graus y totes asigs
                        $result_llistar_pla = llistar_pla(connection());
                    }
                }
                break;
            case 'Departaments':

                if ($_SESSION['permiso_defecto'] == "ninguno" && $_SESSION['permiso_ambito'] != "ninguno"){
                    echo"7";
                    //Accés * als graus “corresponents” i a totes les assignatures d’aquests graus
                    //llista de graus -- tots asigs de llista
                    $_SESSION['permiso_superior'] = $_SESSION['permiso_ambito'];
                    $result_llistar_pla = consulta_graus_departaments(connection(),$_SESSION['idEnAmbito'] );
                }else{
                    if ($_SESSION['permiso_defecto'] == "basico" && $_SESSION['permiso_ambito'] == "total"){
                        echo "8";
                        //Accés BÀSIC a tots els graus i a totes les assignatures
                        //Accés TOTAL als graus “corresponents” i a totes les assignatures d’aquests graus

                        //$_SESSION['lista_graus_dept'] = consulta_graus_departaments(connection(),$_SESSION['idEnAmbito']);///
                        $_SESSION['entra_dept'] = true;
                        $result_llistar_pla = llistar_pla(connection());
                    }else{
                        echo "9";
                        $_SESSION['permiso_superior'] = $_SESSION['permiso_defecto'];
                        //Accés * a tots els graus i a totes les assignatures
                        //llista tota graus y totes asigs
                        $result_llistar_pla = llistar_pla(connection());
                    }
                }
                break;
            default:
                $_SESSION['permiso_superior'] = $_SESSION['permiso_ambito'];
                $result_llistar_pla = llistar_pla(connection());
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
        $pla_estudis = $_POST['pla_estudis'];//devuelde id del estudio, 958
        array_push($_SESSION['form'], $pla_estudis);


        header("Refresh: 0; url=/silvia_visor_encuestas_v2/index.php?action=escollir_assignatura");
    } else {
        unset($_SESSION["form"]);
        if (isset($_SESSION['id_assig'])){
            unset($_SESSION["id_assig"]);
        }
        require("views/especifica_enquesta.php");
    }
}else{
    $message = "Cal iniciar sessió. Serà redirigit en pocs segons.";
    echo "<div class='alert alert-danger' role='alert'>" .$message . "</div>";
    header("Refresh:3; url=/silvia_visor_encuestas_v2/index.php?action=login");
}
