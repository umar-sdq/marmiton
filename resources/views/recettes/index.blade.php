@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-10">
        <h2>@lang("general.Liste des recettes")</h2>
    </div>
    <div class="col-lg-2">
        <a class="btn btn-success" href="{{ route('recettes.create') }}">
            @lang("general.Ajouter une recette")
        </a>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success mt-3">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="mb-4">
    <label for="search" class="form-label fw-bold">
        @lang("general.Recherche de recette") :
    </label>
    <input type="text" id="search" class="form-control"
           placeholder="@lang('general.Tapez un titre de recette')...">
</div>

<div class="container mt-4">
    <div class="row">
        @foreach ($recettes as $recette)
            <div class="col-md-4">
                <div class="card card-body mb-4 shadow-sm">

                    @if ($recette->photo)
                        <img src="{{ asset('images/' . $recette->photo) }}" 
                             alt="@lang('general.Image de') {{ $recette->titre }}" 
                             class="img-fluid rounded mb-3" 
                             style="max-height: 200px; object-fit: cover;">
                    @else
                        <p class="text-muted fst-italic">
                            @lang("general.Aucune image disponible")
                        </p>
                    @endif

                    <h4 class="fw-bold">{{ $recette->titre }}</h4>
                    <p>{{ Str::limit($recette->description, 100) }}</p>
                    <p>
    <strong>@lang('general.Auteur') :</strong>
    {{ $recette->utilisateur->nom ?? __('general.Inconnu') }}
</p>


                    <a href="{{ route('recettes.show', $recette->id) }}" 
                       class="btn btn-outline-primary">
                       @lang("general.En savoir plus")
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

<script>
$(function() {
    $("#search").autocomplete({
        source: "{{ route('recettes.autocomplete') }}",
        select: function(event, ui) {
            $('#search').val(ui.item.value);
        }
    });
});
</script>

@endsection
