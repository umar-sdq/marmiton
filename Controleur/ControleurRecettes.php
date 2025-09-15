<?php
require_once 'Framework/Controleur.php';
require_once 'Modele/Recette.php';
require_once 'Modele/Ingredient.php';
require_once 'Framework/Routeur.php';

class ControleurRecettes extends Controleur {
    private $recette;
    private $ingredient;

    public function __construct() {
        $this->recette = new Recette();
        $this->ingredient = new Ingredient();
    }

    public function index() {
    $recettes = $this->recette->getRecettes();
    $this->genererVue(['recettes' => $recettes]);
}

    public function lire() {
        $idRecette = $this->requete->getParametreId('id');
        $recette = $this->recette->getRecette($idRecette);
        $ingredients = $this->ingredient->getIngredients($idRecette);
        $erreur = $this->requete->getSession()->existeAttribut("erreur") ? $this->requete->getSession()->getAttribut("erreur") : null;

        $this->genererVue([
            'recette' => $recette,
            'ingredients' => $ingredients,
            'erreur' => $erreur
        ]);
    }

    public function recettes() {
        $idRecette = $this->requete->getParametre("id");
        $recette = $this->recette->getRecette($idRecette);
        $ingredients = $this->ingredient->getIngredients($idRecette);

        
        $this->genererVue([
            'recette' => $recette,
            'ingredients' => $ingredients,
            'erreur' => $erreur
        ]);
    }

    public function nouvelleRecette() {
        $this->genererVue([
            'recette' => [],
            'ingredients' => [],
            'erreur' => null
        ]);
    }

    public function nouvelle() {
        $this->genererVue([
            'recette' => [],
            'ingredients' => [],
            'erreur' => null
        ]);
    }

    public function ajouter() {
         $recette = [
        'titre' => $this->requete->getParametre('titre'),
        'description' => $this->requete->getParametre('description'),
        'id' => $this->requete->existeParametre('id') ? $this->requete->getParametre('id') : null,
        'utilisateur_id' => 1
    ];
        $this->recette->setRecette($recette);
        $this->rediriger("Recettes");
    }

    public function modifierRecette($idRecette) {
        $recette = $this->recette->getRecette($idRecette);
        $ingredients = $this->ingredient->getIngredients($idRecette);
        $this->genererVue([
            'recette' => $recette,
            'ingredients' => $ingredients,
            'erreur' => null
        ]);
    }

    public function miseAJourRecette() {
        $recette = $this->requete->getParametre('recette');
        $this->recette->updateRecette($recette);
        $this->rediriger("Recettes");
    }

    public function carteRecette() {
    $idRecette = $this->requete->getParametre('id');
    $recette = $this->recette->getRecette($idRecette);
    $ingredients = $this->ingredient->getIngredients($idRecette);

    $this->genererVue([
        'recette' => $recette,
        'ingredients' => $ingredients,
        'erreur' => null
    ]);
}


    public function supprimer() {
        $idRecette = $this->requete->getParametreId('id');
        $this->recette->supprimerRecette($idRecette);
        $this->rediriger("Recettes");
    }
}
