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
    <label for="search" class="form-label fw-bold">{{ __('general.recipe_search') }} :</label>
    <input type="text" id="search" class="form-control" placeholder="{{ __('general.search_recipe_placeholder') }}">
</div>

<div class="container mt-4">
    <div class="row">
        @foreach ($recettes as $recette)
            <div class="col-md-4">
                <div class="card card-body mb-4 shadow-sm">

                    @if ($recette->photo)
                        <img src="{{ asset('images/' . $recette->photo) }}"
                             alt="{{ __('general.image_of') }} {{ $recette->titre }}"
                             class="img-fluid rounded mb-3"
                             style="max-height: 200px; object-fit: cover;">
                    @else
                        <p class="text-muted fst-italic">{{ __('general.no_image') }}</p>
                    @endif

                    <h4 class="fw-bold">{{ $recette->titre }}</h4>
                    <p>{{ Str::limit($recette->description, 100) }}</p>
                    <p><strong>{{ __('general.author') }} :</strong> {{ $recette->utilisateur->nom ?? __('general.unknown') }}</p>

                    <a href="{{ route('recettes.show', $recette->id) }}" class="btn btn-outline-primary">
                        {{ __('general.read_more') }}
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>

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
