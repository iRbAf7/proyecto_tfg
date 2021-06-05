<?php
function obert_tot_profes($connection, $anio,$AssigGXX, $niu,$pla,$nomEdicio, $Assignatura) {
    try {
        $query = $connection->prepare("
                            SELECT DISTINCT resultats.$AssigGXX AS '0'
FROM resultats INNER JOIN grupo_has_asignaturas
	ON resultats.Grup = grupo_has_asignaturas.Grupo_idGrupo
    INNER JOIN profesores_has_grupo ON profesores_has_grupo.id_grupo_has_asig = grupo_has_asignaturas.id
WHERE resultats.nomEdicio = :nomEdicio
and resultats.Assignatura = :Assignatura
and resultats.$AssigGXX <> ''
AND profesores_has_grupo.Profesores_niu = :niu
AND grupo_has_asignaturas.estudio_id = :pla
AND grupo_has_asignaturas.anio_inicio=:anio");

        $parameters = [
            'nomEdicio' => $nomEdicio,
            'Assignatura' => $Assignatura,
            'niu' => $niu,
            'pla' => $pla,
            'anio' => $anio,
        ];
        $query->execute($parameters);
        $result_data = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($result_data);
}