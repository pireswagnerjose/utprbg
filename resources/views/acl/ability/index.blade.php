<x-app-layout>
    {{-- Alert component --}}
    <div class="my-2">
        @include('acl.ability.includes.alerts')
    </div>
    <div
        class="mx-auto pb-12 p-6 sm:px-6 lg:px-8 bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg text-zinc-900 dark:text-zinc-100">

        <div class="flex mb-4">
            <h2 class="font-semibold text-lg text-zinc-800 dark:text-zinc-400 mb-5">Nível de Acesso</h2>
        </div>

        {{-- Botão Adicionar Novo --}}
        <div class="flex items-center mb-6 ml-16">
            <form action="{{ route('ability.create') }}" method="GET">
                @csrf
                <button type="submit"
                    class="p-2.5 mb-4 bg-blue-600 dark:bg-blue-500/50 hover:opacity-50 transition duration-500 rounded-full">
                    <x-lucide-plus class="w-4 h-4 text-zinc-100 dark:text-zinc-200"></x-lucide-plus>
                </button>
            </form>
        </div>

        {{-- search --}}
        @include('acl.ability.includes.search')

        {{-- card --}}
        @foreach ($features as $key => $feature )
        <div
            class="w-[80%] mx-auto flex items-center gap-2 mt-6 border-b border-zinc-300 dark:border-zinc-600 font-bold text-base text-blue-600">
            <x-lucide-arrow-big-right-dash class="w-4 h-4 text-gray-300 dark:text-gray-600">
            </x-lucide-arrow-big-right-dash>
            <h1>{{ $key + 1 }}</h1>
            <h1>{{ $feature->title }}</h1>
        </div>
        @foreach ($feature->abilities as $ability)
        @include('acl.ability.includes.card')
        @endforeach
        @endforeach

        {{-- paginação --}}
        <div class="pl-2 py-4 mt-4 text-zinc-50 dark:text-zinc-400 border-t border-blue-300 dark:border-blue-500 pb-3">
            {{ $features->onEachSide(3)->links(data: ['scrollTo' => false]) }}
        </div>
    </div>
</x-app-layout>