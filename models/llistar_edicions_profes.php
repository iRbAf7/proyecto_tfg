<?php
/*
function llistar_edicions_profes($connection, $niu) {
    try{
        $check_anio = $connection->prepare("SELECT DISTINCT anio_inicio
                                            FROM `profesores_has_asignaturas`
                                            WHERE profesores_niu =  $niu
                                                ");
        $check_anio->execute();
        $check_anio = $check_anio->fetchAll(PDO::FETCH_ASSOC);
        if(sizeof($check_anio) > 1){
            $list = ['2018','2019'];
            $check_edicions = $connection->prepare("SELECT DISTINCT edicions.nom, edicions.descripcio
                                                FROM edicions INNER JOIN resultats ON edicions.nom = resultats.nomEdicio
                                                INNER JOIN profesores_has_asignaturas ON profesores_has_asignaturas.asignaturas_idAsignaturas = resultats.Assignatura
                                                INNER JOIN anio ON anio.inicio = profesores_has_asignaturas.anio_inicio
                                                WHERE profesores_has_asignaturas.profesores_niu = $niu
                                                AND edicions.curs_academic REGEXP '$list[0]/' ".for ($i=0 ;$i<sizeof($list);$i++){
                                                   ."OR edicions.curs_academic REGEXP '2019/'" .""
                                                    }."

                                                ");
        }else{
            $tmp = $check_anio[0]['anio_inicio'];
            $check_edicions = $connection->prepare("SELECT DISTINCT edicions.nom, edicions.descripcio
                                                FROM edicions INNER JOIN resultats ON edicions.nom = resultats.nomEdicio
                                                INNER JOIN profesores_has_asignaturas ON profesores_has_asignaturas.asignaturas_idAsignaturas = resultats.Assignatura
                                                INNER JOIN anio ON anio.inicio = profesores_has_asignaturas.anio_inicio
                                                WHERE profesores_has_asignaturas.profesores_niu = $niu
                                                AND edicions.curs_academic REGEXP '$tmp/'                                
                                                ");
        }


        $check_edicions->execute();
        $result_edicions = $check_anio->fetchAll(PDO::FETCH_ASSOC);
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
    return($result_edicions);
}*/

function llistar_edicions_profes($connection, $niu) {
    try{//updated
        $check_edicions = $connection->prepare("SELECT DISTINCT edicions.nom, edicions.descripcio, edicions.anio_inicio
FROM edicions INNER JOIN resultats ON edicions.nom = resultats.nomEdicio
INNER JOIN grupo_has_asignaturas ON grupo_has_asignaturas.Asignaturas_idAsignaturas = resultats.Assignatura
AND grupo_has_asignaturas.anio_inicio = edicions.anio_inicio
INNER JOIN profesores_has_grupo ON profesores_has_grupo.id_grupo_has_asig = grupo_has_asignaturas.id
WHERE profesores_has_grupo.Profesores_niu = $niu
                                                ");

        /*
         * SELECT DISTINCT edicions.nom, edicions.descripcio, edicions.anio_inicio
FROM edicions INNER JOIN resultats ON edicions.nom = resultats.nomEdicio
INNER JOIN profesores_has_asignaturas ON profesores_has_asignaturas.asignaturas_idAsignaturas = resultats.Assignatura
AND profesores_has_asignaturas.anio_inicio = edicions.anio_inicio
WHERE profesores_has_asignaturas.profesores_niu = $niu
         * */
        $check_edicions->execute();
        $result_edicions = $check_edicions->fetchAll(PDO::FETCH_ASSOC);
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
    return($result_edicions);
}

