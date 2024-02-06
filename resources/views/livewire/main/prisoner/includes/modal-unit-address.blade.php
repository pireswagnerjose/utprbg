<!-- update-->
<x-dialog-modal wire:model="openModalUnitAddress" maxWidth="2xl">
    <x-slot name="title">
        {{ 'Atualizar os Dados do Preso' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.main.prisoner.includes.field-unit-address')
    </x-slot>

    <x-slot name="footer">
        <x-danger-button wire:click="clearFields('openModalUnitAddress', false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-danger-button>

        <x-blue-button class="ms-3" wire:click="unitAddress({{ $openModalUnitAddress }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-blue-button>
    </x-slot>
</x-dialog-modal>
