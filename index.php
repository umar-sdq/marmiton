// index.php
<?php

require 'Controlleur/Controlleur.php';

try {
    if (isset($_GET['action'])) {

        // Afficher une recette
        if ($_GET['action'] == 'recette') {
            if (isset($_GET['id'])) {
                // intval renvoie la valeur numérique du paramètre ou 0 en cas d'échec
                $id = intval($_GET['id']);
                if ($id != 0) {
                    $erreur = isset($_GET['erreur']) ? $_GET['erreur'] : '';
                    recette($id, $erreur);
                } else
                    throw new Exception("Identifiant d'article incorrect");
            } else
                throw new Exception("Aucun identifiant d'article");

            // Ajouter un ingredient
        } else if ($_GET['action'] == 'ingredient') {
            if (isset($_POST['recette_id'])) {
                // intval renvoie la valeur numérique du paramètre ou 0 en cas d'échec
                $id = intval($_POST['recette_id']);
                if ($id != 0) {
                    // vérifier si l'article existe;
                    $recette = getRecette($id);
                    // Récupérer les données du formulaire
                    $ingredient = $_POST;
                    //Réaliser l'action commentaire du contrôleur
                    ingredient($ingredient);
                } else
                    throw new Exception("Identifiant d'article incorrect");
            } else
                throw new Exception("Aucun identifiant d'article");

            // Confirmer la suppression
        } else if ($_GET['action'] == 'confirmer') {
            if (isset($_GET['id'])) {
                // intval renvoie la valeur numérique du paramètre ou 0 en cas d'échec
                $id = intval($_GET['id']);
                if ($id != 0) {
                    confirmer($id);
                } else
                    throw new Exception("Identifiant de commentaire incorrect");
            } else
                throw new Exception("Aucun identifiant de commentaire");

                } else if ($_GET['action'] == 'nouvelle') {
            nouvelle();

        } else if ($_GET['action'] == 'enregistrerRecette') {
            // POST only
            if (!empty($_POST['titre'])) {
                enregistrerRecette($_POST);
            } else {
                throw new Exception("Titre requis");
            }        
            // Supprimer un commentaire

        } else if ($_GET['action'] == 'carteRecette') {
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        if ($id != 0) {
            carteRecette($id);
        } else {
            throw new Exception("Identifiant de recette incorrect");
        }
    }    
        } else if ($_GET['action'] == 'supprimer') {
            if (isset($_POST['id'])) {
                // intval renvoie la valeur numérique du paramètre ou 0 en cas d'échec
                $id = intval($_POST['id']);
                if ($id != 0) {
                    supprimer($id);
                } else
                    throw new Exception("Identifiant de commentaire incorrect");
            } else
                throw new Exception("Aucun identifiant de commentaire");
        } else {
            // Action mal définie
            throw new Exception("Action non valide");
        }

    // Action par défaut
    } else {
        accueil();  // action par défaut
    }
} catch (Exception $e) {
    erreur($e->getMessage());
}
