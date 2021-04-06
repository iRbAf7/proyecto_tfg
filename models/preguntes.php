<?php
function preguntes($connection, $nom_versio) {
    try {
        $query = $connection->prepare("SELECT numero,enunciat FROM preguntes Where nom_versio = :nom_versio");
        $parameters = [
            'nom_versio' => $nom_versio
        ];
        $query->execute($parameters);
        $result_data = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($result_data);
}