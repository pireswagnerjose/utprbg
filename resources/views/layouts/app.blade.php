<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name', 'PP') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        {{-- IMPORTANTE - quando colocar em produçao atualizar o endereço --}}
        <link rel="stylesheet" href="{{ asset('build/assets/app-e78e68da.css') }}">
        <script type="text/javascript" src="{{ asset('build/assets/app-ef1f7ec7.js') }}"></script>

        {{-- importas as bibliotecas para os campos com máscara --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @include('layouts.scripts-header')

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-zinc-100 dark:bg-zinc-900">
            
            @livewire('navigation-menu')

            <!-- Page Content -->
            <main class="pt-36 max-w-7xl mx-auto py-24">
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @include('footer')

        @include('layouts.script-dark')

        <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
        @livewireScripts
    </body>
</html>
