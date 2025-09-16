<?php

require_once 'Controleur/ControleurAdmin.php';
require_once 'Modele/Recette.php';

class ControleurAdminRecettes extends ControleurAdmin {

    private $recette;

    public function __construct() {
        $this->recette = new Recette();
    }
 // Affiche la liste des recettes
    public function index() {
        $recettes = $this->recette->getRecettes();
        $this->genererVue(['recettes' => $recettes]);
    }
  
    // Confirmer la suppression d'une recette
    public function confirmer() {
        $id = $this->requete->getParametreId("id");
        $recette = $this->recette->getRecette($id);
        $this->genererVue(['recette' => $recette]);
    }

// Supprimer un commentaire
    public function supprimer() {
        $id = $this->requete->getParametreId("id");
        // Lire le commentaire afin d'obtenir le id de l'article associé
        $recette = $this->recette->getRecettes($id);
        // Supprimer le commentaire à l'aide du modèle
        $this->recette->deleteRecette($id);
        //Recharger la page pour mettre à jour la liste des commentaires associés
        $this->rediriger('AdminIngredient', 'lire/' . $commentaire['ingredient_id']);
    }

    // Rétablir un commentaire
    public function retablir() {
        $id = $this->requete->getParametreId("id");
        // Lire le commentaire afin d'obtenir le id de l'article associé
        $recette = $this->recette->getRecette($id);
        // Supprimer le commentaire à l'aide du modèle
        $this->recette->restoreRecette($id);
        //Recharger la page pour mettre à jour la liste des commentaires associés
        $this->rediriger('AdminIngredient', 'lire/' . $recette['ingredient_id']);
    }

}
