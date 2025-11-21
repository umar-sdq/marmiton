@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-10">
        <h2>{{ __('general.users_list') }}</h2>
    </div>
    <div class="col-lg-2">
        <a class="btn btn-success" href="{{ route('utilisateurs.create') }}">
            {{ __('general.add_user') }}
        </a>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success"><p>{{ $message }}</p></div>
@endif

<div class="container mt-3">
    <div class="row">
        @foreach ($utilisateurs as $utilisateur)
            <div class="col-md-4">
                <div class="card card-body mb-3">
                    <h2>{{ $utilisateur->nom }}</h2>
                    <p><strong>{{ __('general.username') }} :</strong> {{ $utilisateur->identifiant }}</p>
                    <a href="{{ route('utilisateurs.show', $utilisateur->id) }}" class="btn btn-outline-primary">
                        {{ __('general.read_more') }}
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
