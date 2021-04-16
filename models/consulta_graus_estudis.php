<?php
function consulta_graus_estudis($connection, $idEstudi) {
    try {
        $graus_estudis = $connection->prepare("SELECT DISTINCT estudios.idEstudio,estudios.nombre 
                                        FROM estudios INNER JOIN resultats ON resultats.PlaPropietari = estudios.idEstudio
                                        WHERE  estudios.idEstudio =:idEstudi
                                        ORDER BY estudios.nombre ASC");
        $parametros = [
            'idEstudi' => $idEstudi,
        ];

        $graus_estudis->execute($parametros);
        $graus_estudis = $graus_estudis->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($graus_estudis);
}
