@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-10">
        <h2>Liste des ingrédients</h2>
    </div>
    <div class="col-lg-2">
        <a class="btn btn-success" href="{{ route('ingredients.create') }}">Ajouter un ingrédient</a>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="container">
    <div class="row">
        @foreach ($ingredients as $ingredient)
            <div class="col-md-4">
                <div class="card card-body mb-3">
                    <h2>{{ $ingredient->nom }}</h2>
                    <p>{{ $ingredient->liste_ingredients }}</p>
                    <p><strong>Recette :</strong> {{ $ingredient->recette->titre ?? '—' }}</p>
                    <a href="{{ route('ingredients.show', $ingredient->id) }}" class="btn btn-outline-primary">En savoir plus</a>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
