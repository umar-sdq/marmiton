@extends('layouts.app')

@section('content')

<h1>{{ __('general.add_user') }}</h1>

@if ($message = Session::get('warning'))
    <div class="alert alert-warning"><p>{{ $message }}</p></div>
@endif

<form action="{{ route('utilisateurs.store') }}" method="POST">
    @csrf

    <div class="form-group mb-3">
        <label for="nom">{{ __('general.name') }} :</label>
        <input type="text" class="form-control" id="nom" name="nom" placeholder="{{ __('general.enter_name') }}">
    </div>

    <div class="form-group mb-3">
        <label for="identifiant">{{ __('general.username') }} :</label>
        <input type="text" class="form-control" id="identifiant" name="identifiant" placeholder="{{ __('general.enter_username') }}">
    </div>

    <div class="form-group mb-3">
        <label for="mot_de_passe">{{ __('general.password') }} :</label>
        <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" placeholder="{{ __('general.enter_password') }}">
    </div>

    <button type="submit" class="btn btn-primary">{{ __('general.save') }}</button>
    <a href="{{ route('utilisateurs.index') }}" class="btn btn-info">{{ __('general.back') }}</a>
</form>

@endsection
