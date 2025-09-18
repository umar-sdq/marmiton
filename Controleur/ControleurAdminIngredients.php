<?php

require_once 'Controleur/ControleurAdmin.php';
require_once 'Modele/Ingredient.php';
require_once 'Modele/Recette.php';

class ControleurAdminIngredients extends ControleurAdmin
{
    private $ingredient;
    private $recette;

    public function __construct()
    {
        $this->ingredient = new Ingredient();
        $this->recette = new Recette();
    }

    // Liste des ingrédients d’une recette
    public function index()
    {
        $idRecette = $this->requete->getParametre("recette_id"); 
        $ingredients = $this->ingredient->getIngredients($idRecette);

        $this->genererVue([
            'ingredients' => $ingredients,
            'idRecette'   => $idRecette
        ]);
    }

    // Lire un ingrédient précis
    public function lire()
    {
        $idIngredient = $this->requete->getParametreId("id");
        $ingredient   = $this->ingredient->getIngredient($idIngredient);

        $this->genererVue([
            'ingredient' => $ingredient
        ]);
    }

    // Affiche formulaire d’ajout (optionnel)
    public function ajouter()
    {
        $this->genererVue();
    }

    // Enregistre le nouvel ingrédient
    public function nouveau()
    {
        $ingredient['nom']               = $this->requete->getParametre('nom');
        $ingredient['recette_id']        = $this->requete->getParametre('recette_id');
        $ingredient['liste_ingredients'] = $this->requete->getParametre('liste_ingredients');

        $this->ingredient->setIngredient($ingredient);

        // ✅ Redirection propre vers la recette
        header("Location: index.php?controleur=AdminRecettes&action=lire&id=" . $ingredient['recette_id']);
        exit();
    }

    // Formulaire de modification
    public function modifier()
    {
        $idIngredient = $this->requete->getParametreId('id');
        $ingredient   = $this->ingredient->getIngredient($idIngredient);

        $this->genererVue(['ingredient' => $ingredient]);
    }

    // Sauvegarde la mise à jour
    public function miseAJour()
    {
        $ingredient['id']                = $this->requete->getParametreId('id');
        $ingredient['nom']               = $this->requete->getParametre('nom');
        $ingredient['recette_id']        = $this->requete->getParametre('recette_id');
        $ingredient['liste_ingredients'] = $this->requete->getParametre('liste_ingredients');

        $this->ingredient->updateIngredient($ingredient);

        // ✅ Retour sur la recette
        header("Location: index.php?controleur=AdminRecettes&action=lire&id=" . $ingredient['recette_id']);
        exit();
    }

    // Supprimer un ingrédient
    public function supprimer()
    {
        $idIngredient = $this->requete->getParametreId('id');
        $recetteId    = $this->requete->getParametre('recette_id');

        $this->ingredient->deleteIngredient($idIngredient);

        // ✅ Retour sur la recette
        header("Location: index.php?controleur=AdminRecettes&action=lire&id=" . $recetteId);
        exit();
    }
}
