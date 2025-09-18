<?php
$titre = 'Accueil - Marmiton';

ob_start();
?>
<h2>Bienvenue sur notre site pour découvrir des recettes gourmandes.</h2>
<h4>Ajouter une <a href="index.php?controleur=Recettes&action=nouvelle">recette</a></h4>

<h1>Liste des recettes</h1>
<?php foreach ($recettes as $recette): ?>
    <article>
        <header>
            <a href="index.php?controleur=Recettes&action=carteRecette&id=<?= htmlspecialchars($recette['id']) ?>">
                <h2><?= htmlspecialchars($recette['titre']) ?></h2>
            </a>
            <h3><?= htmlspecialchars($recette['description']) ?></h3>
            <time><?= htmlspecialchars($recette['date_creation']) ?></time>,
            par utilisateur #<?= htmlspecialchars($recette['utilisateur_id']) ?>
        </header>
    </article>
    <hr />
<?php endforeach; ?>
<?php
$contenu = ob_get_clean();
