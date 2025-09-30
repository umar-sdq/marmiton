@extends('layouts.app')

@section('content')
<div class="container">

    <h1>{{ $recette->titre }}</h1>
    <p><strong>Créée le :</strong> {{ $recette->date_creation }}</p>
    <p class="lead">{{ $recette->description }}</p>
    <p><strong>Auteur :</strong> {{ $recette->utilisateur->nom ?? 'Inconnu' }}</p>

    <div class="buttons mb-3">
        <a href="{{ route('recettes.edit', $recette->id) }}" class="btn btn-info">Modifier</a>
        <a href="{{ route('recettes.index') }}" class="btn btn-info">Retour à la liste</a>
        <form action="{{ route('recettes.destroy', $recette->id) }}" method="POST" style="display:inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Supprimer</button>
        </form>
    </div>

    <h2>Ingrédients</h2>
    <ul>
        @foreach ($recette->ingredients as $ingredient)
            <li><strong>{{ $ingredient->nom }}</strong> — {{ $ingredient->liste_ingredients }}</li>
        @endforeach
    </ul>

</div>
@endsection
