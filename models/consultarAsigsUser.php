<?php
function consultarAsigsUser($conexion,$niu){
    try{
        $consultar_asigs_profesores = $conexion->prepare("SELECT *  
                                                FROM profesores_has_asignaturas INNER JOIN asignaturas 
                                                ON profesores_has_asignaturas.asignaturas_idAsignaturas = asignaturas.idAsignaturas
                                                WHERE profesores_has_asignaturas.profesores_niu = :niu");
        /*$consultar_profesores = $conexion->prepare("SELECT Cargos_idCargos
                                                FROM cargos_has_profesores
                                                WHERE Profesores_niu = :niu");*/
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