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
                <a class="navbar-brand" href="{{ url('/apropos') }}">À propos</a>
                <a class="navbar-brand" href="{{ url('/recettes') }}">Recettes</a>
                <a class="navbar-brand" href="{{ url('/ingredients') }}">Ingrédients</a>

                {{-- ✅ Section connexion / déconnexion --}}
                <div class="ms-auto d-flex align-items-center">
                    @guest
                        {{-- Utilisateur non connecté --}}
                        <a class="navbar-brand" href="{{ route('login') }}">Connexion</a>
                        <a class="navbar-brand" href="{{ route('register') }}">Inscription</a>
                    @else
                        {{-- Utilisateur connecté --}}
                        @if (Auth::user()->role === 'ADMIN')
                            <a class="navbar-brand text-danger" href="{{ route('admin.recettes.index') }}">
                                Espace Admin
                            </a>
                        @endif

                        <span class="navbar-text me-3">
                            Bonjour, {{ Auth::user()->nom }} ({{ Auth::user()->role }})
                        </span>

                        <a class="navbar-brand text-muted" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Déconnexion
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
