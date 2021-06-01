
<?php
function calcul_mitjana_profe($connection, $AssigGXX,$niu,$anio, $nomEdicio, $PlaPropietari, $Assignatura) {
    try {//consulta ok
        $query = $connection->prepare("
        SELECT ROUND(AVG($AssigGXX),2) AS '0'
        FROM resultats
        INNER JOIN grupo_has_asignaturas ON grupo_has_asignaturas.Grupo_idGrupo = resultats.Grup
        AND grupo_has_asignaturas.Asignaturas_idAsignaturas = resultats.Assignatura
        INNER JOIN profesores_has_grupo ON profesores_has_grupo.id_grupo_has_asig = grupo_has_asignaturas.id
        WHERE resultats.nomEdicio = :nomEdicio and resultats.PlaPropietari = :PlaPropietari 
        and resultats.Assignatura = :Assignatura and resultats.AssigG04 <> ''and grupo_has_asignaturas.anio_inicio =:anio
        AND profesores_has_grupo.Profesores_niu =:niu	
        ");
        $parameters = [
            'nomEdicio' => $nomEdicio,
            'PlaPropietari' => $PlaPropietari,
            'Assignatura' => $Assignatura,
            'anio' => $anio,
            'niu' =>$niu,
        ];
        $query->execute($parameters);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($results);
}
