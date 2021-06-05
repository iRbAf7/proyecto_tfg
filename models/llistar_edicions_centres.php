<?php
function llistar_edicions_centres($connection, $idCentro, $asig) {
    try{//updated okk
        if ($asig == ""){
            $check_edicions = $connection->prepare("SELECT DISTINCT edicions.nom, edicions.descripcio, edicions.anio_inicio,edicions.curs_academic
FROM resultats INNER JOIN edicions ON edicions.nom = resultats.nomEdicio
INNER JOIN centros ON centros.idCentro = resultats.CentrePropietari 
WHERE  centros.idCentro =:idCentro
ORDER BY edicions.nom ASC
                                                ");

            $parametros = [
                'idCentro' => $idCentro,
            ];
        }else{
            $check_edicions = $connection->prepare("SELECT DISTINCT edicions.nom, edicions.descripcio, edicions.anio_inicio,edicions.curs_academic
FROM resultats INNER JOIN edicions ON edicions.nom = resultats.nomEdicio
INNER JOIN centros ON centros.idCentro = resultats.CentrePropietari 
WHERE  centros.idCentro =:idCentro AND resultats.Assignatura =:idAsig
ORDER BY edicions.nom ASC
                                                ");

            $parametros = [
                'idCentro' => $idCentro,
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