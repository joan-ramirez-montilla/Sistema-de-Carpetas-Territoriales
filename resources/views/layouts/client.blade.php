<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ 'TITTLE' ?? config('app.name') }}</title>

    <!-- Notyf -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf/notyf.min.css">
    <script src="https://cdn.jsdelivr.net/npm/notyf/notyf.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @fluxAppearance

    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet">

    <style>

        h1,
        h2,
        h3 {
            font-family: 'Playfair Display', serif !important;
        }

        body {
        color: black !important;
        }

        body,
        p,
        span {


            font-family: 'Inter', sans-serif !important;
        }

        /* Animación de pulso para el texto */
        @keyframes pulse-slow {

            0%,
            100% {
                opacity: 1;
                transform: translateY(0);
            }

            50% {
                opacity: 0.9;
                transform: translateY(-2px);
            }
        }

        .animate-pulse-slow {
            animation: pulse-slow 2s infinite;
        }
    </style>
</head>

<body>
    {{ $slot }}
</body>

</html>
