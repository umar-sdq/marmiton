<?php $titre = "Recette " . ($recette['titre'] ?? ''); ?>
<?php ob_start(); ?>

<article>
  <header>
    <h1 class="titreRecette"><?= htmlspecialchars($recette['titre'] ?? '') ?></h1>
    <?php if (!empty($recette['date_creation'])): ?>
      <time><?= htmlspecialchars($recette['date_creation']) ?></time>,
      par utilisateur #<?= htmlspecialchars($recette['utilisateur_id']) ?>
    <?php endif; ?>
  </header>
  <p><?= htmlspecialchars($recette['description'] ?? '') ?></p>
</article>

<hr/>

<h2><?= ($recette['id'] ?? 0) ? "Modifier la recette" : "Ajouter une recette" ?></h2>
<form action="index.php?action=enregistrerRecette" method="post">
  <p>
    <label for="titre">Titre</label>
    <input type="text" name="titre" id="titre" value="<?= htmlspecialchars($recette['titre'] ?? '') ?>"/>

    <label for="description">Description</label>
    <input type="text" name="description" id="description" value="<?= htmlspecialchars($recette['description'] ?? '') ?>"/>

    <input type="hidden" name="id" value="<?= intval($recette['id'] ?? 0) ?>"/>
    <input type="submit" value="<?= ($recette['id'] ?? 0) ? "Enregistrer" : "Ajouter" ?>"/>
  </p>
</form>

<h2>Ajouter des ingrédients</h2>
<form action="index.php?action=ingredient" method="post">
  <p>
    <label for="nom">Nom</label>
    <input type="text" name="nom" id="nom"/>

    <input type="hidden" name="recette_id" value="<?= intval($recette['id'] ?? 0) ?>"/>

    <label for="liste_ingredients">Liste Ingrédients</label>
    <input type="text" name="liste_ingredients" id="liste_ingredients"/>

    <input type="submit" value="Ajouter"/>
  </p>
</form>

<?php $contenu = ob_get_clean(); ?>
<?php require 'gabarit.php'; ?>
