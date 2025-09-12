<?php

require_once 'Configuration.php';
require_once 'Controleur.php';
require_once 'Requete.php';
require_once 'Vue.php';

use Framework\Vue;

/*
 * Classe de routage des requêtes entrantes.
 * 
 * Inspirée du framework PHP de Nathan Davison
 * (https://github.com/ndavison/Nathan-MVC)
 * 
 * @version 1.0
 * @author Baptiste Pesquet
 */

class Routeur {

    /**
     * Méthode principale appelée par le contrôleur frontal
     * Examine la requête et exécute l'action appropriée
     */
    public function routerRequete() {
        try {
            // Fusion des paramètres GET et POST de la requête
            // Permet de gérer uniformément ces deux types de requête HTTP
            $requete = new Requete(array_merge($_GET, $_POST));

            // Création du contrôleur approprié
            $controleur = $this->creerControleur($requete);

            // Détermination de l’action à exécuter
            $action = $this->creerAction($requete);

            // Exécution de l’action
            $controleur->executerAction($action);
        } catch (Exception $e) {
            $this->gererErreur($e);
        }
    }

    /**
     * Instancie le contrôleur approprié en fonction de la requête reçue
     * 
     * @param Requete $requete Requête reçue
     * @return Instance d'un contrôleur
     * @throws Exception Si la création du contrôleur échoue
     */
    private function creerControleur(Requete $requete) {
        // Grâce à la redirection, toutes les URL entrantes sont du type :
        // index.php?controleur=XXX&action=YYY&id=ZZZ
        $ctrlAccueil = Configuration::get("defaut");
        if ($requete->getSession()->existeAttribut("recette")) {
            $ctrlAccueil = 'Admin' . $ctrlAccueil;
        }
        $controleur = $ctrlAccueil;  // Contrôleur par défaut

        // Si un contrôleur est passé en paramètre, on le prend
        if ($requete->existeParametre('controleur')) {
            $controleur = $requete->getParametre('controleur');
            // Première lettre en majuscules
            $controleur = ucfirst(strtolower($controleur));
        }

        // Création du nom de la classe du contrôleur
        // Exemple : si controleur=Recettes → classe = ControleurRecettes
        $classeControleur = "Controleur" . $controleur;

        // Création du chemin du fichier correspondant
        // Exemple : Controleur/ControleurRecettes.php
        $fichierControleur = "Controleur/" . $classeControleur . ".php";

        // Vérification que le fichier existe
        if (file_exists($fichierControleur)) {
            require_once $fichierControleur;

            // Vérification que la classe existe dans le fichier
            if (class_exists($classeControleur)) {
                $ctrl = new $classeControleur();
                $ctrl->setRequete($requete);
                return $ctrl;
            } else {
                throw new Exception("Classe '$classeControleur' introuvable dans '$fichierControleur'");
            }
        } else {
            throw new Exception("Fichier '$fichierControleur' introuvable");
        }
    }

    /**
     * Détermine l'action à exécuter en fonction de la requête reçue
     * 
     * @param Requete $requete Requête reçue
     * @return string Action à exécuter
     */
    private function creerAction(Requete $requete) {
        $action = "index";  // Action par défaut
        if ($requete->existeParametre('action')) {
            $action = $requete->getParametre('action');
        }
        return $action;
    }

    /**
     * Gère une erreur d'exécution (exception)
     * 
     * @param Exception $exception Exception qui s'est produite
     */
    private function gererErreur(Exception $exception) {
        $vue = new Vue('erreur');
        $erreur = $exception->getMessage();
        $vue->generer(array('message' => $erreur));
    }
}
