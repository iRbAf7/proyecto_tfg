<?php
function llistar_models($connection) {
    try{
        $check_models = $connection->prepare("SELECT * FROM models");
        $check_models->execute();
        $result_models = $check_models->fetchAll(PDO::FETCH_ASSOC);
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
    return($result_models);
}
