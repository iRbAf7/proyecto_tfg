<?php
function comprobar_asig_en_estudio($connection, $idEstudi,$idAsignatura) {
    try {
        $existe_asig = $connection->prepare("SELECT *
                                        FROM asignaturas_has_estudios 
                                        WHERE  Estudios_idEstudios =: idEstudi 
                                            AND  Asignaturas_idAsignatras =: idAsig
                                       ");
        $parametros = [
            'idEstudi' => $idEstudi,
            'idAsig' => $idAsignatura,
        ];

        $existe_asig->execute($parametros);
        $existe_asig = $existe_asig->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($existe_asig);
}
