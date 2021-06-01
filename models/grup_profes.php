<?php
function grup_profes($connection,$anio, $nomEdicio,$niu, $PlaPropietari, $Assignatura) {
    try {//actualizadoo
        if($PlaPropietari == "0"){
            $query = $connection->prepare("SELECT DISTINCT resultats.Grup AS '0'
FROM resultats
INNER JOIN grupo_has_asignaturas ON resultats.Grup = grupo_has_asignaturas.Grupo_idGrupo
AND resultats.Assignatura = grupo_has_asignaturas.Asignaturas_idAsignaturas
INNER JOIN profesores_has_grupo ON profesores_has_grupo.id_grupo_has_asig = grupo_has_asignaturas.id
WHERE resultats.nomEdicio = :nomEdicio 
AND resultats.Assignatura = :Assignatura 
AND profesores_has_grupo.Profesores_niu = :niu
AND grupo_has_asignaturas.anio_inicio =:anio");
            $parameters = [
                'nomEdicio' => $nomEdicio,
                'Assignatura' => $Assignatura,
                'niu' => $niu,
                'anio' => $anio
            ];
        }else{
            $query = $connection->prepare("SELECT DISTINCT resultats.Grup AS '0'
FROM resultats
INNER JOIN grupo_has_asignaturas ON resultats.Grup = grupo_has_asignaturas.Grupo_idGrupo
AND resultats.Assignatura = grupo_has_asignaturas.Asignaturas_idAsignaturas
INNER JOIN profesores_has_grupo ON profesores_has_grupo.id_grupo_has_asig = grupo_has_asignaturas.id
WHERE resultats.nomEdicio = :nomEdicio 
AND resultats.Assignatura = :Assignatura 
AND resultats.PlaPropietari = :pla
AND profesores_has_grupo.Profesores_niu = :niu
AND grupo_has_asignaturas.anio_inicio =:anio");
            $parameters = [
                'nomEdicio' => $nomEdicio,
                'pla' => $PlaPropietari,
                'Assignatura' => $Assignatura,
                'niu' => $niu,
                'anio' => $anio
            ];
        }




        $query->execute($parameters);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($results);
}
