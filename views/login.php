<?php
// Requerim autenticacio al CAS
// Load the settings from the central config file
//require_once '../CAS/config.php';//despues descomentar---------------------------------------------
// Load the CAS lib
//require_once '../' . $phpcas_path . '/CAS.php'; //despues descomentar---------------------------------------------

// Enable debugging
//phpCAS::setDebug();//despues descomentar---------------------------------------------

// Initialize phpCAS
//phpCAS::client(CAS_VERSION_2_0, $cas_host, $cas_port, $cas_context); //despues descomentar---------------------------------------------

// For production use set the CA certificate that is the issuer of the cert
// on the CAS server and uncomment the line below
// phpCAS::setCasServerCACert($cas_server_ca_cert_path);

// For quick testing you can disable SSL validation of the CAS server.
// THIS SETTING IS NOT RECOMMENDED FOR PRODUCTION.
// VALIDATING THE CAS SERVER IS CRUCIAL TO THE SECURITY OF THE CAS PROTOCOL!
//phpCAS::setNoCasServerValidation(); ///despues descomentar---------------------------------------------

// force CAS authentication
//phpCAS::forceAuthentication(); //despues descomentar---------------------------------------------

// at this step, the user has been authenticated by the CAS server
// and the user's login name can be read with phpCAS::getUser().

// Identificar alumno
// Comprueba que phpCAS::getUser() es un usuario del sistema

//if(strlen(phpCAS::getUser()) == 7) {
    /*$_SESSION["niu"] = '1458707';//phpCAS::getUser(); //despues descomentar---------------------------------------------
    if(!empty($_GET['ed'])) {
        $versio = $_GET['ve'];
        $edicio = $_GET['ed'];
        $pla = $_GET['pla'];
        $assignatura = $_GET['as'];
        header("Refresh: 0; url=/silvia_visor_encuestas_v2/index.php?action=res&ve=$versio&ed=$edicio&pla=$pla&as=$assignatura");
    } else {
        header("Refresh:0; url=/silvia_visor_encuestas_v2/index.php?action=especifica_enquesta");
    }*/
//} else {
    // Si llega hasta aqui, aunque se haya autenticado bien, no esta en el sistema, lo deslogueamos y le denegamos el acceso
  //  phpCAS::logout();
//}
//include ("/../resources/title.html");/////moodificar include __DIR__ . "/resources/title.html";
//include __DIR__ . "/../resources/title.html";
?>
<!doctype html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="">
    <title>Visor d'enquestes UAB</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/offcanvas.css" rel="stylesheet">
    <link href="css/sticky-footer-navbar.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- JavaScript -->
    <script src="js/jquery-3.4.1.js"></script>
    <script src="js/functions.js"></script>
</head>
<body class="bg-light">
<?php include __DIR__ . "/../resources/title.html";
/*if (isset($_SESSION['niu']))
    var_dump($_SESSION['niu']);*/
?>

<div class="prod">
    <div id="contenedor">
        <br>
        <div class="contentForm">
            <form name="form-login" method="post" autocomplete="on" action="?action=login">
                <div id="contentDiv"><br><br>
                    <div><label for="user"> NIU:</label></div>
                    <div class="input"><input type="text" placeholder="&#128477" size="25" id="user" name="niu"></div>
                    <br><br>
                    <div class="input"> <input type="submit" name="submit" value="log in" ></div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>