<?php

require_once 'Requete.php';
require_once 'Vue.php';
use Framework\Vue;

/**
 * Classe abstraite Controleur
 * Fournit des services communs aux classes Controleur dérivées
 * 
 * @version 1.0
 * @author Baptiste Pesquet
 */
abstract class Controleur {

    /** Action à réaliser */
    private $action;

    /** Requête entrante */
    protected $requete;

    /**
     * Définit la requête entrante
     * 
     * @param Requete $requete Requete entrante
     */
    public function setRequete(Requete $requete) {
        $this->requete = $requete;
    }

    /**
     * Exécute l'action à réaliser.
     * Appelle la méthode portant le même nom que l'action sur l'objet Controleur courant
     * 
     * @throws Exception Si l'action n'existe pas dans la classe Controleur courante
     */
    public function executerAction($action) {
        if (method_exists($this, $action)) {
            $this->action = $action;
            $this->{$this->action}();
        } else {
            $ControleurRecettes = get_class($this);
            throw new Exception("Action '$action' non définie dans la classe $ControleurRecettes");
        }
    }

    /**
     * Méthode abstraite correspondant à l'action par défaut
     * Oblige les classes dérivées à implémenter cette action par défaut
     */
    public abstract function index();

    /**
     * Génère la vue associée au contrôleur courant
     * 
     * @param array $donneesVue Données nécessaires pour la génération de la vue
     */
    protected function genererVue($donneesVue = array()) {
        // Détermination du nom du fichier vue à partir du nom du contrôleur actuel
        $ControleurRecettes = get_class($this);
        $controleur = str_replace("Controleur", "", $ControleurRecettes);
        // Vérifier s'il y a un message à afficher
        $message = '';
        if ($this->requete->getSession()->existeAttribut("message")) {
            $message = $this->requete->getsession()->getAttribut("message");
            $this->requete->getsession()->setAttribut("message", ''); // on affiche le message une seule fois 
        }
        $donneesVue['message'] = $message;

        // Instanciation et génération de la vue
        $vue = new Vue($this->action, $controleur);
        $vue->generer($donneesVue);
    }

    /**
 * Effectue une redirection vers un contrôleur et une action spécifiques
 * 
 * @param string $controleur Contrôleur
 * @param string $action Action
 * @param string $params Chaîne de paramètres supplémentaires (ex: "id=5&x=10")
 */
protected function rediriger($controleur = null, $action = null, $params = "") {
    $racineWeb = Configuration::get("racineWeb", "/");
    $url = $racineWeb . "index.php";

    if ($controleur !== null) {
        $url .= "?controleur=" . $controleur;

        if ($action !== null) {
            $url .= "&action=" . $action;
        }

        if (!empty($params)) {
            $url .= "&" . $params;
        }
    }

    header("Location: " . $url);
    exit;
}


}
