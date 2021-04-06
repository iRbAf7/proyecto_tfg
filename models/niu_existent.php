<?php
function niu_existent($connection, $niu)
{
    try{
        $consulta = $connection->prepare('SELECT * FROM profesores WHERE niu = :id');
        $parametros = [
            'id' => $niu,
        ];

        $consulta->execute($parametros);
        $consulta = $consulta->fetchAll(PDO::FETCH_ASSOC);

    }catch(PDOException $e){
        return "Error: " . $e->getMessage();
    }
    return($consulta);
    /*try {
        $check = $connection->prepare("SELECT 1 FROM usuaris WHERE niu = :niu");
        $parameters = [
            'niu' => $niu,
        ];
        $check->execute($parameters);
        $result = $check->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($result);*/
}