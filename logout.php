<?php
// Requerim autenticacio al CAS
// Load the settings from the central config file
/*
require_once '../CAS/config.php';
// Load the CAS lib
require_once '../' . $phpcas_path . '/CAS.php';

// Enable debugging
phpCAS::setDebug();

// Initialize phpCAS
phpCAS::client(CAS_VERSION_2_0, $cas_host, $cas_port, $cas_context);

// Hace logout
phpCAS::logout();*/
session_destroy();
header("Refresh:0; url=/silvia_visor_encuestas_v2/login.php");
