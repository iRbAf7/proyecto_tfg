<?php
function participacio($connection, $nomEdicio, $PlaPropietari, $Assignatura) {
    try {
        if ($PlaPropietari == '0'){
            $query = $connection->prepare("SELECT COUNT(*) AS '0' 
FROM resultats WHERE nomEdicio = :nomEdicio AND Assignatura = :Assignatura");
            $parameters = [
                'nomEdicio' => $nomEdicio,
                'Assignatura' => $Assignatura,
            ];
        }else{
            $query = $connection->prepare("SELECT COUNT(*) AS '0' 
FROM resultats WHERE nomEdicio = :nomEdicio AND PlaPropietari = :PlaPropietari AND Assignatura = :Assignatura");
            $parameters = [
                'nomEdicio' => $nomEdicio,
                'PlaPropietari' => $PlaPropietari,
                'Assignatura' => $Assignatura,
            ];
        }

        $query->execute($parameters);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($results);
}
