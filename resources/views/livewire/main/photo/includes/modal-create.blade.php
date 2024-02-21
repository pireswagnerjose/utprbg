<x-dialog-modal wire:model="openModalCreate" maxWidth="xl">
    <x-slot name="title">
        {{ 'Cadastrar Foto' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.main.photo.includes.fields')
    </x-slot>

    <x-slot name="footer">
        <x-danger-button wire:click="$set('openModalCreate', false)" >
            {{ __('Cancel') }}
        </x-danger-button>

        <x-blue-button class="ms-3" wire:click="photoCreate">
            {{ __('Save') }}
        </x-blue-button>
    </x-slot>
</x-dialog-modal>
