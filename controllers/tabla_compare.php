
<?php
require_once("models/connection.php");
require_once("models/preguntes.php");
require_once("models/ediciones_de_asig.php");
require_once("models/llistar_versions.php");
require_once("models/taula_results_tots.php");
require_once("models/resultados_preg.php");
require_once("models/resultados_preg_profe.php");
require_once("models/calcul_mitjana_profe.php");
require_once("models/matriculats_segons_profe.php");
require_once("models/return_nom_asig.php");
require_once("models/return_id_pla.php");
require_once("models/taula_resultats.php");
require_once("models/matriculats.php");
require_once("models/calcul_mitjana.php");
require_once("models/participacio.php");
require_once("models/participacio_profe.php");



if (isset($_SESSION['niu']) ) {
    if(isset($_POST['assignatura'])){
        $version = llistar_versions(connection());

        $nom_asig = return_nom_asig(connection(),$_POST['assignatura']);

        $id_pla = return_id_pla(connection(), $_POST['pla']);

        $preguntes = preguntes(connection(), $version[0]['nom']);
        $ediciones = ediciones_de_asig(connection(), $_POST['assignatura']);

       // $matriculats = matriculats(connection(),$ediciones[0]['anio_inicio'],$ediciones[0]['nom'], $id_pla, $id_asignatura);


        $array_matriculats = array();
        $array_participants = array();
        $preg1 = array();
        $preg2 = array();
        $preg3 = array();
        $preg4 = array();
        $preg5 = array();
        $preg6 = array();
        $preg7 = array();
        $preg8 = array();
        $preg9 = array();



        for ($i =0; $i <sizeof($ediciones);$i++){

            if ($_SESSION['permiso_defecto'] == "ninguno" && $_SESSION['permiso_ambito'] != "ninguno"
                && $_SESSION['ambit_selec'] == "Professors"){


                $matriculats = matriculats_segons_profe(connection(),$ediciones[$i]['anio_inicio'],$ediciones[$i]['nom'],$id_pla, $_SESSION['niu'], $_POST['assignatura']);
                $n_participants = participacio_profe(connection(), $ediciones[$i]['anio_inicio'],$ediciones[$i]['nom'],$_SESSION['niu'], "$id_pla", $_POST['assignatura']);
                array_push($array_matriculats,$matriculats[0][0]);
                if ($matriculats[0][0] != NULL) {
                    $percentParticipacio = round(($n_participants[0][0] / $matriculats[0][0]) * 100);
                    $percentParticipacio = $percentParticipacio . "%";
                } else {
                    $matriculats[0][0] = "Dada no disponible";
                    $percentParticipacio = "Dada no disponible";
                }
                array_push($array_participants,$percentParticipacio);
                array_push($preg1, resultados_preg_profe(connection(), "AssigG01",
                    $_SESSION['niu'],$ediciones[$i]['anio_inicio'],$id_pla, $ediciones[$i]['nom'],$_POST['assignatura']));
                ///////////////////////////////////////////////////////////////////////
                $pregunta2 = resultados_preg_profe(connection(), "AssigG02",
                    $_SESSION['niu'],$ediciones[$i]['anio_inicio'],$id_pla, $ediciones[$i]['nom'],$_POST['assignatura']);
                $tmp = array(
                    0 => array(),
                    1 => array(),
                    2 => array(),
                    3 => array(),
                );
                $sourceName = array(
                    0 =>'Pràcticament nul·la (<25%)',
                    1 =>'Baixa (25-50%)',
                    2 => 'Relativament alta (51-75%)',
                    3 =>'Pràcticament total (>75%)'
                );
                for ($y = 0; $y < sizeof($pregunta2); $y++){
                    for ($j = 0; $j < sizeof($sourceName); $j++){
                        if($pregunta2[$y]['resposta'] == $sourceName[$j]){
                            //$tmp2 = array();
                            array_push($tmp[$j],$pregunta2[$y]['resposta']);
                            array_push($tmp[$j],$pregunta2[$y]['totalAlumnes']);
                            //array_push($tmp[$j], $tmp2);
                            //unset($tmp2);

                        }
                    }

                }
                for ($x = 0; $x < sizeof($tmp);$x++){
                    if(empty($tmp[$x])){
                        array_push($tmp[$x],$sourceName[$x]);
                        array_push($tmp[$x],'0');
                    }
                }
                array_push($preg2,$tmp);//resultados_preg(connection(), "AssigG02",$id_pla, $ediciones[$i]['nom'],$_POST['assignatura']));
                ////////////////////////////////////////////////////////////////////
                $pregunta3 = resultados_preg_profe(connection(), "AssigG03",
                    $_SESSION['niu'],$ediciones[$i]['anio_inicio'],$id_pla, $ediciones[$i]['nom'],$_POST['assignatura']);
                $tmp2 = array(
                    0 => array(),
                    1 => array(),
                    2 => array(),
                    3 => array(),
                    4 => array(),
                );
                $sourceName2 = array(
                    0 => '< 2 h',
                    1 => '2-4 h',
                    2 => '5-7 h',
                    3 => '8-10 h',
                    4 => '> 10 h'
                );
                for ($y = 0; $y < sizeof($pregunta3); $y++){
                    for ($j = 0; $j < sizeof($sourceName2); $j++){
                        if($pregunta3[$y]['resposta'] == $sourceName2[$j]){
                            array_push($tmp2[$j],$pregunta3[$y]['resposta']);
                            array_push($tmp2[$j],$pregunta3[$y]['totalAlumnes']);

                        }
                    }

                }
                for ($x = 0; $x < sizeof($tmp2);$x++){
                    if(empty($tmp2[$x])){
                        array_push($tmp2[$x],$sourceName2[$x]);
                        array_push($tmp2[$x],'0');
                    }
                }
                ////////////////////////////////////////////////////////////////////
                array_push($preg3, $tmp2);
                array_push($preg4, calcul_mitjana_profe(connection(), "AssigG04",$_SESSION['niu'],$ediciones[$i]['anio_inicio'],$ediciones[$i]['nom'],$id_pla,$_POST['assignatura'])[0]);
                array_push($preg5, calcul_mitjana_profe(connection(), "AssigG05", $_SESSION['niu'],$ediciones[$i]['anio_inicio'],$ediciones[$i]['nom'],$id_pla,$_POST['assignatura'])[0]);
                array_push($preg6, calcul_mitjana_profe(connection(), "AssigG06",$_SESSION['niu'],$ediciones[$i]['anio_inicio'], $ediciones[$i]['nom'],$id_pla,$_POST['assignatura'])[0]);
                array_push($preg7, calcul_mitjana_profe(connection(), "AssigG07",$_SESSION['niu'],$ediciones[$i]['anio_inicio'],$ediciones[$i]['nom'], $id_pla,$_POST['assignatura'])[0]);
                array_push($preg8, calcul_mitjana_profe(connection(), "AssigG08",$_SESSION['niu'],$ediciones[$i]['anio_inicio'], $ediciones[$i]['nom'],$id_pla,$_POST['assignatura'])[0]);
                array_push($preg9, calcul_mitjana_profe(connection(), "AssigG09",$_SESSION['niu'],$ediciones[$i]['anio_inicio'],$ediciones[$i]['nom'],$id_pla, $_POST['assignatura'])[0]);


            }else{

            $matriculats=matriculats(connection(),$ediciones[$i]['anio_inicio'],$ediciones[$i]['nom'],$id_pla, $_POST['assignatura']);
            //en la consulta de abajo no hace falta poner el anio de edicion ya que solo consulta la tabla resultats
            //y con la edicion ya basta
            $n_participants = participacio(connection(), $ediciones[$i]['nom'], "$id_pla", $_POST['assignatura']);
            array_push($array_matriculats,$matriculats[0][0]);
            if ($matriculats[0][0] != NULL) {
                $percentParticipacio = round(($n_participants[0][0] / $matriculats[0][0]) * 100);
                $percentParticipacio = $percentParticipacio . "%";
            } else {
                $matriculats[0][0] = "Dada no disponible";
                $percentParticipacio = "Dada no disponible";
            }
            array_push($array_participants,$percentParticipacio);
            //en la consulta de abajo no hace falta poner el anio de edicion ya que solo consulta la tabla resultats
            array_push($preg1, resultados_preg(connection(), "AssigG01",$id_pla, $ediciones[$i]['nom'],$_POST['assignatura']));
            ///////////////////////////////////////////////////////////////////////
            $pregunta2 = resultados_preg(connection(), "AssigG02",$id_pla, $ediciones[$i]['nom'],$_POST['assignatura']);
            $tmp = array(
                0 => array(),
                1 => array(),
                2 => array(),
                3 => array(),
            );
            $sourceName = array(
                0 =>'Pràcticament nul·la (<25%)',
                1 =>'Baixa (25-50%)',
                2 => 'Relativament alta (51-75%)',
                3 =>'Pràcticament total (>75%)'
            );
            for ($y = 0; $y < sizeof($pregunta2); $y++){
                for ($j = 0; $j < sizeof($sourceName); $j++){
                    if($pregunta2[$y]['resposta'] == $sourceName[$j]){
                        //$tmp2 = array();
                        array_push($tmp[$j],$pregunta2[$y]['resposta']);
                        array_push($tmp[$j],$pregunta2[$y]['totalAlumnes']);
                        //array_push($tmp[$j], $tmp2);
                        //unset($tmp2);

                    }
                }

            }
            for ($x = 0; $x < sizeof($tmp);$x++){
                if(empty($tmp[$x])){
                    array_push($tmp[$x],$sourceName[$x]);
                    array_push($tmp[$x],'0');
                }
            }
            array_push($preg2,$tmp);//resultados_preg(connection(), "AssigG02",$id_pla, $ediciones[$i]['nom'],$_POST['assignatura']));
            ////////////////////////////////////////////////////////////////////
            $pregunta3 = resultados_preg(connection(), "AssigG03", $id_pla,$ediciones[$i]['nom'],$_POST['assignatura']);
            $tmp2 = array(
                0 => array(),
                1 => array(),
                2 => array(),
                3 => array(),
                4 => array(),
            );
            $sourceName2 = array(
                0 => '< 2 h',
                1 => '2-4 h',
                2 => '5-7 h',
                3 => '8-10 h',
                4 => '> 10 h'
            );
            for ($y = 0; $y < sizeof($pregunta3); $y++){
                for ($j = 0; $j < sizeof($sourceName2); $j++){
                    if($pregunta3[$y]['resposta'] == $sourceName2[$j]){
                        array_push($tmp2[$j],$pregunta3[$y]['resposta']);
                        array_push($tmp2[$j],$pregunta3[$y]['totalAlumnes']);

                    }
                }

            }
            for ($x = 0; $x < sizeof($tmp2);$x++){
                if(empty($tmp2[$x])){
                    array_push($tmp2[$x],$sourceName2[$x]);
                    array_push($tmp2[$x],'0');
                }
            }
            ////////////////////////////////////////////////////////////////////
            array_push($preg3, $tmp2);
            array_push($preg4, calcul_mitjana(connection(), "AssigG04",$ediciones[$i]['nom'],$id_pla,$_POST['assignatura'])[0]);
            array_push($preg5, calcul_mitjana(connection(), "AssigG05", $ediciones[$i]['nom'],$id_pla,$_POST['assignatura'])[0]);
            array_push($preg6, calcul_mitjana(connection(), "AssigG06", $ediciones[$i]['nom'],$id_pla,$_POST['assignatura'])[0]);
            array_push($preg7, calcul_mitjana(connection(), "AssigG07",$ediciones[$i]['nom'], $id_pla,$_POST['assignatura'])[0]);
            array_push($preg8, calcul_mitjana(connection(), "AssigG08", $ediciones[$i]['nom'],$id_pla,$_POST['assignatura'])[0]);
            array_push($preg9, calcul_mitjana(connection(), "AssigG09",$ediciones[$i]['nom'],$id_pla, $_POST['assignatura'])[0]);
            }
        }


        for ($i =0; $i < sizeof($ediciones);$i++){
            array_push($ediciones[$i], $array_matriculats[$i]);
            array_push($ediciones[$i],$array_participants[$i]);
            array_push($ediciones[$i], $preg1[$i]);
            array_push($ediciones[$i], $preg2[$i]);//////////////////////////////////////
            array_push($ediciones[$i], $preg3[$i]);//////////////////////////////////////
            array_push($ediciones[$i], $preg4[$i]);
            array_push($ediciones[$i], $preg5[$i]);
            array_push($ediciones[$i], $preg6[$i]);
            array_push($ediciones[$i], $preg7[$i]);
            array_push($ediciones[$i], $preg8[$i]);
            array_push($ediciones[$i], $preg9[$i]);
        }

    }
    require("views/tabla_compare.php");
} else {
    $message = "Cal iniciar sessió. Serà redirigit en pocs segons.";
    echo "<div class='alert alert-danger' role='alert'>" .$message . "</div>";
    header("Refresh:3; url=/silvia_visor_encuestas_v2_1/index.php?action=login");
}
