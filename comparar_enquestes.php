<!doctype html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">

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
<?php include __DIR__ . "/resources/title.html"; ?>

<?php include __DIR__ . "/resources/navigator.html"; ?>

<div class="container">
    <?php include __DIR__ . "/controllers/comparar_enquestes.php"; ?>
</div>

<?php include __DIR__ . "/resources/footer.html"; ?>
</body>
</html>