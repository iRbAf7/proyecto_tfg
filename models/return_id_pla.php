<?php
function return_id_pla($connection, $nomPla) {
    try {
        $query = $connection->prepare("SELECT idEstudio
                                        FROM estudios 
                                        WHERE nombre =:nom");
        $parametros = [
            'nom' => $nomPla,
        ];
        $query->execute($parametros);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($results[0]['idEstudio']);
}
