<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Marmiton — Votre carnet culinaire</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #fffaf5, #f6ede6);
            margin: 0;
            color: #3f3024;
        }

        header {
            background: linear-gradient(90deg, #d9a679, #c97e5b);
            color: #fff;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        header h1 {
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            margin-left: 1.5rem;
            font-weight: 500;
            transition: 0.3s;
        }

        nav a:hover {
            color: #fff3e0;
        }

        .hero {
            text-align: center;
            padding: 6rem 1rem 4rem;
            max-width: 900px;
            margin: auto;
        }

        .hero h2 {
            font-size: 2.6rem;
            color: #875c3d;
            margin-bottom: 1rem;
        }

        .hero p {
            font-size: 1.1rem;
            color: #4a3a31;
            line-height: 1.6;
            max-width: 700px;
            margin: auto;
        }

        .hero .btn {
            display: inline-block;
            margin-top: 2rem;
            background: linear-gradient(90deg, #c97e5b, #d9a679);
            color: #fff;
            padding: 0.8rem 1.8rem;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
        }

        .hero .btn:hover {
            background: linear-gradient(90deg, #d9a679, #c97e5b);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(201, 126, 91, 0.3);
        }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            max-width: 1000px;
            margin: 4rem auto;
            padding: 0 1.5rem;
        }

        .feature {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 6px 16px rgba(0,0,0,0.05);
            padding: 2rem 1.5rem;
            text-align: center;
            transition: 0.3s;
        }

        .feature:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 24px rgba(175, 114, 82, 0.2);
        }

        .feature h3 {
            color: #b06b41;
            margin-bottom: 0.5rem;
        }

        .feature p {
            color: #4a3a31;
            line-height: 1.5;
        }

        footer {
            text-align: center;
            padding: 2rem;
            color: #6b4b32;
            font-size: 0.95rem;
            border-top: 1px solid #e8d9c9;
            background: #fffaf5;
        }

        @media (max-width: 768px) {
            .hero h2 {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>
    <header>
        <h1>Marmiton</h1>
        <nav>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/home') }}">Mon espace</a>
                @else
                    <a href="{{ route('login') }}">Connexion</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Inscription</a>
                    @endif
                @endauth
            @endif
        </nav>
    </header>

    <section class="hero">
        <h2>Marmiton</h2>
        <p>
            Marmiton n’est pas un réseau culinaire. C’est votre espace privé pour consigner vos plats, tester de nouvelles idées et garder trace de tout ce que vous cuisinez.  
            Ajoutez vos recettes, notez vos ajustements et suivez votre parcours culinaire au fil du temps.
        </p>
        <a href="{{ route('login') }}" class="btn">Commencer à enregistrer</a>
    </section>

    <section class="features">
        <div class="feature">
            <h3>Enregistrer vos recettes</h3>
            <p>Ajoutez facilement chaque repas que vous cuisinez  titre, ingrédients, instructions et photo  pour les retrouver à tout moment.</p>
        </div>
        
        <div class="feature">
            <h3>Suivi personnel</h3>
            <p>Gardez une trace de votre progression, de vos repas préférés et des améliorations que vous apportez à vos plats.</p>
        </div>

        <div class="feature">
            <h3>Un espace privé</h3>
            <p>Vos recettes vous appartiennent : tout est sauvegardé dans votre espace personnel, accessible uniquement à vous.</p>
        </div>
    </section>

    <footer>
        &copy; {{ date('Y') }} Marmiton — Votre carnet culinaire
    </footer>
</body>
</html>
