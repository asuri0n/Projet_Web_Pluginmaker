<?php
/**
 * Created by PhpStorm.
 * User: asuri
 * Date: 15/02/2018
 * Time: 12:20
 */

$auth_token = "Mt_7Tj1adwaaZ_ljzusbbF8ltCoRyjnvKf13p3x4DtzJewkw2Kceqw-Pl9W";

if(!isset($_GET['plugin']) or !isset($_GET['auth_token']) or $_GET['auth_token'] != $auth_token){
    $_SESSION['error'] = "Vous n'avez pas acces a cette page!";
    session_write_close();
    header('location: /accueil');
}

$plugin = $_GET['plugin'];

header("Content-type: application/zip");
header("Content-Disposition: attachment; filename=plugins/$plugin.zip");
header("Pragma: no-cache");
header("Expires: 0");
readfile("plugins/$plugin.zip");