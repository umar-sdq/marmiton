@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-10">
        <h2>Liste des recettes</h2>
    </div>
    <div class="col-lg-2">
        <a class="btn btn-success" href="{{ route('recettes.create') }}">Ajouter une recette</a>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="container">
    <div class="row">
        @foreach ($recettes as $recette)
            <div class="col-md-4">
                <div class="card card-body mb-3">
                    <h2>{{ $recette->titre }}</h2>
                    <p>{{ Str::limit($recette->description, 100) }}</p>
                    <p><strong>Auteur :</strong> {{ $recette->utilisateur->nom ?? 'Inconnu' }}</p>
                    <a href="{{ route('recettes.show', $recette->id) }}" class="btn btn-outline-primary">En savoir plus</a>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
