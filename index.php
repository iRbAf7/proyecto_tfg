<?php
session_start();

$action = $_GET['action'] ?? null;
switch ($action) {
    case 'especifica_enquesta':
        include __DIR__.'/especifica_enquesta.php';
        break;
    case 'escollir_assignatura':
        include __DIR__.'/escollir_assignatura.php';
        break;
    case 'res':
        include __DIR__.'/consultar_resultats.php';
        break;
    case 'info_usuario':
        include __DIR__.'/info_usuario.php';
        break;
    case 'comparar_enquestes':
        include __DIR__.'/comparar_enquestes.php';
        break;
    case 'logout':
        include __DIR__.'/logout.php';
        break;
    default:
        include __DIR__ .'/login.php';
        break;
}
