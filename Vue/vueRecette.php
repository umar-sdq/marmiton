<?php $titre = "Recette" . $recette[titre]; ?>

<?php ob_start(); ?>
<article>
    <header>
        <h1 class="titreRecette"></h1>
        <time><?= $recette['date_creation']?></time>, par utilisateur #<?= $recette['utilisateur_id']?>
    </header>
    <p><?$recette['description']?></p>
</article>
<hr />
<form action="recette.php" method="post">
    <h2>Ajouter une recette</h2>
    <p>
        <label for="titre">Titre</label> : <input type="text" name="titre" id="titre" />
        <label for="description">description</label> : <input type="text" name="description" id="description" />
        <input type="hidden" name="id" value="<?= $recette['id'] ?>" />
        <input type="submit" value="Ajouter" />
    </p>
</form>
<form action="ingredients.php" method="post">
    <h2>Ajouter des ingredients</h2>
    <p>
        <label for="nom">Nom</label> : <input type="text" name="nom" id="nom" />
        <input type="hidden" name="recette_id" value="<?= $recette['id'] ?>" />
        <label for="liste_ingredients">Liste Ingredients</label> : <input type="text" name="liste_ingredients" id="liste_ingredients" />
        <input type="submit" value="Ajouter" />
</form>
<?php $contenu ob_get_clean();?>

<?php require 'gabarit.php'; ?>