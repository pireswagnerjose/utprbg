<div>
    <!-- Mensagens -->
    <div class="w-full text-center">
        @if (session('success'))
        <span class="text-green-500 text-sm">{{ session('success') }}</span>
        @endif
        @if (session('error'))
        <span class="text-red-500 text-sm">{{ session('error') }}</span>
        @endif
    </div>

    <!-- add new -->
    <div class="flex items-center border-b border-blue-400 dark:border-blue-600 mb-4">
        @can('create_visit_control')
        <div>
            <button wire:click="modalCreate" type="button"
                class="p-2.5 mb-4 bg-blue-600 dark:bg-blue-500/50 hover:opacity-50 transition duration-500 rounded-full">
                <x-lucide-plus class="w-4 h-4 text-zinc-100 dark:text-zinc-200"></x-lucide-plus>
            </button>
            <span class="text-sm ml-2">Adicionar Novo</span>
        </div>
        @endcan
    </div>

    <div
        class="mx-auto mt-6 p-6 sm:px-6 lg:px-8 bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg text-zinc-900 dark:text-zinc-100">

        @include('livewire.main.visit.visit-control.includes.search-card')
        {{-- MODAL --}}
        @include('livewire.main.visit.visit-control.includes.modal-create')
        @include('livewire.main.visit.visit-control.includes.modal-update')
        @include('livewire.main.visit.visit-control.includes.modal-delete')
    </div>

</div>