<?php
require_once 'Controleur/ControleurRecette.php';
require_once 'Controleur/ControleurIngredient.php';
require_once 'Vue/Vue.php';

class Routeur {
    private $ctrlRecette;
    private $ctrlIngredient;

    public function __construct() {
        $this->ctrlRecette    = new ControleurRecette();
        $this->ctrlIngredient = new ControleurIngredient();
    }

    public function routerRequete() {
        try {
            if (isset($_GET['action'])) {
                if ($_GET['action'] === 'apropos') {
                    $this->apropos();

                } else if ($_GET['action'] === 'recette') {
                    $id = intval($this->getParametre($_GET, 'id'));
                    $erreur = isset($_GET['erreur']) ? $_GET['erreur'] : null;
                    $this->ctrlRecette->recette($id, $erreur);

                } else if ($_GET['action'] === 'carteRecette') {
                    $id = intval($this->getParametre($_GET, 'id'));
                    $this->ctrlRecette->carteRecette($id);

                } else if ($_GET['action'] === 'nouvelle') {
                    $this->ctrlRecette->nouvelleRecette();

                } else if ($_GET['action'] === 'ajouter' || $_GET['action'] === 'enregistrerRecette') {
                    $this->getParametre($_POST, 'titre');
                    $this->ctrlRecette->ajouter($_POST);

                } else if ($_GET['action'] === 'modifierRecette') {
                    $id = intval($this->getParametre($_GET, 'id'));
                    $this->ctrlRecette->modifierRecette($id);

                } else if ($_GET['action'] === 'miseAJourRecette') {
                    $id = intval($this->getParametre($_POST, 'id'));
                    $this->getParametre($_POST, 'titre');
                    $this->ctrlRecette->miseAJourRecette($_POST);

                } else if ($_GET['action'] === 'deleteRecette') {
                    $id = intval($this->getParametre($_POST, 'id'));
                    $this->ctrlRecette->supprimerRecette($id);

                // --- Ingrédients ---
                } else if ($_GET['action'] === 'ingredient') {
                    $this->getParametre($_POST, 'recette_id');
                    $this->getParametre($_POST, 'nom');
                    $this->ctrlIngredient->ajouter($_POST);

                } else if ($_GET['action'] === 'deleteIngredient') {
                    $id         = intval($this->getParametre($_POST, 'id'));
                    $recette_id = intval($this->getParametre($_POST, 'recette_id'));
                    $this->ctrlIngredient->supprimer($id, $recette_id);

                } else {
                    throw new Exception("Action non valide");
                }

            } else {
                $this->ctrlRecette->recettes();
            }
        } catch (Exception $e) {
            $this->erreur($e->getMessage());
        }
    }

    private function apropos() {
        $vue = new Vue("Apropos");
        $vue->generer();
    }

    private function erreur($msgErreur) {
        $vue = new Vue("Erreur");
        $vue->generer(['msgErreur' => $msgErreur]);
    }

    private function getParametre($tableau, $nom) {
        if (isset($tableau[$nom])) {
            return $tableau[$nom];
        }
        throw new Exception("Paramètre '$nom' absent");
    }
}
