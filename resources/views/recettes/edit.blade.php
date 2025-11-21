@extends('layouts.app')

@section('content')

<h1>{{ __('general.edit_recipe') }} : {{ $recette->titre }}</h1>

@if ($message = Session::get('warning'))
    <div class="alert alert-warning"><p>{{ $message }}</p></div>
@endif

<form method="POST" action="{{ route('recettes.update', $recette->id) }}">
    @method('PATCH')
    @csrf

    <div class="form-group mb-3">
        <label for="titre">{{ __('general.title') }} :</label>
        <input type="text" class="form-control" id="titre" name="titre" value="{{ $recette->titre }}">
    </div>

    <div class="form-group mb-3">
        <label for="description">{{ __('general.description') }} :</label>
        <textarea name="description" id="description" cols="30" rows="5" class="form-control">{{ $recette->description }}</textarea>
    </div>

    <div class="form-group mb-3">
        <label for="utilisateur_id">{{ __('general.author') }} :</label>
        <select name="utilisateur_id" class="form-control">
            @foreach($utilisateurs as $utilisateur)
                <option value="{{ $utilisateur->id }}" @if($utilisateur->id == $recette->utilisateur_id) selected @endif>
                    {{ $utilisateur->nom }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">{{ __('general.save') }}</button>
    <a href="{{ route('recettes.show', $recette->id) }}" class="btn btn-info">{{ __('general.cancel') }}</a>
</form>

@endsection
