<?php
function comprobar_asig_en_estudio($connection, $idEstudi,$idAsignatura) {
    try {
        $existe_asig = $connection->prepare("SELECT count(1)
                                            FROM resultats
                                            WHERE PlaPropietari = '$idEstudi' AND Assignatura = '$idAsignatura'");
        /*$parametros = [
            'idEstudi' => $idEstudi,
            'idAsig' => $idAsignatura,
        ];*/

        $existe_asig->execute();
        $existe_asig = $existe_asig->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($existe_asig);
}
///////////////////////////////////
///SELECT DISTINCT id FROM resultats WHERE PlaPropietari = '958' AND Assignatura = '103801'
//function llistar_assig_totes($connection, $nomEdicio) {
//    try {
//        $query = $connection->prepare("SELECT DISTINCT resultats.Assignatura, asignaturas.nombre
//                                        FROM asignaturas INNER JOIN resultats ON resultats.Assignatura = asignaturas.idAsignaturas
//                                        WHERE resultats.nomEdicio = :nomEdicio
//                                        ORDER BY asignaturas.nombre ASC");
//        $parameters = [
//            'nomEdicio' => $nomEdicio,
//        ];
//        $query->execute($parameters);
//        $results = $query->fetchAll(PDO::FETCH_ASSOC);
//    } catch (PDOException $e) {
//        echo "Error: " . $e->getMessage();
//    }
//    return ($results);
//}