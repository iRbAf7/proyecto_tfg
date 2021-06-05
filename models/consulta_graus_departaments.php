<?php
function consulta_graus_departaments($connection, $idDept,$nomEdicio) {
    try {//updated ok
        if($nomEdicio == ""){
            $graus_dept = $connection->prepare("
                SELECT   DISTINCT estudios.idEstudio,estudios.nombre, profesores_has_grupo.Profesores_niu
FROM 
           ( SELECT Profesores_niu
            FROM departamentos_has_profesores
            WHERE Departamentos_idDepartamentos =:idDept) as res
INNER JOIN profesores_has_grupo ON profesores_has_grupo.Profesores_niu = res.Profesores_niu
INNER JOIN grupo_has_asignaturas ON profesores_has_grupo.id_grupo_has_asig = grupo_has_asignaturas.id
INNER JOIN resultats ON resultats.Grup =  grupo_has_asignaturas.Grupo_idGrupo AND grupo_has_asignaturas.Asignaturas_idAsignaturas = resultats.Assignatura
INNER JOIN estudios ON resultats.PlaPropietari = estudios.idEstudio   
 ORDER BY estudios.nombre ASC
            ");
            $parametros = [
                'idDept' => $idDept,
            ];
        }else{
            $graus_dept = $connection->prepare("
                SELECT   DISTINCT estudios.idEstudio,estudios.nombre, profesores_has_grupo.Profesores_niu
FROM 
           ( SELECT Profesores_niu
            FROM departamentos_has_profesores
            WHERE Departamentos_idDepartamentos =:idDept) as res
INNER JOIN profesores_has_grupo ON profesores_has_grupo.Profesores_niu = res.Profesores_niu
INNER JOIN grupo_has_asignaturas ON profesores_has_grupo.id_grupo_has_asig = grupo_has_asignaturas.id
INNER JOIN resultats ON resultats.Grup =  grupo_has_asignaturas.Grupo_idGrupo AND grupo_has_asignaturas.Asignaturas_idAsignaturas = resultats.Assignatura
INNER JOIN estudios ON resultats.PlaPropietari = estudios.idEstudio
WHERE resultats.nomEdicio =:nomEdicio                
 ORDER BY estudios.nombre ASC
            ");

            $parametros = [
                'idDept' => $idDept,
                'nomEdicio'=> $nomEdicio,
            ];
        }


        $graus_dept->execute($parametros);
        $graus_dept = $graus_dept->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($graus_dept);
}
