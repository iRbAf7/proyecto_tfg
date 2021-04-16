<?php
function llistar_assig_totes($connection, $nomEdicio) {
    try {
        $query = $connection->prepare("SELECT DISTINCT resultats.Assignatura, asignaturas.nombre 
                                        FROM asignaturas INNER JOIN resultats ON resultats.Assignatura = asignaturas.idAsignaturas 
                                        WHERE resultats.nomEdicio = :nomEdicio 
                                        ORDER BY asignaturas.nombre ASC");
        $parameters = [
            'nomEdicio' => $nomEdicio,
        ];
        $query->execute($parameters);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($results);
}
