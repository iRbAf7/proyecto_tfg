<?php
function comprobar_permiso_defecto($conexion,$idAmbito, $idObjeto){
    try{
        $consulta_permiso_defecto = $conexion->prepare("SELECT *
                                                FROM permisos
                                                WHERE Ambitos_idAmbitos = :idAmbito 
                                                  AND Objeto_idObjeto = :idObjeto
                                                ");
        $parametros = [
            'idAmbito' => $idAmbito,
            'idObjeto' => $idObjeto,
        ];
        $consulta_permiso_defecto->execute($parametros);
        $consulta_permiso_defecto = $consulta_permiso_defecto->fetchAll(PDO::FETCH_ASSOC);

        return($consulta_permiso_defecto);
    }catch(PDOException $e){
        return "Error: " . $e->getMessage();
    }
}