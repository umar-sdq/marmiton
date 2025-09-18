<?php $titre = "Recette " . $recette['titre']; ob_start(); ?>

<div class="card">
  <h1><?= htmlspecialchars($recette['titre']) ?></h1>
  <p><?= nl2br(htmlspecialchars($recette['description'])) ?></p>
  <time><?= htmlspecialchars($recette['date_creation']) ?></time>,
  par utilisateur #<?= htmlspecialchars($recette['utilisateur_id']) ?>
</div>

<hr>

<h2>Ingrédients</h2>
<ul>
  <?php foreach ($ingredients as $ing): ?>
    <li>
      <strong><?= htmlspecialchars($ing['nom']) ?></strong>
      <?php if (!empty($ing['liste_ingredients'])): ?>
        – <?= htmlspecialchars($ing['liste_ingredients']) ?>
      <?php endif; ?>

      <form action="index.php?controleur=AdminIngredients&action=supprimer" method="post" style="display:inline">
    <input type="hidden" name="id" value="<?= $ing['id'] ?>">
    <input type="hidden" name="recette_id" value="<?= $recette['id'] ?>">
    <button type="submit">Supprimer ingrédient</button>
  </form>

    </li>
  <?php endforeach; ?>
</ul>

<h2>Ajouter un ingrédient</h2>
<form action="<?= Configuration::get("racineWeb") ?>index.php?controleur=AdminIngredients&action=nouveau" method="post">
    <input type="hidden" name="recette_id" value="<?= $recette['id'] ?>">
    <label>Nom</label>
    <input type="text" name="nom" required>
    <label>Détail</label>
    <input type="text" name="liste_ingredients">
    <button type="submit">Ajouter</button>
</form>



<hr>

<!-- Formulaire suppression recette -->
<form action="index.php?controleur=Recettes&action=supprimer" method="post" 
      onsubmit="return confirm('Supprimer cette recette ?');">
  <input type="hidden" name="id" value="<?= $recette['id'] ?>">
  <button type="submit">Supprimer la recette</button>
</form>

<?php $contenu = ob_get_clean(); require 'Vue/gabarit.php'; ?>
