<?php

require 'Modele.php';

try {
    if (isset($_POST['recette_id'])) {
        $id = intval($_POST['recette_id']);
        if ($id !=0) {
            $recette = getRecette($id);
            $ingredients $_POST
        } else {
            throw new Exception("Identifiant de recette incorrect");
        } 
    } else {
        throw new Exception("Identifiant de recette non défini");
    }
}  catch (Exception $e) {
    $msgErreur = $e->getMessage();
    require 'vueErreur.php';
}