<?php

function resultados_preg_profe($connection, $AssigGXX, $niu, $anio,$PlaPropietari, $nomEdicio, $Assignatura)
{
    try {
        $query = $connection->prepare("SELECT resposta, ROUND((totalAlumnes/(SELECT SUM(totalAlumnes) 
            FROM
            (
                SELECT $AssigGXX AS resposta, COUNT(*) AS totalAlumnes
                FROM (
                    SELECT $AssigGXX
                    FROM resultats
                    INNER JOIN grupo_has_asignaturas ON grupo_has_asignaturas.Grupo_idGrupo = resultats.Grup
                    AND grupo_has_asignaturas.Asignaturas_idAsignaturas = resultats.Assignatura
                    INNER JOIN profesores_has_grupo ON profesores_has_grupo.id_grupo_has_asig = grupo_has_asignaturas.id
                    WHERE resultats.nomEdicio =:nomEdicio AND resultats.PlaPropietari =:PlaPropietari AND resultats.Assignatura =:Assignatura
                    AND resultats.$AssigGXX <> '' and grupo_has_asignaturas.anio_inicio =:anio
                    AND profesores_has_grupo.Profesores_niu = :niu
                    ) AS subquery
                GROUP BY $AssigGXX
            ) AS result)*100)) AS totalAlumnes
            FROM (
                SELECT $AssigGXX AS resposta, COUNT(*) AS totalAlumnes
                FROM (
                    SELECT $AssigGXX
                    FROM resultats
                    INNER JOIN grupo_has_asignaturas ON grupo_has_asignaturas.Grupo_idGrupo = resultats.Grup
                    AND grupo_has_asignaturas.Asignaturas_idAsignaturas = resultats.Assignatura
                    INNER JOIN profesores_has_grupo ON profesores_has_grupo.id_grupo_has_asig = grupo_has_asignaturas.id
                    WHERE resultats.nomEdicio =:nomEdicio AND resultats.PlaPropietari =:PlaPropietari AND resultats.Assignatura =:Assignatura
                    AND resultats.$AssigGXX <> '' and grupo_has_asignaturas.anio_inicio =:anio
                    AND profesores_has_grupo.Profesores_niu = :niu
                ) AS subquery
            GROUP BY $AssigGXX)
            AS result");

        $parameters = [
            'nomEdicio' => $nomEdicio,
            'PlaPropietari' => $PlaPropietari,
            'Assignatura' => $Assignatura,
            'niu' =>  $niu,
            'anio' => $anio,
        ];
        $query->execute($parameters);
        $result_data = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($result_data);
}
