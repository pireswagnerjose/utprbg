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

    {{-- add new --}}
    @can('create_internal_service')
        <div class="flex items-center border-b border-blue-400 dark:border-blue-600">
            <div>
                <button wire:click="modalInternalServiceCreate" type="button"
                    class="p-2.5 mb-4 bg-blue-600 dark:bg-blue-500/50 hover:opacity-50 transition duration-500 rounded-full">
                    <x-lucide-plus class="w-4 h-4 text-zinc-100 dark:text-zinc-200"></x-lucide-plus>
                </button>
            </div>
        </div>
    @endcan

    @include('livewire.main.internal-service.includes.modal-create')
    @include('livewire.main.internal-service.includes.modal-update')
    @include('livewire.main.internal-service.includes.modal-delete')
    @include('livewire.main.internal-service.includes.show-card')
</div>
