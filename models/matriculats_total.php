<?php
function matriculats_total($connection, $Assignatura) {
    try {
        $query = $connection->prepare("select sum(`ocupacion`) AS '0' FROM (SELECT `ocupacion` FROM `grupo_has_asignaturas` WHERE `Asignaturas_idAsignaturas` = :Assignatura) AS subquery");
        $parameters = [
            'Assignatura' => $Assignatura
        ];
        $query->execute($parameters);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($results);
}
