<?php
function nom_versio($connection, $nom)
{
    try {
        $query = $connection->prepare("SELECT descripcio AS '0' FROM versions WHERE nom = :nom");
        $parameters = [
            'nom' => $nom,
        ];
        $query->execute($parameters);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($results);
}
