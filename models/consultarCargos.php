<?php
function consultarCargos($conexion,$niu){
    try{
        $consultar_profesores = $conexion->prepare("SELECT cargos.descripcion 
                                                FROM cargos_has_profesores INNER JOIN cargos 
                                                ON cargos_has_profesores.Cargos_idCargos = cargos.idCargos
                                                WHERE cargos_has_profesores.Profesores_niu = :niu");
        /*$consultar_profesores = $conexion->prepare("SELECT Cargos_idCargos
                                                FROM cargos_has_profesores 
                                                WHERE Profesores_niu = :niu");*/
        $parametros = [
            'niu' => $niu,
        ];

        $consultar_profesores->execute($parametros);
        $consultar_profesores = $consultar_profesores->fetchAll(PDO::FETCH_ASSOC);


        return($consultar_profesores);
    }catch(PDOException $e){
        return "Error: " . $e->getMessage();
    }
}