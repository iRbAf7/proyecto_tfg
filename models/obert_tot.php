<?php
function obert_tot($connection, $AssigGXX, $nomEdicio,$pla, $Assignatura, $grup) {
    try {//modificado con el plan academico, es decir, el estudio correspondiente
        if ($grup == "Tots" || $grup == "Tots els meus" || $grup == "Tots els seus"){
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
        }else{//se muestren los resultados del grupo que se pase como parametro
            if ($pla != '0'){
                $query = $connection->prepare("SELECT DISTINCT $AssigGXX AS '0' FROM resultats
                                        WHERE nomEdicio = :nomEdicio 
                                        AND Assignatura = :Assignatura
                                        AND PlaPropietari = :pla
                                        AND $AssigGXX <> ''
                                        AND Grup = :grup");
                $parameters = [
                    'nomEdicio' => $nomEdicio,
                    'Assignatura' => $Assignatura,
                    'pla' => $pla,
                    'grup' => $grup,
                ];
            }else{
                $query = $connection->prepare("SELECT DISTINCT $AssigGXX AS '0' FROM resultats
                                        WHERE nomEdicio = :nomEdicio 
                                        AND Assignatura = :Assignatura                                      
                                        AND $AssigGXX <> ''
                                        AND Grup = :grup");
                $parameters = [
                    'nomEdicio' => $nomEdicio,
                    'Assignatura' => $Assignatura,
                    'grup' => $grup,
                ];
            }
        }


        $query->execute($parameters);
        $result_data = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($result_data);
}