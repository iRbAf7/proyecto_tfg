<?php
function matriculats_grup($connection, $Assignatura, $Grupo_idGrupo) {
    try {
        $query = $connection->prepare("select sum(ocupacion) AS '0' FROM (SELECT ocupacion FROM grupo_has_asignaturas WHERE Asignaturas_idAsignaturas = :Assignatura AND Grupo_idGrupo = :Grupo_idGrupo) AS subquery");
        $parameters = [
            'Assignatura' => $Assignatura,
            'Grupo_idGrupo' => $Grupo_idGrupo
        ];
        $query->execute($parameters);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($results);
}