<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        @livewireStyles

        <!-- Scripts -->

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="{{ asset('js/app.js') }}" defer></script>	
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <div id="message_div" style="display: @if(Session::has('message')) block @else none @endif">
                <div class="alert alert-success max-w-7xl mx-auto pt-4 px-4 sm:px-6 lg:px-8">
                    <div class="rounded-r-md bg-green-100 p-4 border-l-4 border-green-400 mb-3">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <p class="text-green-400">
                                    <i class="fas fa-check"></i>
                                </p>
                            </div>
                            <div class="ml-3 text-sm leading-5 font-medium text-green-800">
                                <p id="message" class="alert @if(Session::has('message')) {{ Session::get('alert-class', 'alert-info') }} @endif">
                                    @if(Session::has('message')) {{ Session::get('message') }} @endif</p>
                            </div>
                            <div class="ml-auto pl-3">
                                <div class="-mx-1.5 -my-1.5">
                                    <button type="button" class="inline-flex rounded-md p-1.5 text-green-800 focus:outline-none transition ease-in-out duration-150" wire:click="dismiss">
                                    <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            {{-- class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg  --}}
            <main>
                {{-- <div class="container-fluid py-4"> --}}
                    {{ $slot }}
                {{-- </div> --}}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
