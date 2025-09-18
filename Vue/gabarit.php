<?php // Vue/gabarit.php ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= isset($titre) ? htmlspecialchars($titre) : 'Marmiton' ?></title>
    <link rel="stylesheet" href="<?= Configuration::get("racineWeb") ?>Contenu/style.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

    <?php if (isset($utilisateur)) : ?>
                    <h3>Bonjour <?= $utilisateur['nom'] ?>,
                        <a href="Utilisateurs/deconnecter"><small>[Se déconnecter]</small></a>
                    </h3>
                <?php else : ?>
                    <h3>[<a href="Utilisateurs/index">Se connecter</a>] <small>(admin/admin)</small></h3>
                <?php endif; ?>
    
    <div id="global">
            <a href="index.php"><h1 id="titreMarmiton">Marmiton index</h1></a>
            <h2>Bienvenue sur notre site pour découvrir des recettes gourmandes.</h2>
            <h4>Ajouter une <a href="<?= Configuration::get("racineWeb") ?>index.php?controleur=Recettes&action=nouvelle">recette</a>
</h4>
        

        
            <?= $contenu ?>

        </div>

        <footer id="piedMarmiton">
            Site Marmiton réalisé avec PHP, HTML et CSS.
            <br>
            Par Umar, Charbel et Ashank.
        </footer>
    </div>
</body>
</html>
