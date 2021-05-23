<?php
function grups_totals($connection, $nomEdicio, $Assignatura) {
    try {
        $query = $connection->prepare("SELECT DISTINCT Grup AS '0' 
FROM resultats WHERE nomEdicio = :nomEdicio AND Assignatura = :Assignatura");
        $parameters = [
            'nomEdicio' => $nomEdicio,
            'Assignatura' => $Assignatura,
        ];
        $query->execute($parameters);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($results);
}
