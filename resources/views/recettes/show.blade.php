@extends('layouts.app')

@section('content')
<div class="container">

    <h1>{{ $recette->titre }}</h1>
    <p><strong>{{ __('general.created_on') }} :</strong> {{ $recette->date_creation }}</p>
    <p class="lead">{{ $recette->description }}</p>
    <p><strong>{{ __('general.author') }} :</strong> {{ $recette->utilisateur->nom ?? __('general.unknown') }}</p>

    <div class="buttons mb-3">
        <a href="{{ route('recettes.edit', $recette->id) }}" class="btn btn-info">{{ __('general.edit') }}</a>
        <a href="{{ route('recettes.index') }}" class="btn btn-info">{{ __('general.back_to_list') }}</a>
        <form action="{{ route('recettes.destroy', $recette->id) }}" method="POST" style="display:inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">{{ __('general.delete') }}</button>
        </form>
    </div>

    <h2>{{ __('general.ingredients') }}</h2>
    <ul>
        @foreach ($recette->ingredients as $ingredient)
            <li><strong>{{ $ingredient->nom }}</strong> — {{ $ingredient->liste_ingredients }}</li>
        @endforeach
    </ul>

</div>
@endsection
