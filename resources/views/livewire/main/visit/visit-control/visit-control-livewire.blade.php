<div>
    <div class="w-full text-center">
        @if (session('success'))
            <span class="text-green-500 text-sm">{{ session('success') }}</span>
        @endif
        @if (session('error'))
            <span class="text-red-500 text-sm">{{ session('error') }}</span>
        @endif
    </div>
    {{-- add new --}}
    <div class="flex items-center border-b border-blue-400 dark:border-blue-600 mb-4">
        @can('admin-recepcao')
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

    <div class="mx-auto mt-6 p-6 sm:px-6 lg:px-8 bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg text-zinc-900 dark:text-zinc-100">
        
        @include('livewire.main.visit.visit-control.includes.search-card')
        {{-- MODAL --}}
        @include('livewire.main.visit.visit-control.includes.modal-create')
        @include('livewire.main.visit.visit-control.includes.modal-update')
        @include('livewire.main.visit.visit-control.includes.modal-delete')
    </div>

</div>