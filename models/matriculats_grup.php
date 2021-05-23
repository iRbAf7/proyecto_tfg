<?php
function matriculats_grup($connection, $Assignatura,$anio, $Grupo_idGrupo) {
    try {//updated
        $query = $connection->prepare("select sum(ocupacion) AS '0' FROM (
                                        SELECT ocupacion 
                                        FROM grupo_has_asignaturas 
                                        WHERE Asignaturas_idAsignaturas = :Assignatura 
                                          AND Grupo_idGrupo = :Grupo_idGrupo
                                          AND anio_inicio = :anio) AS subquery");
        //se ha modificado, se ha añadido el parametro anio del grupo
        $parameters = [
            'Assignatura' => $Assignatura,
            'Grupo_idGrupo' => $Grupo_idGrupo,
            'anio' => $anio
        ];
        $query->execute($parameters);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($results);
}