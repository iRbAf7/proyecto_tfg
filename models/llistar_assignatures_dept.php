<?php
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



        $graus_dept->execute($parametros);
        $graus_dept = $graus_dept->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($graus_dept);
}
