@extends('layouts.app')

@section('content')
<div class="container">

    <h1>{{ $utilisateur->nom }}</h1>
    <p><strong>Identifiant :</strong> {{ $utilisateur->identifiant }}</p>
    <p><strong>Mot de passe :</strong> {{ $utilisateur->mot_de_passe }}</p>

    <div class="buttons mb-3">
        <a href="{{ route('utilisateurs.edit', $utilisateur->id) }}" class="btn btn-info">Modifier</a>
        <a href="{{ route('utilisateurs.index') }}" class="btn btn-info">Retour</a>
        <form action="{{ route('utilisateurs.destroy', $utilisateur->id) }}" method="POST" style="display:inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Supprimer</button>
        </form>
    </div>

</div>
@endsection
