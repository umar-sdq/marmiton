@extends('layouts.app')

@section('content')

<h1>{{ __('general.add_ingredient') }}</h1>

@if ($message = Session::get('warning'))
    <div class="alert alert-warning">
        <p>{{ $message }}</p>
    </div>
@endif

<form action="{{ route('ingredients.store') }}" method="POST">
    @csrf

    <div class="form-group mb-3">
        <label for="nom">{{ __('general.name') }} :</label>
        <input type="text" class="form-control" id="nom" name="nom" placeholder="{{ __('general.example_tomato') }}">
    </div>

    <div class="form-group mb-3">
        <label for="liste_ingredients">{{ __('general.details') }} :</label>
        <textarea name="liste_ingredients" id="liste_ingredients" cols="30" rows="3" class="form-control"></textarea>
    </div>

    <div class="form-group mb-3">
        <label for="recette_id">{{ __('general.recipe') }} :</label>
        <select name="recette_id" class="form-control">
            @foreach($recettes as $recette)
                <option value="{{ $recette->id }}">{{ $recette->titre }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">{{ __('general.save') }}</button>
    <a href="{{ route('ingredients.index') }}" class="btn btn-info">{{ __('general.back') }}</a>
</form>

@endsection
