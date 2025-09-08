<?php
require_once 'Modele/Recette.php';
require_once 'Modele/Ingredient.php';
require_once 'Vue/Vue.php';

class ControleurRecette {
    private $recette;
    private $ingredient;

    public function __construct() {
        $this->recette = new Recette();
        $this->ingredient = new Ingredient();
    }

public function recettes() {
    $recettes = $this->recette->getRecettes();
    $vue = new Vue("Accueil");  // au lieu de "Recettes"
    $vue->generer(['recettes' => $recettes]);
}


    // Détail d'une recette + formulaire édition
    public function recette($idRecette, $erreur = null) {
        $recette = $this->recette->getRecette($idRecette);
        $ingredients = $this->ingredient->getIngredients($idRecette);
        $vue = new Vue("Recette");
        $vue->generer([
            'recette'     => $recette,
            'ingredients' => $ingredients,
            'erreur'      => $erreur
        ]);
    }

    // Formulaire d'ajout (réutilise vue Recette)
    public function nouvelleRecette() {
        $recette = [];
        $ingredients = [];
        $vue = new Vue("Recette");
        $vue->generer([
            'recette'     => $recette,
            'ingredients' => $ingredients,
            'erreur'      => null
        ]);
    }

    // INSERT
    public function ajouter($recette) {
        $this->recette->setRecette($recette);
        header('Location: index.php'); // retour accueil
        exit;
    }

    // Formulaire de modification
    public function modifierRecette($idRecette) {
        $recette = $this->recette->getRecette($idRecette);
        $ingredients = $this->ingredient->getIngredients($idRecette);
        $vue = new Vue("Recette");
        $vue->generer([
            'recette'     => $recette,
            'ingredients' => $ingredients,
            'erreur'      => null
        ]);
    }

    // UPDATE
    public function miseAJourRecette($recette) {
        $this->recette->updateRecette($recette);
        header('Location: index.php'); // retour accueil
        exit;
    }

    public function carteRecette($idRecette) {
        $recette = $this->recette->getRecette($idRecette);
        $ingredients = $this->ingredient->getIngredients($idRecette);
        $vue = new Vue("CarteRecette"); // charge Vue/vueCarteRecette.php
        $vue->generer([
            'recette'     => $recette,
            'ingredients' => $ingredients,
            'erreur'      => null
        ]);
    }
}
