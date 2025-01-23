<x-guest-layout>
    <div class="flex items-center relative min-h-screen bg-zinc-100 dark:bg-dots-lighter dark:bg-zinc-900">
        <div class="absolute top-4">
            @include('dark-buttons')
        </div>
        @if (Route::has('login'))
        <div class="absolute top-0 right-6 p-6 text-right z-10">
            @auth
            <a href="{{ url('/dashboard') }}"
                class="font-semibold text-zinc-500 hover:text-zinc-600 dark:text-zinc-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
            @else
            <a href="{{ route('login') }}"
                class="font-semibold text-zinc-500 hover:text-zinc-600 dark:text-zinc-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">LOGIN</a>
            @endauth
        </div>
        @endif

        <div class="w-full p-6">
            <div class="flex justify-center">
                <img style="width: 200px" src="{{ asset('storage/site/policia_penal_logo.svg') }}"
                    alt="Logo da Polícia Penal" />
            </div>

            <h1 class="w-full mt-6 text-center text-2xl text-zinc-500 dark:text-zinc-400">
                Polícia Penal do Tocantins
            </h1>
        </div>
    </div>
</x-guest-layout>