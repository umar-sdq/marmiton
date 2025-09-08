<?php
require_once 'Modele/Ingredient.php';
require_once 'Vue/Vue.php';

class ControleurIngredient {
    private $ingredient;

    public function __construct() {
        $this->ingredient = new Ingredient();
    }

    // Liste des ingrédients (si besoin)
    public function ingredients($idRecette) {
        $ingredients = $this->ingredient->getIngredients($idRecette);
        $vue = new Vue("Ingredient");
        $vue->generer(['ingredients' => $ingredients]);
    }

    // Ajouter un ingrédient
    public function ajouter($data) {
        $recette_id = (int)($data['recette_id'] ?? 0);
        $nom        = trim($data['nom'] ?? '');

        if ($recette_id <= 0 || $nom === '') {
            throw new Exception("Données ingrédient invalides");
        }

        $this->ingredient->setIngredient($data);

        // Retourner sur la fiche recette
        header('Location: index.php?action=carteRecette&id=' . $recette_id);
        exit;
    }

    // Confirmer la suppression
    public function confirmer($id) {
        $ingredient = $this->ingredient->getIngredient($id);
        $vue = new Vue("Confirmer");
        $vue->generer(['ingredient' => $ingredient]);
    }

    // Supprimer
    public function supprimer($id, $recette_id) {
        $this->ingredient->deleteIngredient($id);
        header('Location: index.php?action=carteRecette&id=' . $recette_id);
        exit;
    }
}
