@extends('layouts.app')

@section('content')

<h1>{{ __('general.add_recipe') }}</h1>

@if ($message = Session::get('warning'))
    <div class="alert alert-warning"><p>{{ $message }}</p></div>
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
        <label for="titre">{{ __('general.title') }} :</label>
        <input type="text" class="form-control" id="titre" placeholder="{{ __('general.enter_title') }}" name="titre">
    </div>

    <div class="form-group mb-3">
        <label for="description">{{ __('general.description') }} :</label>
        <textarea name="description" id="description" cols="30" rows="5" class="form-control"></textarea>
    </div>

    <div class="form-group mb-3">
        <label for="photo">{{ __('general.image') }} :</label>
        <input type="file" name="photo" id="photo" class="form-control">
    </div>

    <div class="form-group mb-3">
        <label for="utilisateur_id">{{ __('general.author') }} :</label>
        <select name="utilisateur_id" class="form-control">
            @foreach($utilisateurs as $utilisateur)
                <option value="{{ $utilisateur->id }}">{{ $utilisateur->nom }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">{{ __('general.publish') }}</button>
    <a href="{{ route('recettes.index') }}" class="btn btn-info">{{ __('general.back_to_list') }}</a>
</form>

@endsection
