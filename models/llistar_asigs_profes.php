<?php
function llistar_asigs_profes($connection, $niu,$nomEdicio, $PlaPropietari) {
    try {
        if ($PlaPropietari == "0"){
            $asigs_profes = $connection->prepare("SELECT DISTINCT resultats.Assignatura, asignaturas.nombre 
                                        FROM resultats INNER JOIN asignaturas ON resultats.Assignatura = asignaturas.idAsignaturas
                                        INNER JOIN profesores_has_asignaturas ON profesores_has_asignaturas.asignaturas_idAsignaturas = asignaturas.idAsignaturas
                                        WHERE resultats.nomEdicio = :nomEdicio
                                        AND profesores_has_asignaturas.profesores_niu  =:niu
                                        ORDER BY asignaturas.nombre ASC

                                        ");
            $parametros = [
                'niu' => $niu,
                'nomEdicio' => $nomEdicio,
            ];
        }else{
            $asigs_profes = $connection->prepare("SELECT DISTINCT resultats.Assignatura, asignaturas.nombre 
                                        FROM resultats INNER JOIN asignaturas ON resultats.Assignatura = asignaturas.idAsignaturas
                                        INNER JOIN profesores_has_asignaturas ON profesores_has_asignaturas.asignaturas_idAsignaturas = asignaturas.idAsignaturas
                                        WHERE resultats.nomEdicio = :nomEdicio 
                                        AND resultats.PlaPropietari = :PlaPropietari 
                                        AND departamentos_has_profesores.Departamentos_idDepartamentos =:idDept
                                        ORDER BY asignaturas.nombre ASC

                                        ");
            $parametros = [
                'niu' => $niu,
                'nomEdicio' => $nomEdicio,
                'PlaPropietari' => $PlaPropietari,
            ];
        }



        $asigs_profes->execute($parametros);
        $asigs_profes = $asigs_profes->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($asigs_profes);
}
