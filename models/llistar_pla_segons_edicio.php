<?php
function llistar_pla_segons_edicio($connection, $nom_edicio) {
    try {
        $check_pla = $connection->prepare("SELECT DISTINCT estudios.idEstudio, estudios.nombre 
                                        FROM estudios INNER JOIN resultats ON resultats.PlaPropietari = estudios.idEstudio
                                        WHERE resultats.nomEdicio =:edicio
                                        ORDER BY estudios.nombre ASC");
        $params = [
            'edicio' => $nom_edicio,
        ];
        $check_pla->execute($params);
        $result_pla = $check_pla->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($result_pla);
}
