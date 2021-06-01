<?php
function participacio_profe($connection, $anio,$nomEdicio, $niu,$PlaPropietari, $Assignatura) {
    try {//es consulta nueva, no esta modificada
        $query = $connection->prepare("SELECT COUNT(*) AS '0' 
FROM resultats INNER JOIN grupo_has_asignaturas
	ON resultats.Grup = grupo_has_asignaturas.Grupo_idGrupo
    INNER JOIN profesores_has_grupo ON profesores_has_grupo.id_grupo_has_asig = grupo_has_asignaturas.id
WHERE resultats.nomEdicio = :nomEdicio
AND resultats.PlaPropietari = :pla 
AND resultats.Assignatura = :Assignatura
AND profesores_has_grupo.Profesores_niu = :niu
AND grupo_has_asignaturas.anio_inicio =:anio");
        $parameters = [
            'nomEdicio' => $nomEdicio,
            'pla' => $PlaPropietari,
            'Assignatura' => $Assignatura,
            'niu' => $niu,
            'anio' => $anio,
        ];
        $query->execute($parameters);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($results);
}
