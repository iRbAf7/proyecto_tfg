<?php
function matriculats($connection, $anio,$nomEdicio, $PlaPropietari, $Assignatura) {
    try {//updated
        if ($PlaPropietari != '0'){
            $query = $connection->prepare("SELECT SUM(ocupacion) AS '0' 
                                        FROM 
                                            (SELECT grupo_has_asignaturas.ocupacion 
                                            FROM 
                                                 (SELECT DISTINCT PlaPropietari, Assignatura, Grup 
                                                  FROM resultats WHERE nomEdicio = :nomEdicio AND Assignatura = :Assignatura 
                                                  AND PlaPropietari = :PlaPropietari) AS result 
                                            INNER JOIN grupo_has_asignaturas 
                                            ON result.Grup = grupo_has_asignaturas.Grupo_idGrupo
                                            AND result.Assignatura = grupo_has_asignaturas.Asignaturas_idAsignaturas
                                            AND result.PlaPropietari = grupo_has_asignaturas.estudio_id
                                            WHERE  grupo_has_asignaturas.anio_inicio =:anio   ) AS subquery");
            //se ha modificado, se ha añadido el parametro anio de la edicion
            $parameters = [
                'nomEdicio' => $nomEdicio,
                'PlaPropietari' => $PlaPropietari,
                'Assignatura' => $Assignatura,
                'anio' => $anio,
            ];
        }else{
            $query = $connection->prepare("SELECT SUM(ocupacion) AS '0' 
                                        FROM 
                                            (SELECT grupo_has_asignaturas.ocupacion 
                                            FROM 
                                                 (SELECT DISTINCT PlaPropietari, Assignatura, Grup 
                                                  FROM resultats WHERE nomEdicio = :nomEdicio AND Assignatura = :Assignatura) AS result 
                                            INNER JOIN grupo_has_asignaturas 
                                            ON result.Grup = grupo_has_asignaturas.Grupo_idGrupo
                                            AND result.Assignatura = grupo_has_asignaturas.Asignaturas_idAsignaturas                                       
                                            AND result.PlaPropietari = grupo_has_asignaturas.estudio_id                                            
                                            WHERE  grupo_has_asignaturas.anio_inicio =:anio   ) AS subquery");
            //se ha modificado, se ha añadido el parametro anio de la edicion
            $parameters = [
                'nomEdicio' => $nomEdicio,
                'Assignatura' => $Assignatura,
                'anio' => $anio,
            ];
        }

        $query->execute($parameters);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($results);
}
