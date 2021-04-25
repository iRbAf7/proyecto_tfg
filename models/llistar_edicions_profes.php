<?php
function llistar_edicions_profes($connection, $niu) {
    try{
        $check_edicions = $connection->prepare("SELECT DISTINCT edicions.nom, edicions.descripcio
                                                FROM edicions INNER JOIN resultats ON edicions.nom = resultats.nomEdicio
                                                INNER JOIN profesores_has_asignaturas ON profesores_has_asignaturas.asignaturas_idAsignaturas = resultats.Assignatura
                                                WHERE profesores_has_asignaturas.profesores_niu = $niu
                                                ");

        $check_edicions->execute();
        $result_edicions = $check_edicions->fetchAll(PDO::FETCH_ASSOC);
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
    return($result_edicions);
}
