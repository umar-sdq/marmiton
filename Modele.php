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