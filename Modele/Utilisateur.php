<?php

require_once 'Framework/Modele.php';

class Utilisateur extends Modele
{
    /**
     * Vérifie qu'un utilisateur existe dans la BD (par email et mot de passe)
     */
    public function connecter($email, $mdp)
    {
        $sql = "SELECT id FROM utilisateurs WHERE email = ? AND mot_de_passe = ?";
        $utilisateur = $this->executerRequete($sql, array($email, $mdp));
        return ($utilisateur->rowCount() == 1);
    }

    /**
     * Renvoie un utilisateur existant dans la BD
     */
    public function getUtilisateur($email, $mdp)
    {
        $sql = "SELECT id as idUtilisateur, email, mot_de_passe FROM utilisateurs WHERE email = ? AND mot_de_passe = ?";
        $utilisateur = $this->executerRequete($sql, array($email, $mdp));
        if ($utilisateur->rowCount() == 1) {
            return $utilisateur->fetch();
        } else {
            throw new Exception("Aucun utilisateur ne correspond aux identifiants fournis");
        }
    }
}
