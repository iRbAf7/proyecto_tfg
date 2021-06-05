<?php
function obert_tot($connection, $AssigGXX, $nomEdicio,$pla, $Assignatura) {
    try {//modificado con el plan academico, es decir, el estudio correspondiente
        if ($pla != '0'){
            $query = $connection->prepare("SELECT DISTINCT $AssigGXX AS '0' FROM resultats
                                        WHERE nomEdicio = :nomEdicio 
                                        and Assignatura = :Assignatura
                                        and PlaPropietari = :pla
                                        and $AssigGXX <> ''");
            $parameters = [
                'nomEdicio' => $nomEdicio,
                'Assignatura' => $Assignatura,
                'pla' => $pla,
            ];
        }else{
            $query = $connection->prepare("SELECT DISTINCT $AssigGXX AS '0' FROM resultats
                                        WHERE nomEdicio = :nomEdicio 
                                        and Assignatura = :Assignatura                                      
                                        and $AssigGXX <> ''");
            $parameters = [
                'nomEdicio' => $nomEdicio,
                'Assignatura' => $Assignatura,
            ];
        }

        $query->execute($parameters);
        $result_data = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($result_data);
}