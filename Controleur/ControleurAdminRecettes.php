<?php
require_once 'Controleur/ControleurAdmin.php';
require_once 'Modele/Recette.php';
require_once 'Modele/Ingredient.php';

class ControleurAdminRecettes extends ControleurAdmin {
    private $recette;
    private $ingredient;

    public function __construct() {
        $this->recette = new Recette();
        $this->ingredient = new Ingredient();
    }

    // Liste admin
    public function index() {
        $recettes = $this->recette->getRecettes();
        $this->genererVue(['recettes' => $recettes]);
    }

    // Lire une recette (vue admin avec gestion ingrédients)
    public function lire() {
        $idRecette = $this->requete->getParametreId('id');
        $recette = $this->recette->getRecette($idRecette);
        $ingredients = $this->ingredient->getIngredients($idRecette);

        $this->genererVue([
            'recette' => $recette,
            'ingredients' => $ingredients
        ]);
    }

    // Ajouter une recette
    public function ajouter() {
        $recette = [
            'titre' => $this->requete->getParametre('titre'),
            'description' => $this->requete->getParametre('description'),
            'utilisateur_id' => $this->requete->getSession()->getAttribut("idUtilisateur")
        ];
        $this->recette->setRecette($recette);
        $this->rediriger("AdminRecettes");
    }

    // Modifier une recette
    public function modifierRecette() {
        $idRecette = $this->requete->getParametreId('id');
        $recette = $this->recette->getRecette($idRecette);
        $ingredients = $this->ingredient->getIngredients($idRecette);

        $this->genererVue([
            'recette' => $recette,
            'ingredients' => $ingredients
        ]);
    }

    // Mise à jour recette
    public function miseAJourRecette() {
        $idRecette = $this->requete->getParametre('id');
        $titre = $this->requete->getParametre('titre');
        $description = $this->requete->getParametre('description');

        $this->recette->updateRecette([
            'id' => $idRecette,
            'titre' => $titre,
            'description' => $description
        ]);
        $this->rediriger("AdminRecettes");
    }

    // Supprimer recette (admin peut aussi)
    public function supprimer() {
        $idRecette = $this->requete->getParametreId('id');
        $this->recette->supprimerRecette($idRecette);
        $this->rediriger("AdminRecettes");
    }

    // Ajouter un ingrédient
    public function ajouterIngredient() {
        $this->ingredient->ajouterIngredient(
            $this->requete->getParametre('recette_id'),
            $this->requete->getParametre('nom'),
            $this->requete->getParametre('liste_ingredients')
        );
        $this->rediriger("AdminRecettes/lire/" . $this->requete->getParametre('recette_id'));
    }

    // Supprimer un ingrédient
    public function supprimerIngredient() {
        $idIngredient = $this->requete->getParametreId('id');
        $idRecette = $this->requete->getParametre('recette_id');
        $this->ingredient->supprimerIngredient($idIngredient);
        $this->rediriger("AdminRecettes/lire/" . $idRecette);
    }
}
