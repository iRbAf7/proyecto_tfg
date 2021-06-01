<?php
function resultados_preg($connection, $AssigGXX,$PlaPropietari, $nomEdicio, $Assignatura) {
    try {
        $query = $connection->prepare("SELECT resposta, ROUND((totalAlumnes/(SELECT SUM(totalAlumnes) 
            FROM
            (
                SELECT $AssigGXX AS resposta, COUNT(*) AS totalAlumnes
                FROM (
                    SELECT $AssigGXX
                    FROM resultats
                    WHERE nomEdicio = :nomEdicio AND PlaPropietari = :PlaPropietari AND Assignatura = :Assignatura AND $AssigGXX <> ''
                    ) AS subquery
                GROUP BY $AssigGXX
            ) AS result)*100)) AS totalAlumnes
            FROM (
                SELECT $AssigGXX AS resposta, COUNT(*) AS totalAlumnes
                FROM (
                    SELECT $AssigGXX
                    FROM resultats
                    WHERE nomEdicio = :nomEdicio AND PlaPropietari = :PlaPropietari  AND Assignatura = :Assignatura AND $AssigGXX <> ''
                ) AS subquery
            GROUP BY $AssigGXX)
            AS result");

        $parameters = [
            'nomEdicio' => $nomEdicio,
            'PlaPropietari' => $PlaPropietari,
            'Assignatura' => $Assignatura,
        ];
        $query->execute($parameters);
        $result_data = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($result_data);
}
