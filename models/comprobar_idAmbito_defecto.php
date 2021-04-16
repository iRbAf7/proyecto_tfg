<?php
function comprobar_idAmbito_defecto($conexion,$ambito_defecto){
    try{
        $consulta_idAmbito_defecto = $conexion->prepare("SELECT idAmbitos
                                                FROM ambitos
                                                WHERE nom = :ambito_defecto                                             
                                                ");
        $parametros = [
            'ambito_defecto' => $ambito_defecto,
        ];
        $consulta_idAmbito_defecto->execute($parametros);
        $consulta_idAmbito_defecto = $consulta_idAmbito_defecto->fetchAll(PDO::FETCH_ASSOC);

        return($consulta_idAmbito_defecto);
    }catch(PDOException $e){
        return "Error: " . $e->getMessage();
    }
}