
<?php
require_once("models/connection.php");
require_once("models/preguntes.php");
require_once("models/ediciones_de_asig.php");
require_once("models/llistar_versions.php");

$version = llistar_versions(connection());
if($_POST['assignatura']){
    $preguntes = preguntes(connection(), $version[0]['nom']);
    $ediciones = ediciones_de_asig(connection(), $_POST['assignatura']);

}


require("views/tabla_compare.php");
?>

