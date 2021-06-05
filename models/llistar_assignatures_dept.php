<?php
function llistar_assignatures_dept($connection, $idDept,$nomEdicio, $PlaPropietari) {
    try {//updated okk
        if ($PlaPropietari == "0"){
            $graus_dept = $connection->prepare("
           SELECT DISTINCT resultats.Assignatura, asignaturas.nombre 
FROM (
            SELECT Profesores_niu
            FROM departamentos_has_profesores
            WHERE Departamentos_idDepartamentos =:idDept) as res
INNER JOIN profesores_has_grupo ON profesores_has_grupo.Profesores_niu = res.Profesores_niu
INNER JOIN grupo_has_asignaturas ON profesores_has_grupo.id_grupo_has_asig = grupo_has_asignaturas.id
INNER JOIN resultats ON resultats.Grup =  grupo_has_asignaturas.Grupo_idGrupo AND grupo_has_asignaturas.Asignaturas_idAsignaturas = resultats.Assignatura
INNER JOIN asignaturas ON resultats.Assignatura = asignaturas.idAsignaturas
INNER JOIN edicions ON edicions.nom = resultats.nomEdicio AND grupo_has_asignaturas.anio_inicio = edicions.anio_inicio
WHERE edicions.nom =:nomEdicio");
            $parametros = [
                'idDept' => $idDept,
                'nomEdicio' => $nomEdicio,
            ];
        }
        else{
            if($nomEdicio == ""){
                $graus_dept = $connection->prepare("
                SELECT DISTINCT resultats.Assignatura, asignaturas.nombre 
FROM (
            SELECT Profesores_niu
            FROM departamentos_has_profesores
            WHERE Departamentos_idDepartamentos =:idDept) as res
INNER JOIN profesores_has_grupo ON profesores_has_grupo.Profesores_niu = res.Profesores_niu
INNER JOIN grupo_has_asignaturas ON profesores_has_grupo.id_grupo_has_asig = grupo_has_asignaturas.id
INNER JOIN resultats ON resultats.Grup =  grupo_has_asignaturas.Grupo_idGrupo AND grupo_has_asignaturas.Asignaturas_idAsignaturas = resultats.Assignatura
INNER JOIN asignaturas ON resultats.Assignatura = asignaturas.idAsignaturas
INNER JOIN edicions ON edicions.nom = resultats.nomEdicio AND grupo_has_asignaturas.anio_inicio = edicions.anio_inicio
WHERE resultats.PlaPropietari =:PlaPropietari
                                        ");
                $parametros = [
                    'idDept' => $idDept,
                    'PlaPropietari' => $PlaPropietari,
                ];
            }else {
                $graus_dept = $connection->prepare("
                SELECT DISTINCT resultats.Assignatura, asignaturas.nombre 
FROM (
            SELECT Profesores_niu
            FROM departamentos_has_profesores
            WHERE Departamentos_idDepartamentos =:idDept) as res
INNER JOIN profesores_has_grupo ON profesores_has_grupo.Profesores_niu = res.Profesores_niu
INNER JOIN grupo_has_asignaturas ON profesores_has_grupo.id_grupo_has_asig = grupo_has_asignaturas.id
INNER JOIN resultats ON resultats.Grup =  grupo_has_asignaturas.Grupo_idGrupo AND grupo_has_asignaturas.Asignaturas_idAsignaturas = resultats.Assignatura
INNER JOIN asignaturas ON resultats.Assignatura = asignaturas.idAsignaturas
INNER JOIN edicions ON edicions.nom = resultats.nomEdicio AND grupo_has_asignaturas.anio_inicio = edicions.anio_inicio
WHERE edicions.nom =:nomEdicio
AND resultats.PlaPropietari =:PlaPropietari
                                        ");
                $parametros = [
                    'idDept' => $idDept,
                    'nomEdicio' => $nomEdicio,
                    'PlaPropietari' => $PlaPropietari,
                ];
            }
        }



        $graus_dept->execute($parametros);
        $graus_dept = $graus_dept->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($graus_dept);
}
