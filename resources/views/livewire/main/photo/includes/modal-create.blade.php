<!-- update-->
<x-dialog-modal wire:model="openModalPhotoCreate" maxWidth="xl">
    <x-slot name="title">
        {{ 'Cadastrar Foto' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.main.photo.includes.fields')
    </x-slot>

    <x-slot name="footer">
        <x-danger-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-danger-button>

        <x-blue-button class="ms-3" wire:click="photoCreate" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-blue-button>
    </x-slot>
</x-dialog-modal>
