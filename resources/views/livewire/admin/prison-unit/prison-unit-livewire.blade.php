<div>
    <div class="mx-auto pb-12 p-6 sm:px-6 lg:px-8 bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg text-zinc-900 dark:text-zinc-100">

        <div class="flex mb-4">
            <h2 class="font-semibold text-lg text-zinc-800 dark:text-zinc-400 mb-5">Cadastro de Unidade Prisional</h2>
        </div>

        {{-- Botão Adicionar Novo --}}
        <div class="flex items-center mb-6 ml-16">
            <button wire:click="addNew" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="w-5 h-5 text-zinc-200 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                </svg>
            </button>
            <span class="text-sm">Adicionar Novo</span>
        </div>

        {{-- create --}}
        @if($add_new == true)
            @include('livewire.admin.prison-unit.includes.create')
        @endif

        {{-- search --}}
        @include('livewire.admin.prison-unit.includes.search')

        {{-- card --}}
        @foreach ($prisonUnits as $prisonUnit)
            @include('livewire.admin.prison-unit.includes.card')
        @endforeach
        @include('livewire.admin.prison-unit.includes.modal-update')
        @include('livewire.admin.prison-unit.includes.modal-delete')

        {{-- paginação --}}
        <div class="pl-2 py-4 mt-4 text-zinc-50 dark:text-zinc-400 border-t border-blue-300 dark:border-blue-500 pb-3">
            {{ $prisonUnits->onEachSide(1)->links() }}
        </div>
    </div>
</div>