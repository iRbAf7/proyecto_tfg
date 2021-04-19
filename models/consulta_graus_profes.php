<?php
function consulta_graus_profes($connection, $niuProfe) {
    try {
        $graus_profe = $connection->prepare("SELECT DISTINCT estudios.idEstudio,estudios.nombre 
                                        FROM resultats INNER JOIN estudios ON resultats.PlaPropietari = estudios.idEstudio
                                        INNER JOIN asignaturas_has_estudios ON asignaturas_has_estudios.Estudios_idEstudios = estudios.idEstudio
                                        INNER JOIN asignaturas ON asignaturas.idAsignaturas = asignaturas_has_estudios.Asignaturas_idAsignaturas
                                        INNER JOIN profesores_has_asignaturas ON profesores_has_asignaturas.asignaturas_idAsignaturas = asignaturas.idAsignaturas
                                        WHERE  profesores_has_asignaturas.profesores_niu =:niuProfe
                                        ORDER BY estudios.nombre ASC");
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
