<div class="container content py-6 mx-auto">
    <div class="mx-auto">
        <form wire:submit="create">

            @include('livewire.main.process.includes.penal-type-card')
            
            <div class="flex justify-end mt-6">
                <x-danger-button class="ms-3" wire:click.prevent="cancel">{{ 'Cancelar' }}</x-danger-button>
            </div>
            @if (session('success'))
                <span class="text-green-500 text-sm">{{ session('success') }}</span>
            @endif
        </form>
    </div>
</div>