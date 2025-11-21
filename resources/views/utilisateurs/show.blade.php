@extends('layouts.app')

@section('content')
<div class="container">

    <h1>{{ $utilisateur->nom }}</h1>
    <p><strong>{{ __('general.username') }} :</strong> {{ $utilisateur->identifiant }}</p>
    <p><strong>{{ __('general.password') }} :</strong> {{ $utilisateur->mot_de_passe }}</p>

    <div class="buttons mb-3">
        <a href="{{ route('utilisateurs.edit', $utilisateur->id) }}" class="btn btn-info">{{ __('general.edit') }}</a>
        <a href="{{ route('utilisateurs.index') }}" class="btn btn-info">{{ __('general.back') }}</a>
        <form action="{{ route('utilisateurs.destroy', $utilisateur->id) }}" method="POST" style="display:inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">{{ __('general.delete') }}</button>
        </form>
    </div>

</div>
@endsection
