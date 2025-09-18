<?php $titre = "Liste des recettes (Admin)"; ?>
<?php ob_start(); ?>

<a href="AdminRecettes/ajouter">
    <h2 class="titreArticle">Ajouter une recette</h2>
</a>

<h1>Liste des recettes</h1>

<?php if (!empty($recettes)): ?>
    <?php foreach ($recettes as $recette): ?>
        <article>
            <header>
                <a href="AdminRecettes/lire/<?= $recette['id'] ?>">
                    <h2><?= htmlspecialchars($recette['titre']) ?></h2>
                </a>
                <time><?= htmlspecialchars($recette['date_creation']) ?></time>, 
                par utilisateur #<?= htmlspecialchars($recette['utilisateur_id']) ?>
            </header>
            <p><?= nl2br(htmlspecialchars($recette['description'])) ?></p>
            <p>
                <a href="AdminRecettes/modifier/<?= $recette['id'] ?>">[modifier la recette]</a>
            </p>
        </article>
        <hr/>
    <?php endforeach; ?>
<?php else: ?>
    <p>Aucune recette trouvée.</p>
<?php endif; ?>

<?php $contenu = ob_get_clean(); ?>
<?php require 'Vue/gabarit.php'; ?>
