<?php

require_once 'Controleur/ControleurAdmin.php';
require_once 'Modele/Ingredient.php';
require_once 'Modele/Recette.php';

class ControleurAdminIngredients extends ControleurAdmin {

    

    private $ingredient;
    private $recette;

    public function __construct() {
        $this->ingredient = new Ingredient();
        $this->recette = new Recette();
    }

// Affiche la liste de tous les articles du blog
    public function index() {
        $ingredient = $this->ingredient->getIngredients();
        $this->genererVue(['ingredients' => $ingredients]);
    }

// Affiche les détails sur un article
    public function lire() {
        $idIngredient = $this->requete->getParametreId("id");
        $ingredient = $this->ingredient->getIngredient($idIngredient);
        $erreur = $this->requete->getSession()->existeAttribut("erreur") ? $this->requete->getsession()->getAttribut("erreur") : '';
        $recettes = $this->recette->getRecettes($idIngredient);
        $this->genererVue(['ingredient' => $ingredient, 'recettes' => $recettes, 'erreur' => $erreur]);
    }

    public function ajouter() {
        $vue = new Vue("Ajouter");
        $this->genererVue();
    }

    // Enregistre le nouvel ingrédient
    public function nouveau() {
        $ingredient['nom'] = $this->requete->getParametre('nom');
        $ingredient['recette_id'] = $this->requete->getParametre('recette_id');
        $ingredient['liste_ingredients'] = $this->requete->getParametre('liste_ingredients');
        $this->ingredient->setIngredient($ingredient);
        $this->executerAction('index');
    }

   // Formulaire de modification
    public function modifier() {
        $id = $this->requete->getParametreId('id');
        $ingredient = $this->ingredient->getIngredient($id);
        $this->genererVue(['ingredient' => $ingredient]);
    }

    // Sauvegarde la mise à jour
    public function miseAJour() {
        $ingredient['id'] = $this->requete->getParametreId('id');
        $ingredient['nom'] = $this->requete->getParametre('nom');
        $ingredient['recette_id'] = $this->requete->getParametre('recette_id');
        $ingredient['liste_ingredients'] = $this->requete->getParametre('liste_ingredients');
        $this->ingredient->updateIngredient($ingredient);
        $this->executerAction('index');
    }
}
