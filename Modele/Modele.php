// Modele.php
<?php

/**
 * Classe abstraite Modèle.
 * Centralise les services d'accès à une base de données.
 * Utilise l'API PDO
 *
 * @author Baptiste Pesquet
 */
abstract class Modele {

    /** Objet PDO d'accès à la BD */
    private $bd;

    /**
     * Exécute une requête SQL éventuellement paramétrée
     * 
     * @param string $sql La requête SQL
     * @param array $valeurs Les valeurs associées à la requête
     * @return PDOStatement Le résultat renvoyé par la requête
     */
    protected function executerRequete($sql, $params = null) {
        if ($params == null) {
            $resultat = $this->getBd()->query($sql); // exécution directe
        }
        else {
            $resultat = $this->getBd()->prepare($sql);  // requête préparée
            $resultat->execute($params);
        }
        return $resultat;
    }

    /**
     * Renvoie un objet de connexion à la BD en initialisant la connexion au besoin
     * 
     * @return PDO L'objet PDO de connexion à la BDD
     */
    private function getBd() {
        if ($this->bd == null) {
            // Création de la connexion
            $this->bd = new PDO('mysql:host=localhost;dbname=marmiton_db;charset=utf8', 'root', 'mysql', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        return $this->bd;
    }

}







