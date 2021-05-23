<?php
function get_anio_edicio($connection, $nomEdicio) {
    try {
        $query = $connection->prepare("SELECT anio_inicio
                                        FROM edicions
                                        WHERE nom =:nomEdicio
                                            ");
        $parameters = [
            'nomEdicio' => $nomEdicio,

        ];
        $query->execute($parameters);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($results);
}
