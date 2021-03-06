<?php
function ediciones_de_asig($connection, $idAsignatura){
    //se utiliza en la tabla de comapracion
    try {
        $ediciones = $connection->prepare("SELECT DISTINCT edicions.nom,edicions.descripcio, edicions.curs_academic, edicions.anio_inicio
                                            FROM resultats INNER JOIN edicions ON resultats.nomEdicio = edicions.nom
                                            WHERE resultats.Assignatura ='$idAsignatura'");


        $ediciones->execute();
        $ediciones = $ediciones->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($ediciones);
}