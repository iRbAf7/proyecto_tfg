<?php
function nivell_privilegi($connection, $numero) {
    try {
        $query = $connection->prepare("SELECT necessita_privilegi AS '0' FROM preguntes WHERE numero = :numero");
        $parameters = [
            'numero' => $numero,
        ];
        $query->execute($parameters);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($results);
}