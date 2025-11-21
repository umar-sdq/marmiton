@extends('layouts.app')

@section('content')

<h1>{{ __('general.edit_ingredient') }} : {{ $ingredient->nom }}</h1>

@if ($message = Session::get('warning'))
    <div class="alert alert-warning">
        <p>{{ $message }}</p>
    </div>
@endif

<form method="POST" action="{{ route('ingredients.update', $ingredient->id) }}">
    @method('PATCH')
    @csrf

    <div class="form-group mb-3">
        <label for="nom">{{ __('general.name') }} :</label>
        <input type="text" class="form-control" id="nom" name="nom" value="{{ $ingredient->nom }}">
    </div>

    <div class="form-group mb-3">
        <label for="liste_ingredients">{{ __('general.details') }} :</label>
        <textarea name="liste_ingredients" id="liste_ingredients" cols="30" rows="3" class="form-control">{{ $ingredient->liste_ingredients }}</textarea>
    </div>

    <div class="form-group mb-3">
        <label for="recette_id">{{ __('general.recipe') }} :</label>
        <select name="recette_id" class="form-control">
            @foreach($recettes as $recette)
                <option value="{{ $recette->id }}" @if($recette->id == $ingredient->recette_id) selected @endif>
                    {{ $recette->titre }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">{{ __('general.update') }}</button>
    <a href="{{ route('ingredients.show', $ingredient->id) }}" class="btn btn-info">{{ __('general.cancel') }}</a>
</form>

@endsection
