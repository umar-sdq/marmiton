@extends('layouts.app')

@section('content')

<h1>{{ __('general.edit_user') }} : {{ $utilisateur->nom }}</h1>

@if ($message = Session::get('warning'))
    <div class="alert alert-warning"><p>{{ $message }}</p></div>
@endif

<form method="POST" action="{{ route('utilisateurs.update', $utilisateur->id) }}">
    @method('PATCH')
    @csrf

    <div class="form-group mb-3">
        <label for="nom">{{ __('general.name') }} :</label>
        <input type="text" class="form-control" id="nom" name="nom" value="{{ $utilisateur->nom }}">
    </div>

    <div class="form-group mb-3">
        <label for="identifiant">{{ __('general.username') }} :</label>
        <input type="text" class="form-control" id="identifiant" name="identifiant" value="{{ $utilisateur->identifiant }}">
    </div>

    <div class="form-group mb-3">
        <label for="mot_de_passe">{{ __('general.password') }} :</label>
        <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" value="{{ $utilisateur->mot_de_passe }}">
    </div>

    <button type="submit" class="btn btn-primary">{{ __('general.update') }}</button>
    <a href="{{ route('utilisateurs.show', $utilisateur->id) }}" class="btn btn-info">{{ __('general.cancel') }}</a>
</form>

@endsection
