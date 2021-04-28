<?php
function llistar_assig_totes($connection) {
    try {
        $query = $connection->prepare("SELECT DISTINCT resultats.Assignatura, asignaturas.nombre 
                                        FROM asignaturas INNER JOIN resultats ON resultats.Assignatura = asignaturas.idAsignaturas
                                        ORDER BY asignaturas.nombre ASC");

        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($results);
}
