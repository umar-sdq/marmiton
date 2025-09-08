<?php // Vue/gabarit.php ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= isset($titre) ? htmlspecialchars($titre) : 'Marmiton' ?></title>
    <link rel="stylesheet" href="Contenu/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div id="global">
        <header>
            <a href="index.php"><h1 id="titreMarmiton">Marmiton index</h1></a>
            <p>Bienvenue sur notre site pour découvrir des recettes gourmandes.</p>
            <h4>Ajouter une <a href="index.php?action=nouvelle">recette</a></h4>
        </header>

        <div id="contenu">
            <?= $contenu ?>
        </div>

        <footer id="piedMarmiton">
            Blog réalisé avec PHP, HTML et CSS.
            <br>
            Par Umar, Charbel et Ashank.
        </footer>
    </div>
</body>
</html>
