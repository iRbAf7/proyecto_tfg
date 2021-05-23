<?php
session_start();
function connection() {
    $server = "localhost"; $user = "root"; $password = "12345"; $database = "permisos_encuestas";
    $connection = new PDO("mysql:host=$server;dbname=$database;charset=UTF8", $user, $password);
    try{
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
    return($connection);
}
function llistar_assignatures_dept($connection, $idDept,$nomEdicio, $PlaPropietari) {
    try {
        if ($PlaPropietari == "0"){
            $graus_dept = $connection->prepare("SELECT DISTINCT resultats.Assignatura, asignaturas.nombre 
                                        FROM resultats INNER JOIN asignaturas ON resultats.Assignatura = asignaturas.idAsignaturas
                                        INNER JOIN profesores_has_asignaturas ON profesores_has_asignaturas.asignaturas_idAsignaturas = asignaturas.idAsignaturas
                                        INNER JOIN profesores ON profesores.niu = profesores_has_asignaturas.profesores_niu 
                                        INNER JOIN departamentos_has_profesores ON departamentos_has_profesores.Profesores_niu = profesores.niu
                                        WHERE resultats.nomEdicio = :nomEdicio
                                        AND departamentos_has_profesores.Departamentos_idDepartamentos =:idDept
                                        ORDER BY asignaturas.nombre ASC
                                        ");
            $parametros = [
                'idDept' => $idDept,
                'nomEdicio' => $nomEdicio,
            ];
        }else{
            if($nomEdicio == ""){
                $graus_dept = $connection->prepare("SELECT DISTINCT resultats.Assignatura, asignaturas.nombre 
                                        FROM resultats INNER JOIN asignaturas ON resultats.Assignatura = asignaturas.idAsignaturas
                                        INNER JOIN profesores_has_asignaturas ON profesores_has_asignaturas.asignaturas_idAsignaturas = asignaturas.idAsignaturas
                                        INNER JOIN profesores ON profesores.niu = profesores_has_asignaturas.profesores_niu 
                                        INNER JOIN departamentos_has_profesores ON departamentos_has_profesores.Profesores_niu = profesores.niu
                                        AND resultats.PlaPropietari = :PlaPropietari 
                                        AND departamentos_has_profesores.Departamentos_idDepartamentos =:idDept
                                        ORDER BY asignaturas.nombre ASC
                                        ");
                $parametros = [
                    'idDept' => $idDept,
                    'PlaPropietari' => $PlaPropietari,
                ];
            }else {
                $graus_dept = $connection->prepare("SELECT DISTINCT resultats.Assignatura, asignaturas.nombre 
                                        FROM resultats INNER JOIN asignaturas ON resultats.Assignatura = asignaturas.idAsignaturas
                                        INNER JOIN profesores_has_asignaturas ON profesores_has_asignaturas.asignaturas_idAsignaturas = asignaturas.idAsignaturas
                                        INNER JOIN profesores ON profesores.niu = profesores_has_asignaturas.profesores_niu 
                                        INNER JOIN departamentos_has_profesores ON departamentos_has_profesores.Profesores_niu = profesores.niu
                                        WHERE resultats.nomEdicio = :nomEdicio 
                                        AND resultats.PlaPropietari = :PlaPropietari 
                                        AND departamentos_has_profesores.Departamentos_idDepartamentos =:idDept
                                        ORDER BY asignaturas.nombre ASC

                                        ");
                $parametros = [
                    'idDept' => $idDept,
                    'nomEdicio' => $nomEdicio,
                    'PlaPropietari' => $PlaPropietari,
                ];
            }
        }



        $graus_dept->execute($parametros);
        $graus_dept = $graus_dept->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($graus_dept);
}
function llistar_asigs_profes($connection, $niu,$nomEdicio, $PlaPropietari) {
    try {
        if ($PlaPropietari == "0"){
            $asigs_profes = $connection->prepare("SELECT DISTINCT resultats.Assignatura, asignaturas.nombre 
                                        FROM resultats INNER JOIN asignaturas ON resultats.Assignatura = asignaturas.idAsignaturas
                                        INNER JOIN profesores_has_asignaturas ON profesores_has_asignaturas.asignaturas_idAsignaturas = asignaturas.idAsignaturas
                                        INNER JOIN anio ON anio.inicio = profesores_has_asignaturas.anio_inicio 
                                        WHERE resultats.nomEdicio = :nomEdicio
                                        AND profesores_has_asignaturas.profesores_niu  =:niu
                                        ORDER BY asignaturas.nombre ASC
                                        ");
            $parametros = [
                'niu' => $niu,
                'nomEdicio' => $nomEdicio,
            ];
        }else{
            if($nomEdicio ==""){
                $asigs_profes = $connection->prepare("SELECT DISTINCT resultats.Assignatura, asignaturas.nombre 
                                        FROM resultats INNER JOIN asignaturas ON resultats.Assignatura = asignaturas.idAsignaturas
                                        INNER JOIN profesores_has_asignaturas ON profesores_has_asignaturas.asignaturas_idAsignaturas = asignaturas.idAsignaturas
                                        INNER JOIN anio ON anio.inicio = profesores_has_asignaturas.anio_inicio
                                        AND resultats.PlaPropietari = :PlaPropietari 
                                        AND profesores_has_asignaturas.profesores_niu  =:niu
                                        ORDER BY asignaturas.nombre ASC

                                        ");
                $parametros = [
                    'niu' => $niu,
                    'PlaPropietari' => $PlaPropietari,
                ];
            }else {
                $asigs_profes = $connection->prepare("SELECT DISTINCT resultats.Assignatura, asignaturas.nombre 
                                        FROM resultats INNER JOIN asignaturas ON resultats.Assignatura = asignaturas.idAsignaturas
                                        INNER JOIN profesores_has_asignaturas ON profesores_has_asignaturas.asignaturas_idAsignaturas = asignaturas.idAsignaturas
                                        INNER JOIN anio ON anio.inicio = profesores_has_asignaturas.anio_inicio
                                        WHERE resultats.nomEdicio = :nomEdicio 
                                        AND resultats.PlaPropietari = :PlaPropietari 
                                        AND profesores_has_asignaturas.profesores_niu  =:niu
                                        ORDER BY asignaturas.nombre ASC

                                        ");
                $parametros = [
                    'niu' => $niu,
                    'nomEdicio' => $nomEdicio,
                    'PlaPropietari' => $PlaPropietari,
                ];
            }
        }



        $asigs_profes->execute($parametros);
        $asigs_profes = $asigs_profes->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($asigs_profes);
}
function llistar_assignatures($connection, $nomEdicio, $PlaPropietari) {
    try {
        if ($PlaPropietari != "0"){
            if ($nomEdicio == ""){
                $query = $connection->prepare("SELECT DISTINCT resultats.Assignatura, asignaturas.nombre 
                                        FROM asignaturas INNER JOIN resultats ON resultats.Assignatura = asignaturas.idAsignaturas
                                        AND resultats.PlaPropietari = :PlaPropietari 
                                        ORDER BY asignaturas.nombre ASC");
                $parameters = [
                    'PlaPropietari' => $PlaPropietari,
                ];
            }else {
                $query = $connection->prepare("SELECT DISTINCT resultats.Assignatura, asignaturas.nombre 
                                        FROM asignaturas INNER JOIN resultats ON resultats.Assignatura = asignaturas.idAsignaturas
                                        WHERE resultats.nomEdicio = :nomEdicio 
                                        AND resultats.PlaPropietari = :PlaPropietari 
                                        ORDER BY asignaturas.nombre ASC");
                $parameters = [
                    'nomEdicio' => $nomEdicio,
                    'PlaPropietari' => $PlaPropietari,
                ];
            }
        }else{
            $query = $connection->prepare("SELECT DISTINCT resultats.Assignatura, asignaturas.nombre 
                                        FROM asignaturas INNER JOIN resultats ON resultats.Assignatura = asignaturas.idAsignaturas 
                                        WHERE resultats.nomEdicio = :nomEdicio 
                                        ORDER BY asignaturas.nombre ASC");
            $parameters = [
                'nomEdicio' => $nomEdicio,
            ];
        }
        $query->execute($parameters);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($results);
}

if (isset($_POST['id'])){
    //require("models/connection.php");
    //require_once("models/llistar_assignatures_dept.php");
    //require_once("models/llistar_asigs_profes.php");
    //require_once("models/llistar_assignatures.php");
    $pla = $_POST['id'];
    var_dump($pla);
    if($_SESSION['ambit_selec'] == 'Departaments' || isset($_SESSION['entra_dept']))
    {
        $_SESSION['asigs_dept'] = llistar_assignatures_dept(connection(),$_SESSION['idEnAmbito'],"", "$pla");
    }
    if($_SESSION['ambit_selec'] == 'Professors' || isset($_SESSION['entra_profes']))
    {
        $_SESSION['lista_asigs_profes'] = llistar_asigs_profes(connection(),$_SESSION['niu'] ,"", "$pla");

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
        $html .= "<option value='".$assignatures['Assignatura']."'>".$assignatures['nombre']."</option>";
    }
    //var_dump($html);
    echo $html;
}