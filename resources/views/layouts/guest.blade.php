<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        {{-- IMPORTANTE - quando colocar em produçao atualizar o endereço --}}
        <link rel="stylesheet" href="{{ asset('build/assets/app-bcea521e.css') }}">
        <script type="text/javascript" src="{{ asset('build/assets/app-f4463062.js') }}"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        {{-- modo dark --}}
        <script>
            // On page load or when changing themes, best to add inline in `head` to avoid FOUC
            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
                    '(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark')
            }
        </script>

        <!-- Styles -->
        @livewireStyles
    </head>
    <body>
        <div class="font-sans text-zinc-900 dark:text-zinc-100 antialiased">
            {{ $slot }}
        </div>

        @include('layouts.script-dark')
        <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
        @livewireScripts
    </body>
</html>
