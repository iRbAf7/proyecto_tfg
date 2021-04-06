<?php
function nom_pla($connection, $idEstudio)
{
    try {
        $query = $connection->prepare("SELECT nombre AS '0' FROM estudios WHERE idEstudio = :idEstudio");
        $parameters = [
            'idEstudio' => $idEstudio,
        ];
        $query->execute($parameters);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($results);
}
