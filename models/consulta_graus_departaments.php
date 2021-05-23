<?php
function consulta_graus_departaments($connection, $idDept) {
    try {//updated
        $graus_dept = $connection->prepare("
                SELECT DISTINCT estudios.idEstudio,estudios.nombre 
                FROM resultats INNER JOIN estudios ON resultats.PlaPropietari = estudios.idEstudio
                INNER JOIN asignaturas_has_estudios ON asignaturas_has_estudios.Estudios_idEstudios = estudios.idEstudio
                INNER JOIN asignaturas ON asignaturas.idAsignaturas = asignaturas_has_estudios.Asignaturas_idAsignaturas
                INNER JOIN grupo_has_asignaturas ON grupo_has_asignaturas.Asignaturas_idAsignaturas = asignaturas.idAsignaturas
                INNER JOIN profesores_has_grupo ON profesores_has_grupo.id_grupo_has_asig = grupo_has_asignaturas.id
                INNER JOIN departamentos_has_profesores ON departamentos_has_profesores.Profesores_niu = profesores_has_grupo.Profesores_niu
                WHERE departamentos_has_profesores.Departamentos_idDepartamentos =:idDept
                 ORDER BY estudios.nombre ASC
            ");//si se añade el ORDER BY estudios.nombre  salta un error en los casos que la consulta se devuelva vacia, a veces si a veces no
        /*
         * SELECT DISTINCT estudios.idEstudio,estudios.nombre
            FROM resultats INNER JOIN estudios ON resultats.PlaPropietari = estudios.idEstudio
            INNER JOIN asignaturas_has_estudios ON asignaturas_has_estudios.Estudios_idEstudios = estudios.idEstudio
            INNER JOIN asignaturas ON asignaturas.idAsignaturas = asignaturas_has_estudios.Asignaturas_idAsignaturas
            INNER JOIN grupo_has_asignaturas ON grupo_has_asignaturas.asignaturas_idAsignaturas = asignaturas.idAsignaturas
            INNER JOIN profesores_has_grupo ON profesores_has_grupo.id_grupo_has_asig = grupo_has_asignaturas.id
            INNER JOIN profesores ON profesores.niu = profesores_has_grupo.Profesores_niu
            INNER JOIN departamentos_has_profesores ON departamentos_has_profesores.Profesores_niu = profesores.niu
            WHERE  departamentos_has_profesores.Departamentos_idDepartamentos =: idDept
                                        ORDER BY estudios.nombre ASC*/


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
