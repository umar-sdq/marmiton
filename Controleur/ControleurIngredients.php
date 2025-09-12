<?php
require_once 'Framework/Controleur.php';
require_once 'Modele/Ingredient.php';

class ControleurIngredient extends Controleur {
    private $ingredient;

    public function __construct() {
        $this->ingredient = new Ingredient();
    }

       public function index() {
        // On peut récupérer un paramètre idRecette depuis la requête
        $idRecette = $this->requete->getParametreId("idRecette");
        $ingredients = $this->ingredient->getIngredients($idRecette);
        $this->genererVue(['ingredients' => $ingredients]);
    }


    // Ajouter un ingrédient
    public function ajouter() {
        $data = [
            'recette_id' => (int) $this->requete->getParametre('recette_id'),
            'nom' => trim($this->requete->getParametre('nom'))
        ];

        // Validation basique
        if ($data['recette_id'] <= 0 || $data['nom'] === '') {
            throw new Exception("Données ingrédient invalides");
        }

        $this->ingredient->setIngredient($data);
        // Rediriger vers la fiche recette correspondante
        $this->rediriger("Recette", "carteRecette/" . $data['recette_id']);
    }

    // Confirmer la suppression
    public function confirmer() {
        $id = $this->requete->getParametreId("id");
        $ingredient = $this->ingredient->getIngredient($id);
        $this->genererVue(['ingredient' => $ingredient]);
    }

    // Supprimer
    public function supprimer() {
        $id = $this->requete->getParametreId("id");
        $recette_id = $this->requete->getParametreId("recette_id");
        $this->ingredient->deleteIngredient($id);
        $this->rediriger("Recette", "carteRecette/" . $recette_id);
    }
}
