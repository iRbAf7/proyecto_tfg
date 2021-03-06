<?php
session_start();
require_once("models/connection.php");
require_once("models/nom_assignatura.php");

require_once("models/llistar_assignatures_dept.php");
require_once("models/llistar_asigs_profes.php");

require_once("models/participacio.php");
require_once("models/participacio_total.php");
require_once("models/participacio_grup.php");
require_once("models/participacio_profe.php");

require_once("models/matriculats_total.php");
require_once("models/matriculats.php");
require_once("models/matriculats_grup.php");
require_once("models/matriculats_segons_profe.php");

require_once("models/nom_pla.php");
require_once("models/nom_model.php");
require_once("models/nom_versio.php");
require_once("models/nom_edicio.php");
require_once("models/get_anio_edicio.php");

require_once("models/grup.php");
require_once("models/grup_profes.php");
require_once("models/grups_totals.php");
require_once("models/num_grups_totals_profes.php");

require_once("models/preguntes.php");
require_once("models/asignatura_unica.php");

require_once("models/obert_tot.php");
require_once("models/obert_tot_profes.php");
require_once("models/niu_existent.php");
require_once("models/comprobar_asig_en_estudio.php");
require_once("models/comprobar_asig_en_centro.php");

require_once("models/profe_dept_asig.php");
//session_start();
if (isset($_SESSION['niu']) ) {

    if($_SESSION['permiso_defecto'] == "ninguno" && $_SESSION['permiso_ambito'] == "ninguno") {

        $sin_permisos = "No te permisos per visualitzar cap enquesta.";
        require("views/consultar_resultats.php");
        //echo "<div class='alert alert-danger' role='alert'>" . $message . "</div>";
        header("Refresh:4; url=/silvia_visor_encuestas_v2_1/index.php?action=especifica_enquesta");

    } else {

        if (isset($_GET['as']))
        {

            $versio = $_GET['ve'];
            $edicio = $_GET['ed'];
            $pla = $_GET['pla'];
            $assignatura = $_GET['as'];

            /**
             * Comprobaar si la asignatura solo
             * existe en un unico estudio
             */
            if ($pla == '0'){
                $asig_unico = asignatura_unica(connection(),$assignatura);
                if (sizeof($asig_unico) == 1){
                    $pla = $asig_unico[0]['Estudios_idEstudios'];
                }
            }

            $nom_pla = nom_pla(connection(), "$pla");
            $nom_edicio = nom_edicio(connection(), "$edicio");
            $nom_assigantura = nom_assignatura(connection(), "$assignatura");
            $preguntes = preguntes(connection(), "$versio");
            $anio_edicio = get_anio_edicio(connection(), "$edicio");

            if (isset($_POST['grup'])) {
                $grup = $_POST['grup'];
            }
            switch ($_SESSION['ambit_selec']){
                case 'Estudis':
                    if (isset($_SESSION['lista_graus_estudis'])) {//sirve en el caso de Estudis, y basico-total
                        //coomprobar si la asgignatura pertenece al estudio
                        //$pertenece = comprobar_asig_en_estudio(connection(), $_SESSION['lista_graus_estudis'][0]['idEstudio'], $assignatura);
                        //$count = intval($pertenece['count(1)']);
                        var_dump($_SESSION['lista_graus_estudis']);
                        if ($pla == $_SESSION['lista_graus_estudis'][0]['idEstudio']){
                            $count = 1;
                        }else{
                            $count = 0;
                        }
                    }
                   // if ($_SESSION['permiso_defecto'] == "ninguno" && $_SESSION['permiso_ambito'] != "ninguno"){
                        if (isset($grup)){
                            $llistat_respostes10 = obert_tot(connection(), "AssigG10", "$edicio", $pla,"$assignatura", $grup);
                            $llistat_respostes11 = obert_tot(connection(), "AssigG11", "$edicio", $pla,"$assignatura",$grup);
                        }else{
                            $llistat_respostes10 = obert_tot(connection(), "AssigG10", "$edicio", $pla,"$assignatura", "Tots");
                            $llistat_respostes11 = obert_tot(connection(), "AssigG11", "$edicio", $pla,"$assignatura","Tots");
                        }

                        $participacio = participacio(connection(), "$edicio", "$pla", "$assignatura");
                        $matriculats = matriculats(connection(), $anio_edicio[0]['anio_inicio'], "$edicio", "$pla", "$assignatura");
                        $llista_grups = grups(connection(), "$edicio", "$pla", "$assignatura");

                    break;
                case 'Centres':
                    if (isset($_SESSION['lista_graus_centres'])) {//sirve en el caso de Centres, y basico-total
                        $count = 0;
                        for ($i = 0; $i < sizeof($_SESSION['lista_graus_centres']); $i++) {
                            $pertenece = comprobar_asig_en_centro(connection(), $_SESSION['lista_graus_centres'][$i]['idEstudio'], $assignatura);
                            $count = $count + intval($pertenece['count(1)']);
                        }
                    }
                    if (isset($grup)){
                        $llistat_respostes10 = obert_tot(connection(), "AssigG10", "$edicio", "$pla","$assignatura", $grup);
                        $llistat_respostes11 = obert_tot(connection(), "AssigG11", "$edicio", "$pla","$assignatura",$grup);
                    }else{
                        $llistat_respostes10 = obert_tot(connection(), "AssigG10", "$edicio", "$pla","$assignatura", "Tots");
                        $llistat_respostes11 = obert_tot(connection(), "AssigG11", "$edicio", "$pla","$assignatura","Tots");
                    }


                    $participacio = participacio(connection(), "$edicio", "$pla", "$assignatura");
                    $matriculats = matriculats(connection(), $anio_edicio[0]['anio_inicio'], "$edicio", "$pla", "$assignatura");
                    $llista_grups = grups(connection(), "$edicio", "$pla", "$assignatura");

                    /*if ($_SESSION['permiso_defecto'] == "ninguno" && $_SESSION['permiso_ambito'] != "ninguno"){
                    }else{
                        if ($_SESSION['permiso_defecto'] == "basico" && $_SESSION['permiso_ambito'] == "total"){
                        }else{
                        }
                    }*/
                    break;
                case 'Departaments':
                    if($_SESSION['ambit_selec'] == 'Departaments' || isset($_SESSION['entra_dept']))
                    {
                        $_SESSION['asigs_dept'] = llistar_assignatures_dept(connection(),$_SESSION['idEnAmbito'],"$edicio", "$pla");

                    }

                    if (!empty($_SESSION['asigs_dept'])) {//antes eestaba dentro del if de:   if (sizeof($llista_grups) > 1) {

                        $count = 0;

                        for ($i = 0; $i < sizeof($_SESSION['asigs_dept']); $i++) {
                            if ($_SESSION['asigs_dept'][$i]['Assignatura'] == $assignatura) {
                                $count++;
                            }
                        }

                    }else{
                        $count = 0;
                    }

                    if ($_SESSION['permiso_defecto'] == "ninguno" && $_SESSION['permiso_ambito'] != "ninguno"){
                        $profe_dept = profe_dept_asig(connection(),$_SESSION['idEnAmbito'],"$edicio",$pla);
                        if (!empty($profe_dept)){
                            $profe_dept = $profe_dept[0]['Profesores_niu'];
                        }
                        if (isset($grup)){
                            $llistat_respostes10 = obert_tot_profes(connection(), $anio_edicio[0]['anio_inicio'],"AssigG10",$profe_dept
                                ,$pla, "$edicio", "$assignatura", $grup);
                            $llistat_respostes11 = obert_tot_profes(connection(), $anio_edicio[0]['anio_inicio'],"AssigG11", $profe_dept
                                ,$pla, "$edicio", "$assignatura", $grup);
                        }else{
                            $llistat_respostes10 = obert_tot_profes(connection(), $anio_edicio[0]['anio_inicio'],"AssigG10",$profe_dept
                                ,$pla, "$edicio", "$assignatura", "Tots");
                            $llistat_respostes11 = obert_tot_profes(connection(), $anio_edicio[0]['anio_inicio'],"AssigG11", $profe_dept
                                ,$pla, "$edicio", "$assignatura", "Tots");
                        }


                        $llista_grups = grup_profes(connection(),$anio_edicio[0]['anio_inicio'], "$edicio",
                            $profe_dept, "$pla", "$assignatura");

                        $n_grups_totals = num_grups_totals_profes(connection(), $anio_edicio[0]['anio_inicio'],
                            "$edicio", "$pla", "$assignatura");

                        if (sizeof($llista_grups) > 1) {
                            $participacio = participacio_profe(connection(),$anio_edicio[0]['anio_inicio'], "$edicio",
                                $profe_dept, "$pla", "$assignatura");
                            $matriculats = matriculats_segons_profe(connection(), $anio_edicio[0]['anio_inicio'], "$edicio",
                                "$pla",$profe_dept, "$assignatura");
                        }
                    }
                    else{

                        if ($_SESSION['permiso_defecto'] == "basico" && $_SESSION['permiso_ambito'] == "total"){
                            if ($count > 0){

                                $profe_dept = profe_dept_asig(connection(),$_SESSION['idEnAmbito'],"$edicio",$pla);
                                if (!empty($profe_dept)){
                                    $profe_dept = $profe_dept[0]['Profesores_niu'];
                                }

                                $mi_lista_grups = grup_profes(connection(),$anio_edicio[0]['anio_inicio'], "$edicio",
                                 $profe_dept, "$pla", "$assignatura");
                            }

                            $n_grups_totals = num_grups_totals_profes(connection(), $anio_edicio[0]['anio_inicio'],"$edicio",
                                "$pla", "$assignatura");
                            //$mi_lista_grups = grup_profes(connection(),$anio_edicio[0]['anio_inicio'], "$edicio",
                              //  $profe_dept, "$pla", "$assignatura");

                        }
                        /***
                         * En las dos consultas de abajo no hace falta pasar como parammetro el a??o de la edicion
                         * ya que solo utiliza la tabla de resultats
                         ***/
                        if (isset($grup)){

                            $llistat_respostes10 = obert_tot(connection(), "AssigG10", "$edicio", "$pla","$assignatura", $grup);
                            $llistat_respostes11 = obert_tot(connection(), "AssigG11", "$edicio", "$pla","$assignatura",$grup);

                        }else{
                            $llistat_respostes10 = obert_tot(connection(), "AssigG10", "$edicio", "$pla","$assignatura", "Tots");
                            $llistat_respostes11 = obert_tot(connection(), "AssigG11", "$edicio", "$pla","$assignatura","Tots");
                        }

                        if ($pla != 0) {
                            $participacio = participacio(connection(), "$edicio", "$pla", "$assignatura");
                            $matriculats = matriculats(connection(), $anio_edicio[0]['anio_inicio'], "$edicio", "$pla", "$assignatura");
                            $llista_grups = grups(connection(), "$edicio", "$pla", "$assignatura");

                        } else {
                            $participacio = participacio_total(connection(), "$edicio", "$assignatura");
                            $matriculats = matriculats_total(connection(), $anio_edicio[0]['anio_inicio'], "$edicio", "$assignatura");
                            $llista_grups = grups_totals(connection(), "$edicio", "$assignatura");
                        }
                    }
                    break;
                case 'Professors':
                    if($_SESSION['ambit_selec'] == 'Professors' || isset($_SESSION['entra_profes']))//added
                    {
                        $_SESSION['lista_asigs_profes'] = llistar_asigs_profes(connection(),$_SESSION['niu'] ,"$edicio", "$pla");

                    }
                    if (!empty($_SESSION['lista_asigs_profes'])){
                        if ($_SESSION['ambit_selec'] == 'Professors' ){//professors
                            $count = 0;
                            for ($i = 0; $i < sizeof($_SESSION['lista_asigs_profes']); $i++) {
                                if ($_SESSION['lista_asigs_profes'][$i]['Assignatura'] == $assignatura) {
                                    $count++;
                                }
                            }
                        }

                    }else{
                        $count = 0;

                    }


                    if ($_SESSION['permiso_defecto'] == "ninguno" && $_SESSION['permiso_ambito'] != "ninguno"){

                        if (isset($grup)){
                            $llistat_respostes10 = obert_tot_profes(connection(), $anio_edicio[0]['anio_inicio'],"AssigG10",$_SESSION['niu']
                                ,$pla, "$edicio", "$assignatura", $grup);
                            $llistat_respostes11 = obert_tot_profes(connection(), $anio_edicio[0]['anio_inicio'],"AssigG11", $_SESSION['niu']
                                ,$pla, "$edicio", "$assignatura", $grup);
                        }else{
                            $llistat_respostes10 = obert_tot_profes(connection(), $anio_edicio[0]['anio_inicio'],"AssigG10",$_SESSION['niu']
                                ,$pla, "$edicio", "$assignatura", "Tots");
                            $llistat_respostes11 = obert_tot_profes(connection(), $anio_edicio[0]['anio_inicio'],"AssigG11", $_SESSION['niu']
                                ,$pla, "$edicio", "$assignatura", "Tots");
                        }

                        $llista_grups = grup_profes(connection(),$anio_edicio[0]['anio_inicio'], "$edicio",
                            $_SESSION['niu'], "$pla", "$assignatura");

                        $n_grups_totals = num_grups_totals_profes(connection(), $anio_edicio[0]['anio_inicio'],
                            "$edicio", "$pla", "$assignatura");
                        /***
                         * Si el profesor que accede tiene solo un grupo no es necesario comprobar los matriculados
                         * ni la participacion ya que mas abajo se realiza la consulta ya que solo tiene un grupo
                         */
                        if (sizeof($llista_grups) > 1) {
                            $participacio = participacio_profe(connection(),$anio_edicio[0]['anio_inicio'], "$edicio",
                                $_SESSION['niu'], "$pla", "$assignatura");
                            $matriculats = matriculats_segons_profe(connection(), $anio_edicio[0]['anio_inicio'], "$edicio",
                                "$pla", $_SESSION['niu'], "$assignatura");
                        }
                    }else{
                        if ($_SESSION['permiso_defecto'] == "basico" && $_SESSION['permiso_ambito'] == "total"){
                            $n_grups_totals = num_grups_totals_profes(connection(), $anio_edicio[0]['anio_inicio'],"$edicio", "$pla", "$assignatura");

                            if ($count > 0){
                                $mi_lista_grups = grup_profes(connection(),$anio_edicio[0]['anio_inicio'], "$edicio",
                                    $_SESSION['niu'], "$pla", "$assignatura");

                            }//else{//esto esta a??adido
                                //$llista_grups = grups(connection(), "$edicio", "$pla", "$assignatura");
                            //}

                        }
                            /***
                             * En las dos consultas de abajo no hace falta pasar como parammetro el a??o de la edicion
                             * ya que solo utiliza la tabla de resultats
                             ***/
                            if (isset($grup)){
                                $llistat_respostes10 = obert_tot(connection(), "AssigG10", "$edicio", "$pla","$assignatura", $grup);
                                $llistat_respostes11 = obert_tot(connection(), "AssigG11", "$edicio", "$pla","$assignatura",$grup);
                            }else{
                                $llistat_respostes10 = obert_tot(connection(), "AssigG10", "$edicio", "$pla","$assignatura", "Tots");
                                $llistat_respostes11 = obert_tot(connection(), "AssigG11", "$edicio", "$pla","$assignatura","Tots");
                            }
                            if ($pla != 0) {
                                $participacio = participacio(connection(), "$edicio", "$pla", "$assignatura");
                                $matriculats = matriculats(connection(), $anio_edicio[0]['anio_inicio'], "$edicio", "$pla", "$assignatura");
                                $llista_grups = grups(connection(), "$edicio", "$pla", "$assignatura");
                            } else {
                                $participacio = participacio_total(connection(), "$edicio", "$assignatura");
                                $matriculats = matriculats_total(connection(), $anio_edicio[0]['anio_inicio'], "$edicio", "$assignatura");
                                $llista_grups = grups_totals(connection(), "$edicio", "$assignatura");
                            }


                    }
                    break;
                default://universitat y estudiants
                    if (isset($grup)){
                        $llistat_respostes10 = obert_tot(connection(), "AssigG10", "$edicio", "$pla","$assignatura", $grup);
                        $llistat_respostes11 = obert_tot(connection(), "AssigG11", "$edicio", "$pla","$assignatura",$grup);
                    }else{
                        $llistat_respostes10 = obert_tot(connection(), "AssigG10", "$edicio", "$pla","$assignatura", "Tots");
                        $llistat_respostes11 = obert_tot(connection(), "AssigG11", "$edicio", "$pla","$assignatura","Tots");
                    }

                    if ($pla != 0) {
                        $participacio = participacio(connection(), "$edicio", "$pla", "$assignatura");
                        $matriculats = matriculats(connection(), $anio_edicio[0]['anio_inicio'], "$edicio", "$pla", "$assignatura");
                        $llista_grups = grups(connection(), "$edicio", "$pla", "$assignatura");
                    } else {
                        $participacio = participacio_total(connection(), "$edicio", "$assignatura");
                        $matriculats = matriculats_total(connection(), $anio_edicio[0]['anio_inicio'], "$edicio", "$assignatura");
                        $llista_grups = grups_totals(connection(), "$edicio", "$assignatura");
                    }
                    break;
            }


            if (sizeof($llista_grups) > 1) {

                if (isset($_SESSION['in']) && ($_SESSION['ambit_selec'] == "Professors" || $_SESSION['ambit_selec'] == "Departaments"))//isset($n_grups_totals))
                {
                    if ($n_grups_totals[0]['num'] == sizeof($llista_grups))
                    {//entra si se imparte en todos los grupos de la asignatura

                        if ($_SESSION['ambit_selec'] == "Professors" ){
                            $tmp = false;
                            $grup = "Tots";
                            $_SESSION['grup'] = NULL;
                            if (isset($_POST['grup'])) {
                                $grup = $_POST['grup'];
                                if ($grup == "Tots") {
                                    $_SESSION['grup'] = NULL;
                                } else {
                                    $_SESSION['grup'] = $grup;
                                }
                            }
                        }else{
                            $tmp = false;
                            $grup = "Tots els seus";
                            $_SESSION['grup'] = NULL;
                            if (isset($_POST['grup'])) {
                                $grup = $_POST['grup'];
                                if ($grup == "Tots els seus") {
                                    $_SESSION['grup'] = NULL;
                                } else {
                                    $_SESSION['grup'] = $grup;
                                }
                            }
                        }
                    }else{
                        if ($_SESSION['ambit_selec'] == "Professors" ){
                            var_dump("hhhh");
                            $tmp = true;//estaba true/////////////////////////////////////////////////////////////////////////////////////////
                            $grup = "Tots els meus";//tots els meus
                            $_SESSION['grup'] = NULL;
                            if (isset($_POST['grup'])) {
                                $grup = $_POST['grup'];
                                if ($grup == "Tots els meus") {//tots els meus
                                    $_SESSION['grup'] = NULL;
                                } else {
                                    $_SESSION['grup'] = $grup;
                                }
                            }
                        }else{

                            $tmp = true;
                            $grup = "Tots el seus";
                            $_SESSION['grup'] = NULL;
                            if (isset($_POST['grup'])) {
                                $grup = $_POST['grup'];
                                if ($grup == "Tots els seus") {
                                    $_SESSION['grup'] = NULL;
                                } else {
                                    $_SESSION['grup'] = $grup;
                                }
                            }
                        }

                    }
                }
                else{
                    //caso de basico-total, o todos los demas///////////////////////////////////////////////////////////////////////////
                    //$n_grups_totals[0]['num'] == sizeof($llista_grups))
                    //var_dump($n_grups_totals[0]['num']);
                    //var_dump(sizeof($mi_lista_grups));

                    if ($_SESSION['ambit_selec'] == "Professors" ){

                        if(isset($mi_lista_grups)){
                            if ($n_grups_totals[0]['num'] == sizeof($mi_lista_grups)){
                                $tmp = false;
                                $grup = "Tots";
                                $_SESSION['grup'] = NULL;
                                if (isset($_POST['grup'])) {
                                    $grup = $_POST['grup'];
                                    if ($grup == "Tots") {
                                        $_SESSION['grup'] = NULL;
                                    } else {
                                        $_SESSION['grup'] = $grup;
                                    }
                                }
                            }else{
                                $tmp = true;
                                $grup = "Tots";//$grup = "Tots els meus";
                                $_SESSION['grup'] = NULL;
                                if (isset($_POST['grup'])) {
                                    $grup = $_POST['grup'];
                                    if ($grup == "Tots") { //"Tots els meus"
                                        $_SESSION['grup'] = NULL;
                                    } else {
                                        $_SESSION['grup'] = $grup;
                                    }
                                }
                            }
                        }else{
                            $tmp = false;
                            $grup = "Tots";
                            $_SESSION['grup'] = NULL;
                            if (isset($_POST['grup'])) {
                                $grup = $_POST['grup'];
                                if ($grup == "Tots") {
                                    $_SESSION['grup'] = NULL;
                                } else {
                                    $_SESSION['grup'] = $grup;
                                }
                            }
                        }





                    }else{
                        if(isset($_SESSION['asigs_dept'])){//ambito == departaments

                            if ($count > 0){//entra si la asig pertenece a un profe del Dept

                                if (!isset($_SESSION['in']) && !isset($_SESSION['entra_dept'])){
                                    //este if lo he a??adido porque en el caso de total-NBT se viera Tots, en vez de Tots els seus
                                    $tmp = false;
                                    $grup = "Tots";
                                    $_SESSION['grup'] = NULL;
                                    if (isset($_POST['grup'])) {
                                        $grup = $_POST['grup'];
                                        if ($grup == "Tots") {
                                            $_SESSION['grup'] = NULL;
                                        } else {
                                            $_SESSION['grup'] = $grup;
                                        }
                                    }
                                }else{
                                    $tmp = true;
                                    $grup = "Tots els seus";
                                    $_SESSION['grup'] = NULL;
                                    if (isset($_POST['grup'])) {
                                        $grup = $_POST['grup'];
                                        if ($grup == "Tots els seus") {
                                            $_SESSION['grup'] = NULL;
                                        } else {
                                            $_SESSION['grup'] = $grup;
                                        }
                                    }
                                }

                            }else{
                                $tmp = false;
                                $grup = "Tots";
                                $_SESSION['grup'] = NULL;
                                if (isset($_POST['grup'])) {
                                    $grup = $_POST['grup'];
                                    if ($grup == "Tots") {
                                        $_SESSION['grup'] = NULL;
                                    } else {
                                        $_SESSION['grup'] = $grup;
                                    }
                                }
                            }
                        }else{//otros Ambitos
                            $tmp = false;
                            $grup = "Tots";
                            $_SESSION['grup'] = NULL;
                            if (isset($_POST['grup'])) {
                                $grup = $_POST['grup'];
                                if ($grup == "Tots") {
                                    $_SESSION['grup'] = NULL;
                                } else {
                                    $_SESSION['grup'] = $grup;
                                }
                            }
                        }

                    }

                }
            }else{
                //se ha comentado esta parte, se ha de solo ver un grupo cuando solo existe 1 grupo
                //if (isset($_SESSION['in'])){
                    //solo muestra que hay un grupo cuando permiso_def=ninguno y per_ambito=basico/total
                    $tmp = true;
                    $grup = $llista_grups[0][0];
                    $_SESSION['grup'] = $grup;
               /* }else{

                    $tmp = false;
                    $grup = "Tots";
                    $_SESSION['grup'] = NULL;
                    if (isset($_POST['grup'])) {
                        $grup = $_POST['grup'];
                        if ($grup == "Tots") {
                            $_SESSION['grup'] = NULL;
                        } else {
                            $_SESSION['grup'] = $grup;
                        }
                    }
                }*/

            }

            if ($_SESSION['grup'] != NULL) {
                $matriculats = matriculats_grup(connection(), "$assignatura", $anio_edicio[0]['anio_inicio'],
                    "$grup");
                $participacio = participacio_grup(connection(), "$edicio", "$assignatura", "$grup");
            }


            if ($matriculats[0][0] != NULL) {
                $percentParticipacio = round(($participacio[0][0] / $matriculats[0][0]) * 100);
                $percentParticipacio = $percentParticipacio . "%";
            } else {
                $matriculats[0][0] = "Dada no disponible";
                $percentParticipacio = "Dada no disponible";
            }

            /**
             * Se comprueba que la asignatura que se va a mostrar es una asignatura de las que imparte
             * Si el contador es mayor que 0 se comprueba si el grupo que se muestra le pertenece
             * */
            if (   (isset($_SESSION['entra_profes']) || isset($_SESSION['in']) || isset($_SESSION['entra_dept'])   )
                && ($_SESSION['ambit_selec'] == 'Professors' || $_SESSION['ambit_selec'] == 'Departaments')){
                //isset($_SESSION['lista_asigs_profes'])) {

                /*if ($_SESSION['ambit_selec'] == 'Professors' ){//professors
                    $count = 0;
                    for ($i = 0; $i < sizeof($_SESSION['lista_asigs_profes']); $i++) {
                        if ($_SESSION['lista_asigs_profes'][$i]['Assignatura'] == $assignatura) {
                            $count++;
                        }
                    }
                }*/
                //else{//departaments
                    //aqui se comprueba si el grupo q se muestra la imparte el profe del departamento
                    /*if (isset($_SESSION['asigs_dept'])) {
                        $count = 0;
                        for ($i = 0; $i < sizeof($_SESSION['asigs_dept']); $i++) {
                            if ($_SESSION['asigs_dept'][$i]['Assignatura'] == $assignatura) {
                                $count++;
                            }
                        }
                    }*/
               // }

                if ($count > 0){
                    if ($_SESSION['ambit_selec'] == 'Professors'){
                        $mis_grupos = grup_profes(connection(),$anio_edicio[0]['anio_inicio'], "$edicio",$_SESSION['niu'], "$pla", "$assignatura");
                        if ($grup == "Tots" || $grup == "Tots els meus") {// el OR de Tots els meus a??adido
                            if ($n_grups_totals[0]['num'] == sizeof($mis_grupos))
                            {

                                $count = 1;
                            }else{
                                if (isset($_SESSION['in'])){
                                    $count = 1;
                                }else{
                                    $count = 0;
                                }

                            }
                        } else {
                            $i =0;
                            $trobat = false;
                            while ($i<sizeof($mis_grupos) && !$trobat)
                            {
                                if ($grup == $mis_grupos[$i][0])
                                {
                                    $trobat = true;
                                    $count = 1;
                                }
                                $i++;
                            }
                            if (!$trobat){
                                $count=0;
                            }
                        }
                    }else{
                        $mis_grupos = grup_profes(connection(),$anio_edicio[0]['anio_inicio'], "$edicio",$profe_dept, "$pla",
                            "$assignatura");
                        if ($grup == "Tots els seus") {
                            if ($n_grups_totals[0]['num'] == sizeof($mis_grupos))
                            {
                                $count = 1;
                            }else{

                                $count = 0;
                            }

                        } else {
                            $i =0;
                            $trobat = false;
                            while ($i<sizeof($mis_grupos) && !$trobat)
                            {
                                if ($grup == $mis_grupos[$i][0])
                                {
                                    $trobat = true;
                                    $count = 1;
                                }
                                $i++;
                            }
                            if (!$trobat){
                                $count=0;
                            }
                        }
                    }

                }else{
                    $count = 0;
                }

            }

            require("views/consultar_resultats.php");
        }
        else{
            $message = "Cal especificar l'assignatura / m??dul. Ser?? redirigit en pocs segons.";
            require("views/consultar_resultats.php");
            //echo "<div class='alert alert-danger' role='alert'>" . $message . "</div>";
            header("Refresh:4; url=/silvia_visor_encuestas_v2_1/index.php?action=escollir_assignatura");
        }
    }
} else {
    $message = "Cal iniciar sessi??. Ser?? redirigit en pocs segons.";
    require("views/consultar_resultats.php");
    //echo "<div class='alert alert-danger' role='alert'>" .$message . "</div>";
    header("Refresh:3; url=/silvia_visor_encuestas_v2_1/index.php?action=login");
}