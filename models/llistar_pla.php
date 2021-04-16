<?php
function llistar_pla($connection) {
    try {
        $check_pla = $connection->prepare("SELECT DISTINCT estudios.idEstudio, estudios.nombre 
                                        FROM estudios INNER JOIN resultats ON resultats.PlaPropietari = estudios.idEstudio
                                        ORDER BY estudios.nombre ASC");
        $check_pla->execute();
        $result_pla = $check_pla->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($result_pla);
}
