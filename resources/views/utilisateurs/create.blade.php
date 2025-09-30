@extends('layouts.app')

@section('content')

<h1>Ajouter un utilisateur</h1>

@if ($message = Session::get('warning'))
    <div class="alert alert-warning">
        <p>{{ $message }}</p>
    </div>
@endif

<form action="{{ route('utilisateurs.store') }}" method="POST">
    @csrf

    <div class="form-group mb-3">
        <label for="nom">Nom :</label>
        <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez le nom">
    </div>

    <div class="form-group mb-3">
        <label for="identifiant">Identifiant :</label>
        <input type="text" class="form-control" id="identifiant" name="identifiant" placeholder="Entrez un identifiant">
    </div>

    <div class="form-group mb-3">
        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" placeholder="Entrez un mot de passe">
    </div>

    <button type="submit" class="btn btn-primary">Enregistrer</button>
    <a href="{{ route('utilisateurs.index') }}" class="btn btn-info">Retour</a>
</form>

@endsection
