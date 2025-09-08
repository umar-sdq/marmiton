<?php
require_once 'Modele/Modele.php';

class Ingredient extends Modele {

    // Récupérer tous les ingrédients d'une recette
    public function getIngredients($idRecette) {
        $sql = 'SELECT * FROM ingredients WHERE recette_id = ?';
        $ingredients = $this->executerRequete($sql, [$idRecette]);
        return $ingredients;
    }

    // Récupérer un ingrédient par son id
    public function getIngredient($id) {
        $sql = 'SELECT * FROM ingredients WHERE id = ?';
        $ingredient = $this->executerRequete($sql, [$id]);
        if ($ingredient->rowCount() === 1) {
            return $ingredient->fetch();
        } else {
            throw new Exception("Aucun ingrédient ne correspond à l'identifiant '$id'");
        }
    }

    // Ajouter un ingrédient
    public function setIngredient($data) {
        $nom       = trim($data['nom']);
        $recetteId = (int) $data['recette_id'];
        $liste     = trim($data['liste_ingredients'] ?? '');

        if ($recetteId <= 0 || $nom === '') {
            throw new Exception("Nom ou identifiant de recette invalide");
        }

        $sql = "INSERT INTO ingredients (nom, recette_id, liste_ingredients)
                VALUES (?, ?, ?)";
        return $this->executerRequete($sql, [$nom, $recetteId, $liste]);
    }

    // Supprimer un ingrédient
    public function deleteIngredient($idIngredient) {
        $sql = 'DELETE FROM ingredients WHERE id = ?';
        return $this->executerRequete($sql, [$idIngredient]);
    }
}
