<?php
function consulta_graus_estudis($connection, $idEstudi, $nomEdicio) {
    try {//no hace falta modificar
        if ($nomEdicio == ""){
            $graus_estudis = $connection->prepare("SELECT DISTINCT estudios.idEstudio,estudios.nombre 
                                        FROM estudios INNER JOIN resultats ON resultats.PlaPropietari = estudios.idEstudio
                                        WHERE  estudios.idEstudio =:idEstudi
                                        ORDER BY estudios.nombre ASC");
            //esta consulta devuelve el nombre del estudio que le pasas
            //ya que desde la pagina anterior solo recibimos el id del estudio,
            //pero necesitamos el nombre para mostrarlo en la vista, auqnue parezca redundante se ha de hacer
            $parametros = [
                'idEstudi' => $idEstudi,
            ];
        }else{
            $graus_estudis = $connection->prepare("SELECT DISTINCT estudios.idEstudio,estudios.nombre 
                                        FROM estudios INNER JOIN resultats ON resultats.PlaPropietari = estudios.idEstudio
                                        WHERE  estudios.idEstudio =:idEstudi AND resultats.nomEdicio =:edicio
                                        ORDER BY estudios.nombre ASC");
            $parametros = [
                'idEstudi' => $idEstudi,
                'edicio' => $nomEdicio,
            ];
        }


        $graus_estudis->execute($parametros);
        $graus_estudis = $graus_estudis->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($graus_estudis);
}
