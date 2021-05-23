<?php
function connection() {
    $server = "localhost"; $user = "root"; $password = "12345"; $database = "v2_permisos_encuestas";
    try{
        $connection = new PDO("mysql:host=$server;dbname=$database;charset=UTF8", $user, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
    return($connection);
}
