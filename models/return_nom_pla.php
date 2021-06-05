<?php
function return_nom_pla($connection, $id) {
    try {
        $query = $connection->prepare("SELECT nombre
                                        FROM estudios 
                                        WHERE idEstudio =:id");
        $parametros = [
            'id' => $id,
        ];
        $query->execute($parametros);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($results[0]['nombre']);
}
