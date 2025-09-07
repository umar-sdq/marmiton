// vueAccueil.php
<?php
$titre = 'Marmiton';
echo " TEST acceuil";

ob_start();
?>
<h1>Liste des recettes</h1>

<?php foreach ($recettes as $recette): ?>
    <article>
        <header>
            <a href="<?= "index.php?action=recette&id=" . $recette['id'] ?>">
                <h1 class="titreRecette"><?= $recette['titre'] ?></h1>
            </a>
            <h3><?= $recette['description'] ?></h3>
            <time><?= $recette['date_creation'] ?></time>,
            par utilisateur #<?= $recette['utilisateur_id'] ?>
        </header>
    </article>
    <hr />
<?php endforeach; ?>

<?php
$contenu = ob_get_clean();
require 'gabarit.php';
?>
