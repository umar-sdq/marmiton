<?php
require_once 'Framework/Controleur.php';
require_once 'Modele/Ingredient.php';

class ControleurIngredient extends Controleur {
    private $ingredient;

    public function __construct() {
        $this->ingredient = new Ingredient();
    }

    // Afficher la liste des ingrédients d’une recette
    public function index() {
        $idRecette = $this->requete->getParametreId("idRecette");
        $ingredients = $this->ingredient->getIngredients($idRecette);

        $this->genererVue(['ingredients' => $ingredients]);
    }

    // Ajouter un ingrédient
    public function ajouter() {
        $data = [
            'recette_id' => (int) $this->requete->getParametre('recette_id'),
            'nom' => trim($this->requete->getParametre('nom')),
            'liste_ingredients' => trim($this->requete->getParametre('liste_ingredients'))
        ];

        // Validation basique
        if ($data['recette_id'] <= 0 || $data['nom'] === '') {
            throw new Exception("Données ingrédient invalides");
        }

        $this->ingredient->setIngredient($data);

        $this->rediriger("Recettes", "carteRecette", "id=" . $data['recette_id']);
    }

    // Confirmer la suppression d’un ingrédient
    public function confirmer() {
        $id = $this->requete->getParametreId("id");
        $ingredient = $this->ingredient->getIngredient($id);

        $this->genererVue(['ingredient' => $ingredient]);
    }

    // Supprimer un ingrédient
    public function supprimer() {
        $id = $this->requete->getParametreId("id");
        $recette_id = $this->requete->getParametreId("recette_id");

        $this->ingredient->deleteIngredient($id);

        $this->rediriger("Recettes", "carteRecette", "id=" . $recette_id);
    }
}
