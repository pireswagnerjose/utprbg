<!-- update-->
<x-dialog-modal wire:model="confirmingMunicipalityUpdate">
    <x-slot name="title">
        {{ 'Atualizar Município' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.admin.municipality.includes.update-field')
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="clearFields('confirmingMunicipalityUpdate', false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="updateMunicipality({{ $confirmingMunicipalityUpdate }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
