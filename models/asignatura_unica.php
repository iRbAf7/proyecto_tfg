<?php
function asignatura_unica($connection, $id_asig) {
    try {//no hacia falta modificar
        $unic = $connection->prepare("SELECT * FROM `asignaturas_has_estudios` WHERE Asignaturas_idAsignaturas =:idAsig");
        $parametros = [
            'idAsig' => $id_asig,
        ];

        $unic->execute($parametros);
        $unic = $unic->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($unic);
}
