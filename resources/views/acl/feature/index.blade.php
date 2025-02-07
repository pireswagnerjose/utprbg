<x-app-layout>
    {{-- Alert component --}}
    <div class="my-2">
        @include('acl.feature.includes.alerts')
    </div>
    <div
        class="mx-auto pb-12 p-6 sm:px-6 lg:px-8 bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg text-zinc-900 dark:text-zinc-100">

        <div class="flex mb-4">
            <h2 class="font-semibold text-lg text-zinc-800 dark:text-zinc-400 mb-5">Funcionalidade</h2>
        </div>

        {{-- Botão Adicionar Novo --}}
        <div class="flex items-center mb-6 ml-16">
            <form action="{{ route('feature.create') }}" method="GET">
                @csrf
                <button type="submit"
                    class="rounded-full p-2 bg-blue-700 hover:bg-blue-800 dark:bg-blue-600/50 dark:hover:bg-blue-700/50 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800">
                    <i data-lucide="plus" class="w-7 h-7 text-zinc-100 dark:text-zinc-200"></i>
                </button>
            </form>
        </div>

        {{-- search --}}
        @include('acl.feature.includes.search')

        {{-- card --}}
        @foreach ($features as $feature)
        @include('acl.feature.includes.card')
        @endforeach

        {{-- paginação --}}
        <div class="pl-2 py-4 mt-4 text-zinc-50 dark:text-zinc-400 border-t border-blue-300 dark:border-blue-500 pb-3">
            {{ $features->onEachSide(3)->links() }}
        </div>
    </div>
</x-app-layout>