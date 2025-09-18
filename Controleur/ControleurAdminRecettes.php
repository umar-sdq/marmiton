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

    // Affiche la liste des recettes
    public function index()
    {
        $recettes = $this->recette->getRecettes();

        // Passe l'état de connexion à la vue
        $estConnecte = $this->requete->getSession()->existeAttribut("utilisateur");

        $this->genererVue([
            'recettes' => $recettes,
            'estConnecte' => $estConnecte
        ]);
    }

    // Lire une recette
    public function lire()
    {
        $idRecette = $this->requete->getParametreId('id');
        $recette = $this->recette->getRecette($idRecette);
        $ingredients = $this->ingredient->getIngredients($idRecette);

        $erreur = $this->requete->getSession()->existeAttribut("erreur")
            ? $this->requete->getSession()->getAttribut("erreur")
            : null;

        $estConnecte = $this->requete->getSession()->existeAttribut("utilisateur");

        $this->genererVue([
            'recette' => $recette,
            'ingredients' => $ingredients,
            'erreur' => $erreur,
            'estConnecte' => $estConnecte
        ]);
    }

    // Ajouter une recette
    public function ajouter()
    {
        $recette = [
            'titre' => $this->requete->getParametre('titre'),
            'description' => $this->requete->getParametre('description'),
            'id' => $this->requete->existeParametre('id') ? $this->requete->getParametre('id') : null,
            'utilisateur_id' => 1
        ];
        $this->recette->setRecette($recette);
        $this->rediriger("AdminRecettes");
    }

    // Modifier une recette
    public function modifierRecette($idRecette)
    {
        $recette = $this->recette->getRecette($idRecette);
        $ingredients = $this->ingredient->getIngredients($idRecette);

        $estConnecte = $this->requete->getSession()->existeAttribut("utilisateur");

        $this->genererVue([
            'recette' => $recette,
            'ingredients' => $ingredients,
            'erreur' => null,
            'estConnecte' => $estConnecte
        ]);
    }

    // Mettre à jour une recette
    public function miseAJourRecette()
    {
        $recette = $this->requete->getParametre('recette');
        $this->recette->updateRecette($recette);
        $this->rediriger("AdminRecettes");
    }

    // Carte de recette (vue détaillée)
    public function carteRecette()
    {
        $idRecette = $this->requete->getParametre('id');
        $recette = $this->recette->getRecette($idRecette);
        $ingredients = $this->ingredient->getIngredients($idRecette);

        $estConnecte = $this->requete->getSession()->existeAttribut("utilisateur");

        $this->genererVue([
            'recette' => $recette,
            'ingredients' => $ingredients,
            'erreur' => null,
            'estConnecte' => $estConnecte
        ]);
    }

    // Supprimer une recette
    public function supprimer()
    {
        $idRecette = $this->requete->getParametreId('id');
        $this->recette->supprimerRecette($idRecette);
        $this->rediriger("AdminRecettes");
    }
}
