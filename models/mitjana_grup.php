<?php
function mitjana_grup($connection, $AssigGXX, $nomEdicio, $Assignatura, $Grup) {
    try {
        $query = $connection->prepare("SELECT ROUND(AVG($AssigGXX),2) AS '0' FROM resultats WHERE nomEdicio = :nomEdicio and Assignatura = :Assignatura and Grup = :Grup and $AssigGXX <> ''");
        $parameters = [
            'Grup' => $Grup,
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
