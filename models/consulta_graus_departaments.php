<?php
function consulta_graus_departaments($connection, $idDept) {
    try {
        $graus_dept = $connection->prepare("SELECT DISTINCT estudios.idEstudio,estudios.nombre 
                                        FROM resultats INNER JOIN estudios ON resultats.PlaPropietari = estudios.idEstudio
                                        INNER JOIN asignaturas_has_estudios ON asignaturas_has_estudios.Estudios_idEstudios = estudios.idEstudio
                                        INNER JOIN asignaturas ON asignaturas.idAsignaturas = asignaturas_has_estudios.Asignaturas_idAsignaturas
                                        INNER JOIN profesores_has_asignaturas ON profesores_has_asignaturas.asignaturas_idAsignaturas = asignaturas.idAsignaturas
                                        INNER JOIN profesores ON profesores.niu = profesores_has_asignaturas.profesores_niu 
                                        INNER JOIN departamentos_has_profesores ON departamentos_has_profesores.Profesores_niu = profesores.niu
                                        WHERE  departamentos_has_profesores.Departamentos_idDepartamentos =:idDept
                                        ORDER BY estudios.nombre ASC");
        $parametros = [
            'idDept' => $idDept,
        ];

        $graus_dept->execute($parametros);
        $graus_dept = $graus_dept->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($graus_dept);
}
