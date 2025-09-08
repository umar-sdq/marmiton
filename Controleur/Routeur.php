<?php
require_once 'Controleur/ControleurRecette.php';
/* require_once 'Controleur/ControleurIngredient.php';
require_once 'Controleur/ControleurType.php'; */
require_once

class Routeur {
    private $ctrlRecette;
    private $ctrlIngredient;
    private $ctrlType;

    public function __construct() {
        $this->ctrlRecette = new ControleurRecette();
        /* $this->ctrlIngredient = new ControleurIngredient();
        $this->ctrlType = new ControleurType(); */
    }

    public function routerRequete() {
        try {
            if (isset($_GET['action'])) {

            } else 
                $this->ctrlRecette->recettes();
            
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
        $vue->generer(array('msgErreur' => $msgErreur));
    }

    private function getParametre($tableau, $nom) {
        if (isset($tableau[$nom])) {
            return $tableau[$nom];
        } else
            throw new Exception("Paramètre '$nom' absent");
    }


}