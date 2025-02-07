<div>
    {{-- add new --}}
    <div class="flex items-center">
        @can('show_prisoners')
        <div>
            <button wire:click="modal" type="button"
                class="mb-4 text-white bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="w-3 h-3 text-zinc-200 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 1v16M1 9h16" />
                </svg>
            </button>
            <span class="text-sm ml-2">Adicionar Novo</span>
        </div>
        @endcan
    </div>

    <div class="mx-auto bg-white dark:bg-zinc-800 md:rounded-lg shadow-lg">
        {{-- Título da Página --}}
        <x-title-page>Pesquisa de Presos</x-title-page>
        {{-- fields seach --}}
        <div class=" p-6 overflow-hidden">
            @include('livewire.pages.prisoner.includes.search-field')
        </div>
        {{-- conteúdo da pesquisa --}}
        <div class="border-t pt-4 border-blue-700 dark:border-blue-600">
            @include('livewire.pages.prisoner.includes.search-card')
        </div>
        {{-- paginação --}}
        <div class="border-t p-4 border-blue-700 dark:border-blue-600">
            {{ $prisoners->onEachSide(1)->links() }}
        </div>
    </div>
    {{-- modal create --}}
    <form wire:submit="save">
        @include('livewire.pages.prisoner.includes.modal')
    </form>
</div>