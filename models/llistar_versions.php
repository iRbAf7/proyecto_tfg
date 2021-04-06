<?php
function llistar_versions($connection) {
    try {
        $check_versions = $connection->prepare("SELECT * FROM versions");
        $check_versions->execute();
        $result_versions = $check_versions->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    return ($result_versions);
}
