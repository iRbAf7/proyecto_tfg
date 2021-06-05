<?php
function llistar_edicions_depts($connection, $idDept, $asig) {
    try{//updated okk okk(ajax)
        if ($asig == ""){
            $check_edicions = $connection->prepare("SELECT DISTINCT edicions.nom, edicions.descripcio, edicions.anio_inicio
FROM (
            SELECT Profesores_niu
            FROM departamentos_has_profesores
            WHERE Departamentos_idDepartamentos =:idDept) as res
INNER JOIN profesores_has_grupo ON profesores_has_grupo.Profesores_niu = res.Profesores_niu
INNER JOIN grupo_has_asignaturas ON profesores_has_grupo.id_grupo_has_asig = grupo_has_asignaturas.id
INNER JOIN resultats ON resultats.Grup =  grupo_has_asignaturas.Grupo_idGrupo AND grupo_has_asignaturas.Asignaturas_idAsignaturas = resultats.Assignatura
INNER JOIN edicions ON edicions.nom = resultats.nomEdicio AND grupo_has_asignaturas.anio_inicio = edicions.anio_inicio
                                                ");

            $parametros = [
                'idDept' => $idDept,
            ];
        }else{
            $check_edicions = $connection->prepare("SELECT DISTINCT edicions.nom, edicions.descripcio, edicions.anio_inicio, edicions.curs_academic
FROM (
            SELECT Profesores_niu
            FROM departamentos_has_profesores
            WHERE Departamentos_idDepartamentos =:idDept) as res
INNER JOIN profesores_has_grupo ON profesores_has_grupo.Profesores_niu = res.Profesores_niu
INNER JOIN grupo_has_asignaturas ON profesores_has_grupo.id_grupo_has_asig = grupo_has_asignaturas.id
INNER JOIN resultats ON resultats.Grup =  grupo_has_asignaturas.Grupo_idGrupo AND grupo_has_asignaturas.Asignaturas_idAsignaturas = resultats.Assignatura
INNER JOIN edicions ON edicions.nom = resultats.nomEdicio AND grupo_has_asignaturas.anio_inicio = edicions.anio_inicio
WHERE resultats.Assignatura =:idAsig
                                                ");

            $parametros = [
                'idDept' => $idDept,
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