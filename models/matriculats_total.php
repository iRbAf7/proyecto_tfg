<?php
function matriculats_total($connection, $anio,$edicio, $Assignatura) {
    try {
        $query = $connection->prepare("
         SELECT SUM(ocupacion) AS '0' 
FROM 
(SELECT grupo_has_asignaturas.ocupacion 
FROM 
(SELECT DISTINCT PlaPropietari, Assignatura, Grup 
FROM resultats WHERE nomEdicio = :edicio AND Assignatura = :Assignatura 
) AS result 
INNER JOIN grupo_has_asignaturas 
ON result.Grup = grupo_has_asignaturas.Grupo_idGrupo
AND result.Assignatura = grupo_has_asignaturas.Asignaturas_idAsignaturas
WHERE  grupo_has_asignaturas.anio_inicio =:anio_edicio   ) AS subquery
        ");

        /*
         * select sum(`ocupacion`) AS '0'
                                        FROM (
                                            SELECT `ocupacion`
                                            FROM `grupo_has_asignaturas`
                                            WHERE `Asignaturas_idAsignaturas` = :Assignatura) AS subquery
         * */
        $parameters = [
            'Assignatura' => $Assignatura,
            'anio_edicio' => $anio,
            'edicio' => $edicio
        ];
        $query->execute($parameters);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($results);
}
