<?php

require_once 'Modele/Modele.php';

class Recette extends Modele {

    // Récupérer toutes les recettes
    public function getRecettes() {
        $sql = 'SELECT * FROM recettes ORDER BY id DESC';
        return $this->executerRequete($sql); // retourne un PDOStatement (itérable)
    }

    // Récupérer une recette par id
    public function getRecette($idRecette) {
        $sql = 'SELECT * FROM recettes WHERE id = ?';
        $recette = $this->executerRequete($sql, array($idRecette));
        if ($recette->rowCount() === 1) {
            return $recette->fetch(); // tableau associatif
        } else {
            throw new Exception("Aucune recette ne correspond à l'identifiant '$idRecette'");
        }
    }

    // Créer une recette (INSERT)
    public function setRecette($data) {
        // Champs attendus (avec valeurs par défaut sûres)
        $titre          = isset($data['titre']) ? trim($data['titre']) : '';
        $description    = isset($data['description']) ? trim($data['description']) : '';
        $utilisateur_id = isset($data['utilisateur_id']) ? (int)$data['utilisateur_id'] : 1;

        if ($titre === '') {
            throw new Exception("Le titre est obligatoire");
        }

        $sql = "INSERT INTO recettes (titre, description, date_creation, utilisateur_id)
                VALUES (?, ?, NOW(), ?)";
        $this->executerRequete($sql, array($titre, $description, $utilisateur_id));

        // Si tu as besoin de l'id inséré :
        // return $this->getBd()->lastInsertId();
    }

    // Mettre à jour une recette (UPDATE)
    public function updateRecette($data) {
        $id            = isset($data['id']) ? (int)$data['id'] : 0;
        $titre         = isset($data['titre']) ? trim($data['titre']) : '';
        $description   = isset($data['description']) ? trim($data['description']) : '';

        if ($id <= 0) {
            throw new Exception("Identifiant de recette invalide");
        }
        if ($titre === '') {
            throw new Exception("Le titre est obligatoire");
        }

        $sql = "UPDATE recettes
                   SET titre = ?, description = ?
                 WHERE id = ?";
        $this->executerRequete($sql, array($titre, $description, $id));
    }

    // Supprimer une recette + ses ingrédients (FK simple)
    public function supprimerRecette($id) {
        $id = (int)$id;
        if ($id <= 0) {
            throw new Exception("Identifiant de recette invalide");
        }

        // Supprimer d'abord les ingrédients liés
        $this->executerRequete("DELETE FROM ingredients WHERE recette_id = ?", array($id));
        // Puis la recette
        $this->executerRequete("DELETE FROM recettes WHERE id = ?", array($id));
    }
}
