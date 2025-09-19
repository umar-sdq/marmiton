<?php $this->titre = "À propos"; ?>
<a href="index.php?controleur=Recettes&action=index">← Retour à l'accueil</a>

<h2>À propos de l'application</h2>

<p>Ce site Marmiton est une application de gestion de recettes.</p>

<h3>Fonctionnement :</h3>
<ul>
    <li>Relation entre les tables : 
        <strong>Un utilisateur peut créer plusieurs recettes</strong> 
        (relation 1-N) et 
        <strong>chaque recette contient plusieurs ingrédients</strong> 
        (relation 1-N).</li>
    <li>Tests : effectués avec PHPUnit sur les modèles et vues (voir dossier <code>tests/</code>).</li>
    <li>Démarrage d'une session : connexion avec identifiant et mot de passe, stockés dans <code>$_SESSION['user']</code>.</li>
    <li>Opérations en session : ajouter / modifier / supprimer recettes et ingrédients, se déconnecter.</li>
</ul>
