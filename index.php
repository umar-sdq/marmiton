<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'Modele.php';
try {
    $recettes = getRecettes();
    require 'vueAcceuil.php';
}  catch (Exception $e) {
    $msgErreur = $e->getMessage();
    require 'vueErreur.php';
}