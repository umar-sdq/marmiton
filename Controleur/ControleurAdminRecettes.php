<?php

require_once 'Controleur/ControleurAdmin.php';
require_once 'Modele/Recette.php';
require_once 'Modele/Ingredient.php';

class ControleurAdminRecettes extends ControleurAdmin
{
    private $recette;
    private $ingredient;

    public function __construct()
    {
        $this->recette = new Recette();
        $this->ingredient = new Ingredient();
    }

    // Liste
    public function index()
    {
        $recettes = $this->recette->getRecettes();
        $estConnecte = $this->requete->getSession()->existeAttribut("utilisateur");

        $this->genererVue([
            'recettes' => $recettes,
            'estConnecte' => $estConnecte
        ]);
    }

    // Nouvelle (formulaire d’ajout admin)
    public function nouvelle()
    {
        $this->genererVue();
    }

    // Ajout effectif
    public function ajouter()
    {
        $recette = [
            'titre' => $this->requete->getParametre('titre'),
            'description' => $this->requete->getParametre('description'),
            'utilisateur_id' => 1
        ];
        $this->recette->setRecette($recette);
        $this->rediriger("AdminRecettes");
    }

    // Lire une recette
    public function lire()
    {
        $idRecette = $this->requete->getParametreId('id');
        $recette = $this->recette->getRecette($idRecette);
        $ingredients = $this->ingredient->getIngredients($idRecette);

        $this->genererVue([
            'recette' => $recette,
            'ingredients' => $ingredients
        ]);
    }

    // Modifier
    public function modifierRecette($idRecette)
    {
        $recette = $this->recette->getRecette($idRecette);
        $ingredients = $this->ingredient->getIngredients($idRecette);

        $this->genererVue([
            'recette' => $recette,
            'ingredients' => $ingredients
        ]);
    }

    // Supprimer
    public function supprimer()
    {
        $idRecette = $this->requete->getParametreId('id');
        $this->recette->supprimerRecette($idRecette);
        $this->rediriger("AdminRecettes");
    }
}
