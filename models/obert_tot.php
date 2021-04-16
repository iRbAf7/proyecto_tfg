<?php
function obert_tot($connection, $AssigGXX, $nomEdicio, $Assignatura) {
    try {
        $query = $connection->prepare("SELECT $AssigGXX AS '0' FROM resultats
                                        WHERE nomEdicio = :nomEdicio 
                                        and Assignatura = :Assignatura
                                        and $AssigGXX <> ''");
        $parameters = [
            'nomEdicio' => $nomEdicio,
            'Assignatura' => $Assignatura,
        ];
        $query->execute($parameters);
        $result_data = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($result_data);
}