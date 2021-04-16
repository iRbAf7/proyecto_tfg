<?php
function comprobar_permiso_ambito($conexion,$ambito, $idObjeto){
    try{
        $consulta_idAmbito = $conexion->prepare("SELECT idAmbitos
                                                FROM ambitos
                                                WHERE nom = :ambito");
        $parametros = [
            'ambito' => $ambito,
        ];
        $consulta_idAmbito->execute($parametros);
        $consulta_idAmbito = $consulta_idAmbito->fetchAll(PDO::FETCH_ASSOC);

        $consultar_permiso = $conexion->prepare("SELECT nivel
                                                FROM permisos
                                                WHERE Objeto_idObjeto =:idObjeto
                                                AND  Ambitos_idAmbitos =:idAmbito");

        $parametros = [
            'idAmbito' => $consulta_idAmbito[0]['idAmbitos'],
            'idObjeto' => $idObjeto,
        ];

        $consultar_permiso->execute($parametros);
        $consultar_permiso = $consultar_permiso->fetchAll(PDO::FETCH_ASSOC);


        return($consultar_permiso[0]['nivel']);
    }catch(PDOException $e){
        return "Error: " . $e->getMessage();
    }
}