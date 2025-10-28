<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>

    <!-- Styles et Scripts -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/forms.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/recettes.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/apropos.css') }}">

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md custom-navbar shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">
             {{ config('app.name') }}
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="{{ url('/apropos') }}">{{ __('general.about') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/recettes') }}">{{ __('general.recipes') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/ingredients') }}">{{ __('general.ingredients') }}</a></li>
            </ul>

            <div class="d-flex align-items-center gap-3">
                <form action="{{ route('language.switch') }}" method="POST" class="language-form">
                    @csrf
                    <select name="locale" onchange="this.form.submit()" class="form-select form-select-sm">
                        <option value="fr" {{ app()->getLocale() == 'fr' ? 'selected' : '' }}>🇫🇷 FR</option>
                        <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>🇬🇧 EN</option>
                        <option value="es" {{ app()->getLocale() == 'es' ? 'selected' : '' }}>🇪🇸 ES</option>
                    </select>
                </form>

                @guest
                    <a class="nav-btn" href="{{ route('login') }}">{{ __('general.login') }}</a>
                    <a class="nav-btn alt" href="{{ route('register') }}">{{ __('general.register') }}</a>
                @else
                    @if (Auth::user()->role === 'ADMIN')
                        <a class="nav-btn admin" href="{{ route('admin.recettes.index') }}">
                            {{ __('general.admin_area') }}
                        </a>
                    @endif

                    <span class="user-info">
                        {{ __('general.hello') }}, <strong>{{ Auth::user()->nom }}</strong>
                        <small>({{ Auth::user()->role }})</small>
                    </span>

                    <a class="nav-btn logout" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('general.logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endguest
            </div>
        </div>
    </div>
</nav>


        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
