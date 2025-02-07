<div>
    {{-- add new --}}
    <div class="flex items-center border-b border-blue-400 dark:border-blue-600">
        @can('create_prison')
        <div>
            <button wire:click="modalPrisonCreate({{ $prisoner_id }})" type="button"
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
    {{-- MODAL PRISON --}}
    @include('livewire.main.prison.includes.modal-create')
    @include('livewire.main.prison.includes.modal-update')
    @include('livewire.main.prison.includes.modal-delete')
    @include('livewire.main.prison.includes.show-card')

    {{-- MODAL PRISON DOCUMENT --}}
    @include("livewire.main.prison.includes.document-modal-create")
    @include("livewire.main.prison.includes.document-modal-update")
    @include("livewire.main.prison.includes.document-modal-delete")
</div>