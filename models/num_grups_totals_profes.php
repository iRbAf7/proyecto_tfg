<?php
function num_grups_totals_profes($connection, $anio,$nomEdicio, $PlaPropietari, $Assignatura) {
    try {//actualizadoo
        $query = $connection->prepare("
SELECT COUNT(n.Grup) as num
FROM 
    (SELECT DISTINCT resultats.Grup
    FROM resultats
    INNER JOIN grupo_has_asignaturas ON resultats.Grup = grupo_has_asignaturas.Grupo_idGrupo
    AND resultats.Assignatura = grupo_has_asignaturas.Asignaturas_idAsignaturas
    INNER JOIN profesores_has_grupo ON profesores_has_grupo.id_grupo_has_asig = grupo_has_asignaturas.id
    WHERE resultats.nomEdicio = :nomEdicio 
    AND resultats.Assignatura = :Assignatura 
    AND resultats.PlaPropietari = :pla
    AND grupo_has_asignaturas.anio_inicio =:anio) as n");
        $parameters = [
            'nomEdicio' => $nomEdicio,
            'pla' => $PlaPropietari,
            'Assignatura' => $Assignatura,
            'anio' => $anio,
        ];
        $query->execute($parameters);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($results);
}
