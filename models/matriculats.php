<?php
function matriculats($connection, $nomEdicio, $PlaPropietari, $Assignatura) {
    try {
        $query = $connection->prepare("SELECT SUM(ocupacion) AS '0' 
                                        FROM (SELECT grupo_has_asignaturas.ocupacion 
                                        FROM (SELECT DISTINCT PlaPropietari, Assignatura, Grup 
                                        FROM resultats WHERE nomEdicio = :nomEdicio AND Assignatura = :Assignatura 
                                        AND PlaPropietari = :PlaPropietari) AS result 
                                        INNER JOIN grupo_has_asignaturas 
                                        ON result.Grup = grupo_has_asignaturas.Grupo_idGrupo
                                        AND result.Assignatura = grupo_has_asignaturas.Asignaturas_idAsignaturas) AS subquery");
        $parameters = [
            'nomEdicio' => $nomEdicio,
            'PlaPropietari' => $PlaPropietari,
            'Assignatura' => $Assignatura,
        ];
        $query->execute($parameters);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($results);
}
