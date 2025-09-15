<?php

require_once 'Framework/Controleur.php';

abstract class ControleurAdmin extends Controleur
{
    private $utilisateur;

    public function executerAction($action)
    {
        if ($this->requete->getSession()->existeAttribut("utilisateur")) {
            $this->utilisateur = $this->requete->getSession()->getAttribut("utilisateur");
            parent::executerAction($action);
        } else {
            $this->rediriger('Utilisateurs');  
        }
    }

    public function genererVue($donneesVue = array())
    {
        $donneesVue['utilisateur'] = $this->utilisateur;
        parent::genererVue($donneesVue);
    }
}
