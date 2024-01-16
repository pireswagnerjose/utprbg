<div class="container content py-6 mx-auto w-3/4">
    <div class="mx-auto">
        <form wire:submit="create">

            @include('livewire.admin.process.penal-type.includes.field')
            
            <div class="flex justify-end">
                <x-button> {{ 'Adicionar' }} </x-button>
                <x-danger-button class="ms-3" wire:click.prevent="cancel">{{ 'Cancelar' }}</x-danger-button>
            </div>
            @if (session('success'))
                <span class="text-green-500 text-sm">{{ session('success') }}</span>
            @endif
        </form>
    </div>
</div>