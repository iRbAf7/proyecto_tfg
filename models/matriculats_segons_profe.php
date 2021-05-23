<?php
function matriculats_segons_profe($connection, $anio,$nomEdicio, $PlaPropietari,$niu_profe, $Assignatura) {
    try {//updated
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
                                            INNER JOIN profesores_has_grupo 
                                            ON profesores_has_grupo.id_grupo_has_asig = grupo_has_asignaturas.id
                                            WHERE  grupo_has_asignaturas.anio_inicio =:anio  
                                              AND  profesores_has_grupo.Profesores_niu = :niu_profe ) AS subquery");
                            //se ha modificado, se ha añadido el parametro anio de la edicion
        $parameters = [
            'nomEdicio' => $nomEdicio,
            'PlaPropietari' => $PlaPropietari,
            'Assignatura' => $Assignatura,
            'niu_profe' => $niu_profe,
            'anio' => $anio,
        ];
        $query->execute($parameters);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($results);
}
