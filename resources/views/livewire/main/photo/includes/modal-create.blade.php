<!-- update-->
<x-dialog-modal wire:model="openModalPhotoCreate" maxWidth="xl">
    <x-slot name="title">
        {{ 'Cadastrar Foto' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.main.photo.includes.fields')
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="photoCreate" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
