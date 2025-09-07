// Controlleur.php
<?php

require 'Modele/Modele.php';

function accueil() {
    $recettes = getRecettes();
    require 'Vue/vueAccueil.php';
}

// Affiche les détails sur un article
function recette($id, $erreur) {
    $recette = getRecette($id);
    $ingredients = getIngredients($id);
    require 'Vue/vueRecette.php';
}

// Ajoute un commentaire à un article
function ingredient($ingredient) {
    
        // Ajouter le commentaire à l'aide du modèle
        setIngredient($ingredient);
        //Recharger la page pour mettre à jour la liste des commentaires associés
        header('Location: index.php?action=recette&id=' . $ingredient['recette_id']);
    
}

function nouvelle() {
    $recette = ['id' => 0, 'titre' => '', 'description' => '', 'date_creation' => '', 'utilisateur_id' => ''];
    require 'Vue/vueRecette.php';
}

function enregistrerRecette($post) {
    setRecette($post); // à créer dans Modele.php
    header('Location: index.php');
    exit;
}

// Confirmer la suppression d'un commentaire
function confirmer($id) {
    // Lire le commentaire à l'aide du modèle
    $ingredient = getIngredient($id);
    require 'Vue/vueConfirmer.php';
}

// Supprimer un commentaire
function supprimer($id) {
    // Lire le commentaire afin d'obtenir le id de l'article associé
    $ingredient = getingredient($id);
    // Supprimer le commentaire à l'aide du modèle
    deleteIngredient($id);
    //Recharger la page pour mettre à jour la liste des commentaires associés
    header('Location: index.php?action=recette&id=' . $commentaire['recette_id']);
}

// Affiche une erreur
function erreur($msgErreur) {
    require 'Vue/vueErreur.php';
}

function carteRecette($id) {
    $recette = getRecette($id);
    $ingredients = getIngredients($id);
    require 'Vue/vueCarteRecette.php';
}