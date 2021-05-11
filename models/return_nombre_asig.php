<?php
function return_nombre_asig($connection, $idAsig) {
    try {
        $query = $connection->prepare("SELECT nombre 
                                        FROM asignaturas 
                                        WHERE idAsignaturas = $idAsig");

        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($results);
}
