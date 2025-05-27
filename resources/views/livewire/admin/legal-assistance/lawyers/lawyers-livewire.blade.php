<div>
    <div
        class="mx-auto pb-12 p-6 sm:px-6 lg:px-8 bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg text-zinc-900 dark:text-zinc-100">

        @if (session('success'))
            <span class="text-green-500 text-sm">{{ session('success') }}</span>
        @endif

        {{-- Botão Adicionar Novo --}}
        <div class="flex items-center mb-6">
            <button wire:click="addNew" type="button"
                class="p-2.5 mb-4 bg-blue-600 dark:bg-blue-500/50 hover:opacity-50 transition duration-500 rounded-full">
                <x-lucide-plus class="w-4 h-4 text-zinc-100 dark:text-zinc-200"></x-lucide-plus>
            </button>
        </div>

        {{-- create --}}
        @if ($add_new == true)
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
