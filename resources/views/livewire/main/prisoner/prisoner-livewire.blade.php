<div>
    <div class="mx-auto pb-12 p-6 sm:px-6 lg:px-8 bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg text-zinc-900 dark:text-zinc-100">
        {{-- Título da Página --}}
        <x-title-page>Pesquisa de Presos</x-title-page>
        <form>
            @include('livewire.main.prisoner.includes.search-field')
        </form>
    </div>

    <div class="mx-auto mt-6 p-6 sm:px-6 lg:px-8 bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg text-zinc-900 dark:text-zinc-100">
        @include('livewire.main.prisoner.includes.search-card')
    </div>
</div>
