<?php
session_start();
require("models/connection.php");
require_once("models/llistar_assignatures_dept.php");
require_once("models/llistar_asigs_profes.php");
require_once("models/llistar_assignatures.php");
if (isset($_POST['id'])){

    $pla = $_POST['id'];

    if($_SESSION['ambit_selec'] == 'Departaments' || isset($_SESSION['entra_dept']))
    {
        $_SESSION['asigs_dept'] = llistar_assignatures_dept(connection(),$_SESSION['idEnAmbito'],"", "$pla");
    }
    if($_SESSION['ambit_selec'] == 'Professors' || isset($_SESSION['entra_profes']))
    {

        $_SESSION['lista_asigs_profes'] = llistar_asigs_profes(connection(),$_SESSION['niu'] ,"", $pla);
    }

    if(($_SESSION['ambit_selec'] == 'Departaments' || $_SESSION['ambit_selec'] == 'Professors') && isset($_SESSION['in'])){
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
    $html = '';

    foreach ($llista_asignatures as $assignatures){
        //var_dump($llista_asignatures);
        $html .= "<option value='".$assignatures['Assignatura']."'>".$assignatures['nombre']."</option>";
    }
    //var_dump($html);
    echo $html;
}