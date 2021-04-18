<?php
require_once("models/connection.php");
require_once("models/nom_assignatura.php");

require_once("models/participacio.php");
require_once("models/participacio_total.php");
require_once("models/participacio_grup.php");

require_once("models/matriculats_total.php");
require_once("models/matriculats.php");
require_once("models/matriculats_grup.php");

require_once("models/nom_pla.php");
require_once("models/nom_model.php");
require_once("models/nom_versio.php");
require_once("models/nom_edicio.php");

require_once("models/grup.php");
require_once("models/grups_totals.php");

require_once("models/preguntes.php");

require_once("models/obert_tot.php");

require_once("models/niu_existent.php");
require_once("models/comprobar_asig_en_estudio.php");
require_once("models/comprobar_asig_en_centro.php");


if (isset($_SESSION['niu'])) {

    $niu_existent = niu_existent(connection(),$_SESSION['niu']);
    $permis = $niu_existent[0];//[1];

    if(isset($_GET['as'])) {
        //se hace un header() desde controller/escollir_assignatura
        //header("Refresh: 0; url=/silvia_visor_encuestas_v2/index.php?action=res&ve=$versio&ed=$edicio&pla=$pla&as=$assignatures");
        $versio = $_GET['ve'];
        $edicio = $_GET['ed'];
        $pla = $_GET['pla'];
        $assignatura = $_GET['as'];

        if(isset($_SESSION['lista_graus_estudis'])){
            //coomprobar si la asgignatura pertenece al estudio
            $pertenece = comprobar_asig_en_estudio(connection(),$_SESSION['lista_graus_estudis'][0]['idEstudio'], $assignatura);
            $count = intval($pertenece['count(1)']);
        }
        if(isset($_SESSION['lista_graus_centres']))
        {
            $count = 0;
            for ($i =0;$i < sizeof($_SESSION['lista_graus_centres']) ;$i++) {
                $pertenece = comprobar_asig_en_centro(connection(), $_SESSION['lista_graus_centres'][$i]['idEstudio'], $assignatura);
                $count = $count + intval($pertenece['count(1)']);
            }
        }
        if(isset($_SESSION['asigs_dept']))
        {
            var_dump($_SESSION['asigs_dept']);
            $count = 0;
            for ($i =0;$i < sizeof($_SESSION['asigs_dept']) ;$i++) {
                if($_SESSION['asigs_dept'][$i]['Assignatura'] == $assignatura){
                    $count++;
                }
            }
        }

        $llistat_respostes10 = obert_tot(connection(), "AssigG10", "$edicio", "$assignatura");
        $llistat_respostes11 = obert_tot(connection(), "AssigG11", "$edicio", "$assignatura");

        $nom_pla = nom_pla(connection(), "$pla");
        $nom_edicio = nom_edicio(connection(), "$edicio");
        $nom_assigantura = nom_assignatura(connection(), "$assignatura");
        $matriculats = matriculats_total(connection(), "$assignatura");
        $preguntes = preguntes(connection(), "$versio");

        $grup = "Tots";
        $_SESSION['grup'] = NULL;
        if (isset($_POST['grup'])) {
            $grup = $_POST['grup'];
            if($grup == "Tots") {
                $_SESSION['grup'] = NULL;
            } else {
                $_SESSION['grup'] = $grup;
            }
        }

        if ($pla != 0) {
            $participacio = participacio(connection(), "$edicio", "$pla", "$assignatura");
            $matriculats = matriculats(connection(), "$edicio", "$pla", "$assignatura");
            $llista_grups = grups(connection(), "$edicio", "$pla", "$assignatura");
        } else {
            $participacio = participacio_total(connection(), "$edicio", "$assignatura");
            $matriculats = matriculats_total(connection(), "$assignatura");
            $llista_grups = grups_totals(connection(), "$edicio", "$assignatura");
        }

        if ($_SESSION['grup'] != NULL) {
            $participacio = participacio_grup(connection(), "$edicio", "$assignatura", "$grup");
            $matriculats = matriculats_grup(connection(), "$assignatura", "$grup");
        }

        if ($matriculats[0][0] != NULL) {
            $percentParticipacio = round(($participacio[0][0] / $matriculats[0][0]) * 100);
            $percentParticipacio = $percentParticipacio . "%";
        } else {
            $matriculats[0][0] = "Dada no disponible";
            $percentParticipacio = "Dada no disponible";
        }

        require("views/consultar_resultats.php");
    } else {
        $message = "Cal especificar l'assignatura / mòdul. Serà redirigit en pocs segons.";
        echo "<div class='alert alert-danger' role='alert'>" . $message . "</div>";
        header("Refresh:7; url=/silvia_visor_encuestas_v2/index.php?action=escollir_assignatura");
    }
} else {
    require("c_login.php");
}