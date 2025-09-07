// vueConfirmer.php
<?php $titre = "Supprimer - " . $ingredient['titre']; ?>
<?php ob_start(); ?>
<article>
    <header>
        <p><h1>
            Supprimer?
        </h1>
        <?= $recette['date_creation'] ?>, <?= $recette['utilisateur_id'] ?>
        <strong><?= $ingredient['nom'] ?></strong><br/>
        <?= $ingredient['liste_ingredients'] ?>
        </p>
    </header>
</article>

<form action="index.php?action=supprimer" method="post">
    <input type="hidden" name="id" value="<?= $ingredient['id'] ?>" /><br />
    <input type="submit" value="Oui" />
</form>
<form action="index.php" method="get" >
    <input type="hidden" name="action" value="article" />
    <input type="hidden" name="id" value="<?= $ingredient['article_id'] ?>" />
    <input type="submit" value="Annuler" />
</form>
<?php $contenu = ob_get_clean(); ?>

<?php require 'Vue/gabarit.php'; ?>

