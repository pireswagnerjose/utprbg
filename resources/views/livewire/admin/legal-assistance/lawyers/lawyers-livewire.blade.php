<div>
    <div class="mx-auto pb-12 p-6 sm:px-6 lg:px-8 bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg text-zinc-900 dark:text-zinc-100">

        <div class="flex mb-2">
            <h2 class="font-semibold text-lg text-zinc-800 dark:text-zinc-400 mb-5">Advogado</h2>
        </div>

        @if (session('success'))
            <span class="text-green-500 text-sm">{{ session('success') }}</span>
        @endif

        {{-- Botão Adicionar Novo --}}
        <div class="flex items-center mb-6 ml-16 mt-4">
            <button wire:click="addNew" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="w-5 h-5 text-zinc-200 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                </svg>
            </button>
            <span class="text-sm">Adicionar Novo</span>
        </div>

        {{-- create --}}
        @if($add_new == true)
            <form wire:submit="create">
                @include('livewire.admin.legal-assistance.lawyers.includes.fields')
                <div class="flex justify-end mt-6">
                    <x-button> {{ 'Adicionar' }} </x-button>
                    <x-danger-button class="ms-3" wire:click.prevent="closeModal">{{ 'Cancelar' }}</x-danger-button>
                </div>
            </form>
        @endif

        {{-- search --}}
        @include('livewire.admin.legal-assistance.lawyers.includes.search')

        {{-- card --}}
        @foreach ($lawyers as $lawyer)
            @include('livewire.admin.legal-assistance.lawyers.includes.card')
        @endforeach
        @include('livewire.admin.legal-assistance.lawyers.includes.modal-update')
        @include('livewire.admin.legal-assistance.lawyers.includes.modal-delete')

        {{-- paginação --}}
        <div class="pl-2 py-4 mt-4 text-zinc-50 dark:text-zinc-400 border-t border-blue-300 dark:border-blue-500 pb-3">
            {{ $lawyers->onEachSide(1)->links() }}
        </div>
    </div>
</div>