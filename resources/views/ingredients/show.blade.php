@extends('layouts.app')

@section('content')
<div class="container">

    <h1>{{ $ingredient->nom }}</h1>
    <p><strong>{{ __('general.details') }} :</strong> {{ $ingredient->liste_ingredients }}</p>
    <p><strong>{{ __('general.recipe') }} :</strong> {{ $ingredient->recette->titre ?? '—' }}</p>

    <div class="buttons mb-3">
        <a href="{{ route('ingredients.edit', $ingredient->id) }}" class="btn btn-info">{{ __('general.edit') }}</a>
        <a href="{{ route('ingredients.index') }}" class="btn btn-info">{{ __('general.back') }}</a>
        <form action="{{ route('ingredients.destroy', $ingredient->id) }}" method="POST" style="display:inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">{{ __('general.delete') }}</button>
        </form>
    </div>

</div>
@endsection
