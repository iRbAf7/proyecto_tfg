<?php
function consultarAsigsUser($conexion,$niu){
    try{//updated
        $consultar_asigs_profesores = $conexion->prepare("
                                        SELECT DISTINCT asignaturas.nombre, asignaturas.idAsignaturas, grupo_has_asignaturas.anio_inicio
                                        FROM grupo_has_asignaturas INNER JOIN asignaturas 
                                        ON grupo_has_asignaturas.Asignaturas_idAsignaturas = asignaturas.idAsignaturas
                                        INNER JOIN profesores_has_grupo ON profesores_has_grupo.id_grupo_has_asig =  grupo_has_asignaturas.id
                                        WHERE profesores_has_grupo.profesores_niu =:niu
                                         ORDER BY  grupo_has_asignaturas.anio_inicio ASC");
        //lo malo es que devuelve todas las asignaturas repetidas, por culpa de q son en distinto año academico
        $parametros = [
            'niu' => $niu,
        ];

        $consultar_asigs_profesores->execute($parametros);
        $consultar_asigs_profesores = $consultar_asigs_profesores->fetchAll(PDO::FETCH_ASSOC);


        return $consultar_asigs_profesores;
    }catch(PDOException $e){
        return "Error: " . $e->getMessage();
    }
}