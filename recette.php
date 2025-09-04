<?php
require 'Modele.php';

try {
    if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if ($id !=0) {
        $recette = getRecette($id);
        require 'recette.php';
    } else {
        throw new Exception("Identifiant de recette incorrect");
    } else
        throw new Exception("Identifiant de recette non défini");
} catch (Exception $e) {
    $msgErreur = $e->getMessage();
    require 'vueErreur.php';
}