<!-- Application par Jonathan Carrière -->
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('AniListe', 'AniListe') }}</title>
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.js'></script>
        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
        @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/js/interface.js', 'resources/css/style_calendrier.css'])
    </head>
    <body>
        @include('layouts.navigation')
            <main role="main" class="container text-light min-vh-100">
                {{ $slot }}
            </main>
        @include('layouts.footer')
    </body>
</html>
