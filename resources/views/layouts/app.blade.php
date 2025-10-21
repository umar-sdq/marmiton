<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>

    <!-- Styles et Scripts -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">

                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name') }}
                </a>
                <a class="navbar-brand" href="{{ url('/apropos') }}">{{ __('general.about') }}</a>
                <a class="navbar-brand" href="{{ url('/recettes') }}">{{ __('general.recipes') }}</a>
                <a class="navbar-brand" href="{{ url('/ingredients') }}">{{ __('general.ingredients') }}</a>

                <div class="ms-auto d-flex align-items-center">
                    <form action="{{ route('language.switch') }}" method="POST" class="me-3">
                        @csrf
                        <select name="locale" onchange="this.form.submit()" class="form-select form-select-sm">
                            <option value="fr" {{ app()->getLocale() == 'fr' ? 'selected' : '' }}>🇫🇷 FR</option>
                            <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>🇬🇧 EN</option>
                            <option value="es" {{ app()->getLocale() == 'es' ? 'selected' : '' }}>🇪🇸 ES</option>
                        </select>
                    </form>

                    @guest
                        <a class="navbar-brand" href="{{ route('login') }}">{{ __('general.login') }}</a>
                        <a class="navbar-brand" href="{{ route('register') }}">{{ __('general.register') }}</a>
                    @else
                        @if (Auth::user()->role === 'ADMIN')
                            <a class="navbar-brand text-danger" href="{{ route('admin.recettes.index') }}">
                                {{ __('general.admin_area') }}
                            </a>
                        @endif

                        <span class="navbar-text me-3">
                            {{ __('general.hello') }}, {{ Auth::user()->nom }} ({{ Auth::user()->role }})
                        </span>

                        <a class="navbar-brand text-muted" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('general.logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endguest
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
