<?php
require_once 'Framework/Controleur.php';
require_once 'Modele/Utilisateur.php';

class ControleurUtilisateurs extends Controleur
{
    private $utilisateur;

    public function __construct()
    {
        $this->utilisateur = new Utilisateur();
    }

    public function index()
    {
        $erreur = $this->requete->getSession()->existeAttribut("erreur") ? $this->requete->getSession()->getAttribut("erreur") : '';
        $this->genererVue(['erreur' => $erreur]);
    }

    public function connecter()
    {
        if ($this->requete->existeParametre("email") && $this->requete->existeParametre("mdp")) {
            $email = htmlspecialchars(trim($this->requete->getParametre("email")));
            $mdp = htmlspecialchars(trim($this->requete->getParametre("mdp")));
            if ($this->utilisateur->connecter($email, $mdp)) {
                $utilisateur = $this->utilisateur->getUtilisateur($email, $mdp);
                $this->requete->getSession()->setAttribut("idUtilisateur", $utilisateur['idUtilisateur']);
                $this->requete->getSession()->setAttribut("email", $utilisateur['email']);

                if ($this->requete->getSession()->existeAttribut('erreur')) {
                    $this->requete->getSession()->setAttribut('erreur', '');
                }
                $this->rediriger("recettes");
            } else {
                $this->requete->getSession()->setAttribut('erreur', 'Email ou mot de passe incorrect');
                $this->rediriger('utilisateurs');
            }
        } else {
            throw new Exception("Action impossible : email ou mot de passe non défini");
        }
    }

    public function deconnecter()
    {
        $this->requete->getSession()->detruire();
        $this->rediriger("accueil");
    }
}
