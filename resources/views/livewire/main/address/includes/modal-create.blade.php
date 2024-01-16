<!-- update-->
<x-dialog-modal wire:model="openModalAddressCreate" maxWidth="6xl">
    <x-slot name="title">
        {{ 'Cadastrar Endereço' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.main.address.includes.fields')
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="addressCreate" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
