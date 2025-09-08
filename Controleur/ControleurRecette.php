<?php

require_once 'Modele/Recette.php';
require_once 'Modele/Ingredient.php';
require_once 'Vue/Vue.php';

class ControleurRecette{
    private $recette;
    private $ingredient;

    public function __construct() {
        $this->recette = new Recette();
        $this->ingredient = new Ingredient();
    }

    public function recettes() {
        $recettes = $this->recette->getRecettes();
        $vue = new Vue("Recettes");
        $vue->generer(array('recettes' => $recettes));
    }

    public function recette($idRecette) {
        $recette = $this->recette->getRecette($idRecette);
        $ingredients = $this->ingredient->getIngredients($idRecette);
        $vue = new Vue("Recette");
        $vue->generer(array('recette' => $recette, 'ingredients' => $ingredients, 'erreur' => $erreur));
    }

    public function nouvelleRecette(){
        $vue = new Vue("Ajouter")
        $vue->generer();
    }

    public function ajouter($recette){
        $this->recette->setRecette($recette);
        $this->recettes();
        exit;
    }

    public function modifierRecette($idRecette){
        $recette = $this->recette->getRecette($idRecette);
        $vue = new Vue("Modifier");
        $vue->generer(array('recette' => $recette));
    }

    public function miseAJourRecette($recette){
        $this->recette->updateRecette($recette);
        $this->recettes();
    }
    
}