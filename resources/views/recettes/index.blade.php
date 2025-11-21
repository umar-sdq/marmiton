@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-10">
        <h2>{{ __('general.recipes_list') }}</h2>
    </div>
    <div class="col-lg-2">
        <a class="btn btn-success" href="{{ route('recettes.create') }}">
            {{ __('general.add_recipe') }}
        </a>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success mt-3"><p>{{ $message }}</p></div>
@endif

<div class="mb-4">
    <input type="text" id="search" class="form-control" placeholder="{{ __('general.search_recipe_placeholder') }}">
</div>

<div class="container mt-4">
    <div class="row">
        @foreach ($recettes as $recette)
            <div class="col-md-4">
                <div class="card card-body mb-4 shadow-sm">
                    @if ($recette->photo)
                        <img src="{{ asset('images/' . $recette->photo) }}" alt="{{ $recette->titre }}" class="img-fluid rounded mb-3" style="max-height: 200px; object-fit: cover;">
                    @else
                        <p class="text-muted fst-italic">{{ __('general.no_image') }}</p>
                    @endif

                    <h4 class="fw-bold">{{ $recette->titre }}</h4>
                    <p>{{ Str::limit($recette->description, 100) }}</p>
                    <p><strong>{{ __('general.author') }} :</strong> {{ $recette->utilisateur->nom ?? __('general.unknown') }}</p>

                    <a href="{{ route('recettes.show', $recette->id) }}" class="btn btn-outline-primary">{{ __('general.read_more') }}</a>
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
        minLength: 1,
        select: function(event, ui) {
            window.location.href = "/recettes/" + ui.item.id;
        }
    });
});
</script>

@endsection
