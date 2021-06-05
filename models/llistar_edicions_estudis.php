<?php
function llistar_edicions_estudis($connection, $idEstudi, $asig) {
    try{//updated okk
        if ($asig == ""){
            $check_edicions = $connection->prepare("SELECT DISTINCT edicions.nom, edicions.descripcio, edicions.anio_inicio,edicions.curs_academic
FROM resultats INNER JOIN edicions ON edicions.nom = resultats.nomEdicio
INNER JOIN estudios ON estudios.idEstudio = resultats.PlaPropietari 
WHERE  estudios.idEstudio =:idEstudi
ORDER BY edicions.nom ASC
                                                ");

            $parametros = [
                'idEstudi' => $idEstudi,
            ];
        }else{
            $check_edicions = $connection->prepare("SELECT DISTINCT edicions.nom, edicions.descripcio, edicions.anio_inicio,edicions.curs_academic
FROM resultats INNER JOIN edicions ON edicions.nom = resultats.nomEdicio
INNER JOIN estudios ON estudios.idEstudio = resultats.PlaPropietari 
WHERE  estudios.idEstudio =:idEstudi AND resultats.Assignatura =:idAsig
ORDER BY edicions.nom ASC
                                                ");

            $parametros = [
                'idEstudi' => $idEstudi,
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