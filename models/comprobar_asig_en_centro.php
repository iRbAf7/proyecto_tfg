<?php
function comprobar_asig_en_centro($connection, $idEstudi,$idAsignatura) {
        try {
            $existe_asig = $connection->prepare("SELECT count(1)
                                            FROM resultats
                                            WHERE PlaPropietari = '$idEstudi' AND Assignatura = '$idAsignatura'");
            /*$parametros = [
                'idEstudi' => $idEstudi,
                'idAsig' => $idAsignatura,
            ];*/

            $existe_asig->execute();
            $existe_asig = $existe_asig->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    return ($existe_asig);
}