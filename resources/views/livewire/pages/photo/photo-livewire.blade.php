<div>
    {{-- Alert component --}}
    <div class="my-2">
        @include('livewire.pages.photo.includes.alerts')
    </div>
    {{-- add new --}}
    <div class="flex items-center border-b border-blue-400 dark:border-blue-600">
        @can('create_photo')
            <div>
                <button wire:click="modal" type="button"
                    class="p-2.5 mb-4 bg-blue-600 dark:bg-blue-500/50 hover:opacity-50 transition duration-500 rounded-full">
                    <x-lucide-plus class="w-4 h-4 text-zinc-100 dark:text-zinc-200"></x-lucide-plus>
                </button>
            </div>
        @endcan
    </div>
    @include('livewire.pages.photo.includes.card')
    <form wire:submit="save">
        @include('livewire.pages.photo.includes.modal')
    </form>
</div>
