@extends('layouts.app')

@section('content')
<div class="container">
    <div class="recipe-card mx-auto shadow-sm">
        <h1 class="recipe-title">{{ $recette->titre }}</h1>
        <p class="lead recipe-desc">{{ $recette->description }}</p>
        <p class="author"><strong>{{ __('general.author') }} :</strong> {{ $recette->utilisateur->nom ?? __('general.unknown') }}</p>

        <div class="button-group mb-4">
            <a href="{{ route('recettes.edit', $recette->id) }}" class="btn btn-outline-secondary">{{ __('general.edit') }}</a>
            <a href="{{ route('recettes.index') }}" class="btn btn-outline-secondary">{{ __('general.back_to_list') }}</a>
            <a href="{{ route('ingredients.index') }}" class="btn btn-outline-secondary">{{ __('general.add_ingredient') }}</a>
            <form action="{{ route('recettes.destroy', $recette->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">{{ __('general.delete') }}</button>
            </form>
        </div>

        <h2 class="sub-title">{{ __('general.ingredients') }}</h2>
        <ul class="ingredient-list">
            @foreach ($recette->ingredients as $ingredient)
                <li>
                    <strong>{{ $ingredient->nom }}</strong> — {{ $ingredient->liste_ingredients }}
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
