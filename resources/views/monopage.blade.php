<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Marmiton SPA</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>

<body>

<div id="app"></div>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script>
    window.user_auth_data = @json([
        'isLoggedin' => Auth::check(),
        'user' => Auth::user()
    ]);
</script>

<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
