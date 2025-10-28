@extends('layouts.app')

@section('content')
<div class="apropos-page">
    <h1>À propos</h1>
    <hr>

    <h3>Auteur</h3>
    <p><strong>Nom :</strong> Umar Siddiqui</p>

    <h3>Cours</h3>
    <p>
        <strong>Titre :</strong> 420-5H6 MO - Applications Web transactionnelles<br>
        <strong>Session :</strong> Automne 2023, Collège Montmorency
    </p>

    <h3>Étapes pour vérifier le bon fonctionnement de l’application</h3>
    <ol>
        <li><strong>Multilingue :</strong> Utilisez le menu FR / EN / ES pour changer la langue. Les textes doivent changer partout.</li>
        <li><strong>Vérification du courriel :</strong> Créez un compte. Vous serez redirigé vers “Vérifiez votre courriel”. Le lien de Mailtrap doit activer votre compte.</li>
        <li><strong>Rôles :</strong> Un utilisateur avec le rôle <code>USER</code> ne peut pas accéder à <code>/admin</code>. Un <code>ADMIN</code> y a accès.</li>
        <li><strong>Recettes :</strong> Ajoutez, modifiez ou supprimez une recette. L’image doit apparaître dans <code>public/images</code>.</li>
        <li><strong>Ingrédients :</strong> Ajoutez des ingrédients à une recette. Ils apparaissent dans la page de détails de la recette.</li>
        <li><strong>Autocomplétion :</strong> Tapez une partie d’un titre de recette dans la barre de recherche pour voir les suggestions.</li>
    </ol>

    <h3>Diagramme de la base de données</h3>
    <p>Structure de la base de données actuelle :</p>
    <img src="{{ asset('images/dbdiagram.png') }}" alt="Diagramme de la base de données" class="db-image">

    <h3>Sources d’inspiration</h3>
    <ul>
        <li><a href="https://www.marmiton.org/" target="_blank">Marmiton.org</a></li>
        <li><a href="https://getbootstrap.com/" target="_blank">Bootstrap</a></li>
    </ul>
</div>
@endsection
