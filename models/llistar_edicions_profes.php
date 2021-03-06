<?php
function llistar_edicions_profes($connection, $niu,$asig) {
    try{//updated ok ok
        if ($asig == ""){
            $check_edicions = $connection->prepare("SELECT DISTINCT edicions.nom, edicions.descripcio, edicions.anio_inicio,edicions.curs_academic
FROM edicions INNER JOIN resultats ON edicions.nom = resultats.nomEdicio
INNER JOIN grupo_has_asignaturas ON grupo_has_asignaturas.Asignaturas_idAsignaturas = resultats.Assignatura
AND grupo_has_asignaturas.anio_inicio = edicions.anio_inicio AND resultats.Grup =  grupo_has_asignaturas.Grupo_idGrupo
INNER JOIN profesores_has_grupo ON profesores_has_grupo.id_grupo_has_asig = grupo_has_asignaturas.id
WHERE profesores_has_grupo.Profesores_niu =:niu");
            $parametros = [
                'niu' => $niu,
            ];
        }else{
            $check_edicions = $connection->prepare("SELECT DISTINCT edicions.nom, edicions.descripcio, edicions.anio_inicio,edicions.curs_academic
FROM edicions INNER JOIN resultats ON edicions.nom = resultats.nomEdicio
INNER JOIN grupo_has_asignaturas ON grupo_has_asignaturas.Asignaturas_idAsignaturas = resultats.Assignatura
AND grupo_has_asignaturas.anio_inicio = edicions.anio_inicio AND resultats.Grup =  grupo_has_asignaturas.Grupo_idGrupo
INNER JOIN profesores_has_grupo ON profesores_has_grupo.id_grupo_has_asig = grupo_has_asignaturas.id
WHERE profesores_has_grupo.Profesores_niu =:niu
AND resultats.Assignatura =:idAsig ");
            $parametros = [
                'niu' => $niu,
                'idAsig'=>$asig,
            ];
        }

        $check_edicions->execute($parametros);
        $result_edicions = $check_edicions->fetchAll(PDO::FETCH_ASSOC);
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
    return($result_edicions);
}

