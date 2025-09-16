<?php

require_once 'Framework/Modele.php';

class Utilisateur extends Modele
{
    /**
     * Vérifie qu'un utilisateur existe dans la BD (par identifiant et mot de passe)
     */
    public function connecter($identifiant, $mot_de_passe)
    {
        $sql = "SELECT id FROM utilisateurs WHERE identifiant = ? AND mot_de_passe = ?";
        $utilisateur = $this->executerRequete($sql, array($identifiant, $mot_de_passe));
        return ($utilisateur->rowCount() == 1);
    }

    /**
     * Renvoie un utilisateur existant dans la BD
     */
    public function getUtilisateur($identifiant, $mot_de_passe)
    {
        $sql = "SELECT id as idUtilisateur, nom, identifiant, mot_de_passe 
                FROM utilisateurs 
                WHERE identifiant = ? AND mot_de_passe = ?";
        $utilisateur = $this->executerRequete($sql, array($identifiant, $mot_de_passe));
        
        if ($utilisateur->rowCount() == 1) {
            return $utilisateur->fetch();
        } else {
            throw new Exception("Aucun utilisateur ne correspond aux identifiants fournis");
        }
    }
}
