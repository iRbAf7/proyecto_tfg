<?php
function llistar_edicions($connection) {
    try{
        $check_edicions = $connection->prepare("SELECT * FROM edicions");
        $check_edicions->execute();
        $result_edicions = $check_edicions->fetchAll(PDO::FETCH_ASSOC);
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
    return($result_edicions);
}
