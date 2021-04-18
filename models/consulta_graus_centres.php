<?php
function consulta_graus_centres($connection, $idCentro) {
    try {
        $graus_centres = $connection->prepare("SELECT DISTINCT estudios.idEstudio,estudios.nombre 
                                        FROM resultats INNER JOIN estudios ON resultats.PlaPropietari = estudios.idEstudio
                                        WHERE  estudios.Centros_idCentros =:idCentro
                                        ORDER BY estudios.nombre ASC");
        $parametros = [
            'idCentro' => $idCentro,
        ];

        $graus_centres->execute($parametros);
        $graus_centres = $graus_centres->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($graus_centres);
}
