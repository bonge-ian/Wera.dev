<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Wera.co.ke') }} | @yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>
</head>
<body>
    <div id="app">
        @include('includes.nav')
        @yield('offcanvas')
       <main class="uk-container">
            @include('includes.alerts')
    
            @yield('content')
       </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- use this if there is no internet connection --}}
    {{-- <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replaceAll( 'uk-textarea');
    </script> --}}
    <script>
        CKEDITOR.replaceAll( 'uk-textarea', {
            extraPlugins: 'placeholder'
        } );
    </script>
</body>
</html>
