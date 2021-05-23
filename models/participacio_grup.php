<?php
function participacio_grup($connection, $nomEdicio, $Assignatura, $Grup) {
    try {
        $query = $connection->prepare("SELECT COUNT(*) AS '0'
FROM resultats WHERE nomEdicio = :nomEdicio AND Assignatura = :Assignatura AND Grup = :Grup");
        $parameters = [
            'nomEdicio' => $nomEdicio,
            'Assignatura' => $Assignatura,
            'Grup' => $Grup,
        ];
        $query->execute($parameters);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($results);
}
