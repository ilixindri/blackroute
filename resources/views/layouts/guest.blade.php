<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
	
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	<script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
                <div id="menu" class="hidden fixed top-0 center-0 px-6 py-4 sm:block">
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Conectar</a>
                </div>
                {{ $slot }}
            </div>
        </div>
    </body>
</html>