<?php
function calcul_mitjana($connection, $AssigGXX, $nomEdicio, $PlaPropietari, $Assignatura) {
    try {
        $query = $connection->prepare("SELECT ROUND(AVG($AssigGXX),2) AS '0' 
                                        FROM resultats WHERE nomEdicio = :nomEdicio and PlaPropietari = :PlaPropietari 
                                        and Assignatura = :Assignatura and $AssigGXX <> ''");
        $parameters = [
            'nomEdicio' => $nomEdicio,
            'PlaPropietari' => $PlaPropietari,
            'Assignatura' => $Assignatura,
        ];
        $query->execute($parameters);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($results);
}
