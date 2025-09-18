<?php
require_once 'Framework/Controleur.php';
require_once 'Modele/Recette.php';

class ControleurRecettes extends Controleur {
    private $recette;

    public function __construct() {
        $this->recette = new Recette();
    }

    public function index() {
        $recettes = $this->recette->getRecettes();
        $this->genererVue(['recettes' => $recettes]);
    }

    public function lire() {
        $idRecette = $this->requete->getParametreId('id');
        $recette = $this->recette->getRecette($idRecette);

        $this->genererVue([
            'recette' => $recette
        ]);
    }

    public function ajouter() {
        $recette = [
            'titre' => $this->requete->getParametre('titre'),
            'description' => $this->requete->getParametre('description'),
            'utilisateur_id' => null // anonyme
        ];
        $this->recette->setRecette($recette);
        $this->rediriger("Recettes");
    }

    public function supprimer() {
        $idRecette = $this->requete->getParametreId('id');
        $this->recette->supprimerRecette($idRecette);
        $this->rediriger("Recettes");
    }
}
