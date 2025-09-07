<?php

require 'Controlleur/Controlleur.php';

try {
    if (isset($_GET['action'])) {

        // Afficher une recette
        if ($_GET['action'] == 'recette') {
            if (isset($_GET['id'])) {
                $id = intval($_GET['id']);
                if ($id != 0) {
                    $erreur = isset($_GET['erreur']) ? $_GET['erreur'] : '';
                    recette($id, $erreur);
                } else {
                    throw new Exception("Identifiant de recette incorrect");
                }
            } else {
                throw new Exception("Aucun identifiant de recette");
            }

        // Ajouter un ingrédient
        } else if ($_GET['action'] == 'ingredient') {
            if (isset($_POST['recette_id'])) {
                $id = intval($_POST['recette_id']);
                if ($id != 0) {
                    $recette = getRecette($id); // vérifie que la recette existe
                    $ingredient = $_POST;
                    ingredient($ingredient);
                } else {
                    throw new Exception("Identifiant de recette incorrect");
                }
            } else {
                throw new Exception("Aucun identifiant de recette");
            }

        // Confirmer la suppression d’un ingrédient
        } else if ($_GET['action'] == 'confirmer') {
            if (isset($_GET['id'])) {
                $id = intval($_GET['id']);
                if ($id != 0) {
                    confirmer($id);
                } else {
                    throw new Exception("Identifiant d'ingrédient incorrect");
                }
            } else {
                throw new Exception("Aucun identifiant d'ingrédient");
            }

        // Nouvelle recette (formulaire vide)
        } else if ($_GET['action'] == 'nouvelle') {
            nouvelle();

        // Enregistrer une recette (INSERT)
        } else if ($_GET['action'] == 'enregistrerRecette') {
            if (!empty($_POST['titre'])) {
                enregistrerRecette($_POST);
            } else {
                throw new Exception("Titre requis");
            }

        // Afficher une carte recette (vue détaillée)
        } else if ($_GET['action'] == 'carteRecette') {
            if (isset($_GET['id'])) {
                $id = intval($_GET['id']);
                if ($id != 0) {
                    carteRecette($id);
                } else {
                    throw new Exception("Identifiant de recette incorrect");
                }
            } else {
                throw new Exception("Aucun identifiant de recette");
            }

        // Supprimer une recette
        } else if ($_GET['action'] == 'deleteRecette') {
            if (isset($_POST['id'])) {
                $id = intval($_POST['id']);
                if ($id != 0) {
                    deleteRecette($id);
                    header('Location: index.php');
                    exit;
                } else {
                    throw new Exception("Identifiant de recette incorrect");
                }
            } else {
                throw new Exception("Aucun identifiant de recette");
            }

        // Supprimer un ingrédient
        } else if ($_GET['action'] == 'supprimer') {
            if (isset($_POST['id'])) {
                $id = intval($_POST['id']);
                if ($id != 0) {
                    supprimer($id);
                } else {
                    throw new Exception("Identifiant d'ingrédient incorrect");
                }
            } else {
                throw new Exception("Aucun identifiant d'ingrédient");
            }

        // Action inconnue
        } else {
            throw new Exception("Action non valide");
        }

    // Action par défaut → accueil
    } else {
        accueil();
    }

} catch (Exception $e) {
    erreur($e->getMessage());
}
