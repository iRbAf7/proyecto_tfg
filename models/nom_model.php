<?php
function nom_model($connection, $nom)
{
    try {
        $query = $connection->prepare("SELECT descripcio AS '0' FROM models WHERE nom = :nom");
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
