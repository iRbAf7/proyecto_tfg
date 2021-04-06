<?php
function nom_assignatura($connection, $idAsignaturas) {
    try {
        $query = $connection->prepare("SELECT nombre AS '0' FROM asignaturas WHERE idAsignaturas = :idAsignaturas");
        $parameters = [
            'idAsignaturas' => $idAsignaturas,
        ];
        $query->execute($parameters);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($results);
}