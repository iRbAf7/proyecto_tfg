<?php
function llistar_assignatures_dept($connection, $idDept,$nomEdicio, $PlaPropietari) {
    try {//updated
        if ($PlaPropietari == "0"){
            $graus_dept = $connection->prepare("
            SELECT DISTINCT resultats.Assignatura, asignaturas.nombre 
FROM resultats INNER JOIN asignaturas ON resultats.Assignatura = asignaturas.idAsignaturas
INNER JOIN grupo_has_asignaturas ON grupo_has_asignaturas.Asignaturas_idAsignaturas = asignaturas.idAsignaturas
INNER JOIN profesores_has_grupo ON profesores_has_grupo.id_grupo_has_asig = grupo_has_asignaturas.id 
INNER JOIN departamentos_has_profesores ON departamentos_has_profesores.Profesores_niu = profesores_has_grupo.Profesores_niu
WHERE resultats.nomEdicio = :nomEdicio
AND departamentos_has_profesores.Departamentos_idDepartamentos = :idDept
ORDER BY asignaturas.nombre ASC");
            $parametros = [
                'idDept' => $idDept,
                'nomEdicio' => $nomEdicio,
            ];
        }
        else{
            if($nomEdicio == ""){
                $graus_dept = $connection->prepare("
                SELECT DISTINCT resultats.Assignatura, asignaturas.nombre 
FROM resultats INNER JOIN asignaturas ON resultats.Assignatura = asignaturas.idAsignaturas
INNER JOIN grupo_has_asignaturas ON grupo_has_asignaturas.Asignaturas_idAsignaturas = asignaturas.idAsignaturas
INNER JOIN profesores_has_grupo ON profesores_has_grupo.id_grupo_has_asig = grupo_has_asignaturas.id 
INNER JOIN departamentos_has_profesores ON departamentos_has_profesores.Profesores_niu = profesores_has_grupo.Profesores_niu
WHERE resultats.PlaPropietari = :PlaPropietari 
AND departamentos_has_profesores.Departamentos_idDepartamentos = :idDept
ORDER BY asignaturas.nombre ASC
                                        ");
                $parametros = [
                    'idDept' => $idDept,
                    'PlaPropietari' => $PlaPropietari,
                ];
            }else {
                $graus_dept = $connection->prepare("
                SELECT DISTINCT resultats.Assignatura, asignaturas.nombre 
FROM resultats INNER JOIN asignaturas ON resultats.Assignatura = asignaturas.idAsignaturas
INNER JOIN grupo_has_asignaturas ON grupo_has_asignaturas.Asignaturas_idAsignaturas = asignaturas.idAsignaturas
INNER JOIN profesores_has_grupo ON profesores_has_grupo.id_grupo_has_asig = grupo_has_asignaturas.id 
INNER JOIN departamentos_has_profesores ON departamentos_has_profesores.Profesores_niu = profesores_has_grupo.Profesores_niu
WHERE resultats.nomEdicio = :nomEdicio
AND resultats.PlaPropietari = :PlaPropietari
AND departamentos_has_profesores.Departamentos_idDepartamentos = :idDept
ORDER BY asignaturas.nombre ASC
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
