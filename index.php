<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();


$filename = $_GET['filename'];

$allowedPages = array(
    'dashboard',
    'records-inhabitants',
    'request-forms',
    'records-business',
    'businesses',
    'records-lumpong-Tagapamaya',
    'settings',
    'contacts',
    'login',
    'home',
    'aboutUs',
    'joinTeam',
    'questions',
    'signin',
    'register',
    'donate',
    'addProduct',
    'cart',
    'orders',
    'profile'
);
if (in_array($filename, $allowedPages)) {
    $filePath = "tpl/$filename/$filename.tpl.php";
    if (file_exists($filePath)) {
        require $filePath;
        exit();
    } else {
        header('HTTP/1.0 404 Not Found');
        include 'tpl/page_not_found.tpl.php';
        exit();
    }
}

include 'tpl/home/home.tpl.php';
?>
