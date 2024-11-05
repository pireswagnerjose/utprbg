<div class="py-1 mx-4">
    {{-- add new --}}
    <div class="flex items-center">
        @can('admin-cartorio_admin-cartorio_user')
            <div>
                <button wire:click="modalCreate" type="button" class="mb-4 text-white bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-3 h-3 text-zinc-200 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                    </svg>
                </button>
                <span class="text-sm ml-2">Adicionar Novo</span>
            </div>
        @endcan
    </div>

    <div class="mx-auto p-6 sm:px-6 lg:px-8 bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg text-zinc-900 dark:text-zinc-100">
        {{-- Título da Página --}}
        <x-title-page>Pesquisa de Presos</x-title-page>
        <form>
            @include('livewire.main.prisoner.includes.search-field')
        </form>
    </div>

    <div class=" mx-auto mt-6 p-6 sm:px-6 lg:px-8 bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg text-zinc-900 dark:text-zinc-100">
        @include('livewire.main.prisoner.includes.search-card')
        @include('livewire.main.prisoner.includes.modal-create')
        
        {{-- paginação --}}
        <div class=" pl-2 py-1 mt-2 text-zinc-50 dark:text-zinc-400
                border-t border-blue-300 dark:border-blue-500 pb-3 ">
            {{ $prisoners->onEachSide(1)->links() }}
        </div>
    </div>
</div>