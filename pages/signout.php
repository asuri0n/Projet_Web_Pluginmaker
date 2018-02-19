<?php
/**
 * Created by PhpStorm.
 * User: asuri
 * Date: 05/02/2018
 * Time: 22:08
 */

unset($_SESSION['Auth']);
echo "<script>toast('Vous êtes mainetnant déconnecté', 'success', 'Ok', 5000)</script>";
session_write_close();
header('location: accueil');