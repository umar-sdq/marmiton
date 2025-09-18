<?php $titre = "Liste des recettes"; ?>
<?php ob_start(); ?>

<h1>Liste des recettes</h1>

<?php if (!empty($recettes)): ?>
    <?php foreach ($recettes as $recette): ?>
        <article>
            <header>
                
    <h2><?= htmlspecialchars($recette['titre']) ?></h2>
</a>


                <p><?= htmlspecialchars($recette['description']) ?></p>
            </header>
        </article>
        <hr/>
    <?php endforeach; ?>
<?php else: ?>
    <p>Aucune recette trouvée.</p>
<?php endif; ?>

<?php $contenu = ob_get_clean(); ?>
<?php require 'Vue/gabarit.php'; ?>
