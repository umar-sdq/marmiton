@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-center">Espace Administrateur</h1>

    <div class="alert alert-success text-center">
        Bonjour {{ Auth::user()->nom }} 👋 — vous êtes connecté en tant qu’<strong>ADMIN</strong>.
    </div>

    <h3 class="mt-4">Liste des recettes</h3>

    @if($recettes->isEmpty())
        <p>Aucune recette trouvée pour le moment.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Date création</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recettes as $recette)
                    <tr>
                        <td>{{ $recette->id }}</td>
                        <td>{{ $recette->titre }}</td>
                        <td>{{ Str::limit($recette->description, 60) }}</td>
                        <td>{{ $recette->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
