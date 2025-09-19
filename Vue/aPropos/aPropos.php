<?php ob_start(); ?>

<h2>À propos de l'application Marmiton</h2>

<p>
    Cette application est un mini-site de gestion de recettes et d’ingrédients. 
    Elle permet à un utilisateur de créer des recettes, d’y associer des ingrédients, 
    et de les gérer grâce à une interface simple.
</p>

<h3>1. Type d'association entre les tables</h3>
<p>
    La base de données comporte trois tables principales :
</p>
<ul>
    <li><strong>utilisateurs → recettes :</strong> relation <em>un-à-plusieurs</em> 
        (un utilisateur peut publier plusieurs recettes, mais une recette appartient à un seul utilisateur).
        <br>Contrainte : <code>ON DELETE SET NULL</code>, donc si l’utilisateur est supprimé, 
        la recette reste mais son auteur devient <code>NULL</code>.
    </li>
    <li><strong>recettes → ingredients :</strong> relation <em>un-à-plusieurs</em> 
        (une recette contient plusieurs ingrédients, mais un ingrédient appartient à une seule recette).
        <br>Contrainte : <code>ON DELETE CASCADE</code>, donc si une recette est supprimée, 
        tous ses ingrédients sont aussi supprimés.
    </li>
</ul>

<h3>2. Comment effectuer les tests</h3>
<ul>
    <li>
        <strong>Tests sur le modèle :</strong> réalisés avec <code>PHPUnit</code> pour valider 
        que les classes <code>Modele/</code> (ex. : <code>Recette.php</code>, <code>Utilisateur.php</code>) 
        interagissent correctement avec la base.
    </li>
    <li>
        <strong>Tests sur les vues :</strong> on capture la sortie HTML avec 
        <code>ob_start()</code> / <code>ob_get_clean()</code> et on vérifie la présence de mots-clés 
        (par exemple « Recette », « Se connecter », « Se déconnecter »).
    </li>
</ul>

<h3>3. Démarrage d'une session</h3>
<p>
    Lorsqu’un utilisateur se connecte avec son <strong>identifiant</strong> et son <strong>mot de passe</strong>, 
    une session PHP est créée :
</p>
<pre><code>$_SESSION['user'] = [
    'id'  => 1,
    'nom' => 'Admin'
];
</code></pre>
<p>
    Cette session reste active tant que l’utilisateur ne se déconnecte pas.
</p>

<h3>4. Opérations permises en session</h3>
<p>
    Quand un utilisateur est en session, il peut :
</p>
<ul>
    <li>Ajouter une recette ;</li>
    <li>Ajouter des ingrédients à une recette ;</li>
    <li>Supprimer ou rétablir une recette ;</li>
    <li>Se déconnecter.</li>
</ul>

<?php
$titre = "À propos";
$contenu = ob_get_clean();
require "gabarit.php";
?>
