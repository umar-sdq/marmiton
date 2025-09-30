@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-10">
        <h2>Liste des utilisateurs</h2>
    </div>
    <div class="col-lg-2">
        <a class="btn btn-success" href="{{ route('utilisateurs.create') }}">Ajouter un utilisateur</a>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="container">
    <div class="row">
        @foreach ($utilisateurs as $utilisateur)
            <div class="col-md-4">
                <div class="card card-body mb-3">
                    <h2>{{ $utilisateur->nom }}</h2>
                    <p><strong>Identifiant :</strong> {{ $utilisateur->identifiant }}</p>
                    <a href="{{ route('utilisateurs.show', $utilisateur->id) }}" class="btn btn-outline-primary">En savoir plus</a>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
