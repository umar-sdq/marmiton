@extends('layouts.app')

@section('content')

<h1>Ajouter une recette</h1>

@if ($message = Session::get('warning'))
    <div class="alert alert-warning">
        <p>{{ $message }}</p>
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('recettes.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group mb-3">
        <label for="titre">Titre :</label>
        <input type="text" class="form-control" id="titre" placeholder="Entrez un titre" name="titre">
    </div>

    <div class="form-group mb-3">
        <label for="description">Description :</label>
        <textarea name="description" id="description" cols="30" rows="5" class="form-control"></textarea>
    </div>

    <div class="form-group mb-3">
        <label for="photo">Image :</label>
        <input type="file" name="photo" id="photo" class="form-control">
    </div>

    <div class="form-group mb-3">
        <label for="utilisateur_id">Auteur :</label>
        <select name="utilisateur_id" class="form-control">
            @foreach($utilisateurs as $utilisateur)
                <option value="{{ $utilisateur->id }}">{{ $utilisateur->nom }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Publier</button>
    <a href="{{ route('recettes.index') }}" class="btn btn-info">Retour à la liste</a>
</form>

@endsection
