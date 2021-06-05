<?php
function consulta_graus_profes($connection, $niuProfe, $nomEdicio) {
    try {//updated
        if ($nomEdicio == ""){
            $graus_profe = $connection->prepare("
        SELECT DISTINCT estudios.idEstudio, estudios.nombre
        FROM 
            (SELECT DISTINCT asignaturas.idAsignaturas, asignaturas.nombre 
            FROM resultats INNER JOIN asignaturas ON resultats.Assignatura = asignaturas.idAsignaturas
            INNER JOIN grupo_has_asignaturas ON grupo_has_asignaturas.Asignaturas_idAsignaturas = asignaturas.idAsignaturas
            INNER JOIN profesores_has_grupo ON profesores_has_grupo.id_grupo_has_asig = grupo_has_asignaturas.id
            WHERE profesores_has_grupo.Profesores_niu  =:niuProfe ) as result
            INNER JOIN asignaturas_has_estudios ON asignaturas_has_estudios.Asignaturas_idAsignaturas=result.idAsignaturas
            INNER JOIN estudios ON estudios.idEstudio = asignaturas_has_estudios.Estudios_idEstudios
            ORDER BY estudios.nombre ASC");

            $parametros = [
                'niuProfe' => $niuProfe,
            ];
        }else{
            $graus_profe = $connection->prepare("
        SELECT DISTINCT estudios.idEstudio, estudios.nombre
        FROM 
            (SELECT DISTINCT asignaturas.idAsignaturas, asignaturas.nombre 
            FROM resultats INNER JOIN asignaturas ON resultats.Assignatura = asignaturas.idAsignaturas
            INNER JOIN grupo_has_asignaturas ON grupo_has_asignaturas.Asignaturas_idAsignaturas = asignaturas.idAsignaturas
            INNER JOIN profesores_has_grupo ON profesores_has_grupo.id_grupo_has_asig = grupo_has_asignaturas.id
            WHERE profesores_has_grupo.Profesores_niu  =:niuProfe
                AND resultats.nomEdicio =:nomEdicio) as result
            INNER JOIN asignaturas_has_estudios ON asignaturas_has_estudios.Asignaturas_idAsignaturas=result.idAsignaturas
            INNER JOIN estudios ON estudios.idEstudio = asignaturas_has_estudios.Estudios_idEstudios
            ORDER BY estudios.nombre ASC");

            $parametros = [
                'niuProfe' => $niuProfe,
                'nomEdicio' => $nomEdicio,
            ];
        }


        $graus_profe->execute($parametros);
        $graus_profe = $graus_profe->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($graus_profe);
}
