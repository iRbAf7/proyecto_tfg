<?php
function comprobar_permiso_ambito($conexion,$ambito){
    try{
        $consulta_idAmbito = $conexion->prepare("SELECT idAmbitos
                                                FROM ambitos
                                                WHERE nom = :ambito");
        $parametros = [
            'ambito' => $ambito,
        ];
        $consulta_idAmbito->execute($parametros);
        $consulta_idAmbito = $consulta_idAmbito->fetchAll(PDO::FETCH_ASSOC);

        $consultar_permiso = $conexion->prepare("SELECT cargos.descripcion, ambitos.nom
                                                FROM cargos_has_profesores INNER JOIN cargos 
                                                ON cargos_has_profesores.Cargos_idCargos = cargos.idCargos
                                                INNER JOIN ambitos
                                                ON cargos.Ambitos_idAmbitos = ambitos.idAmbitos
                                                WHERE cargos_has_profesores.Profesores_niu = :niu");

        $parametros = [
            'ambito' => $ambito,
        ];

        $consultar_permiso->execute($parametros);
        $consultar_permiso = $consultar_permiso->fetchAll(PDO::FETCH_ASSOC);


        return($consultar_permiso);
    }catch(PDOException $e){
        return "Error: " . $e->getMessage();
    }
}