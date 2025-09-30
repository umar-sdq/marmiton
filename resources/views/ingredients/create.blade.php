@extends('layouts.app')

@section('content')

<h1>Ajouter un ingrédient</h1>

@if ($message = Session::get('warning'))
    <div class="alert alert-warning">
        <p>{{ $message }}</p>
    </div>
@endif

<form action="{{ route('ingredients.store') }}" method="POST">
    @csrf

    <div class="form-group mb-3">
        <label for="nom">Nom :</label>
        <input type="text" class="form-control" id="nom" name="nom" placeholder="Ex: Tomates">
    </div>

    <div class="form-group mb-3">
        <label for="liste_ingredients">Détails :</label>
        <textarea name="liste_ingredients" id="liste_ingredients" cols="30" rows="3" class="form-control"></textarea>
    </div>

    <div class="form-group mb-3">
        <label for="recette_id">Recette :</label>
        <select name="recette_id" class="form-control">
            @foreach($recettes as $recette)
                <option value="{{ $recette->id }}">{{ $recette->titre }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Enregistrer</button>
    <a href="{{ route('ingredients.index') }}" class="btn btn-info">Retour</a>
</form>

@endsection
