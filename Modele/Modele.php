// Modele.php
<?php

function getBd() {
    $bd = new PDO('mysql:host=localhost;dbname=marmiton;charset=utf8', 'root', 'mysql', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    return $bd;
}

function getRecettes(){
    $bd = getBd();
    $recettes = $bd->query('select * from recettes' 
                        . ' order by id desc');
    return $recettes;                        

}

function getRecette($idRecette){
    $bd = getBd();
    $recette = $bd->prepare('select * from recettes' 
    . ' where id=?');
    $recette->execute(array($idRecette));
    if($recette->rowCount() == 1)
        return $recette->fetch();
    else
        throw new Exception("Aucune recette ne correspond à l'identifiant '$idRecette'"); 
}

function getIngredients($idRecette){
    $bd = getBd();
    $ingredients = $bd->prepare('select * from ingredients' 
    . ' where recette_id=?');
    $ingredients->execute(array($idRecette));
    return $ingredients;
}

function getIngredient($id){
    $bd = getBd();
    $ingredient = $bd->prepare('select * from ingredients'
            . ' where id = ?');
    $ingredient->execute(array($id));
    if ($ingredient->rowCount() == 1)
        return $ingredient->fetch();
    else
        throw new Exception("Aucun ingredient ne correspond à l'identifiant '$id'");
    return $ingredient;
}
function setIngredient($data) {
    $bd = getBd();
    $nom = addslashes($data['nom']);
    $recetteId = intval($data['recette_id']);
    $liste = addslashes($data['liste_ingredients']);

    $sql = "INSERT INTO ingredients(nom, recette_id, liste_ingredients) 
            VALUES ('$nom', $recetteId, '$liste')";
    $bd->exec($sql);
}

function deleteIngredient($idIngredient){
    $bd = getBd();
    $result = $bdd->prepare('DELETE FROM ingredients'
            . ' WHERE id = ?');
    $result->execute(array($id));
    return $result;
}
function setRecette($data) {
    $bd = getBd();
    $sql = "INSERT INTO recettes(titre, description, date_creation, utilisateur_id) 
            VALUES ('" . addslashes($data['titre']) . "', 
                    '" . addslashes($data['description']) . "', 
                    NOW(), 
                    " . intval($data['utilisateur_id'] ?? 1) . ")";
    $bd->exec($sql);
    return $bd->lastInsertId();
}

