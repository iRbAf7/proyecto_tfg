<?php
function consulta_graus_profes($connection, $niuProfe) {
    try {//updated
        $graus_profe = $connection->prepare("
                                        SELECT DISTINCT estudios.idEstudio,estudios.nombre 
FROM resultats INNER JOIN estudios ON resultats.PlaPropietari = estudios.idEstudio
INNER JOIN asignaturas_has_estudios ON asignaturas_has_estudios.Estudios_idEstudios = estudios.idEstudio
INNER JOIN asignaturas ON asignaturas.idAsignaturas = asignaturas_has_estudios.Asignaturas_idAsignaturas
INNER JOIN grupo_has_asignaturas ON grupo_has_asignaturas.Asignaturas_idAsignaturas = asignaturas.idAsignaturas
INNER JOIN profesores_has_grupo ON profesores_has_grupo.id_grupo_has_asig = grupo_has_asignaturas.id
WHERE  profesores_has_grupo.Profesores_niu =:niuProfe
ORDER BY estudios.nombre ASC");
        /*
         * SELECT DISTINCT estudios.idEstudio,estudios.nombre
                                        FROM resultats INNER JOIN estudios ON resultats.PlaPropietari = estudios.idEstudio
                                        INNER JOIN asignaturas_has_estudios ON asignaturas_has_estudios.Estudios_idEstudios = estudios.idEstudio
                                        INNER JOIN asignaturas ON asignaturas.idAsignaturas = asignaturas_has_estudios.Asignaturas_idAsignaturas
                                        INNER JOIN profesores_has_asignaturas ON profesores_has_asignaturas.asignaturas_idAsignaturas = asignaturas.idAsignaturas
                                        WHERE  profesores_has_asignaturas.profesores_niu =:niuProfe
                                        ORDER BY estudios.nombre ASC
         * */
        $parametros = [
            'niuProfe' => $niuProfe,
        ];

        $graus_profe->execute($parametros);
        $graus_profe = $graus_profe->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($graus_profe);
}
