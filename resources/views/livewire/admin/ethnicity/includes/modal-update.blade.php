<!-- update-->
<x-dialog-modal wire:model="confirmingEthnicityUpdate">
    <x-slot name="title">
        {{ 'Atualizar Etnia' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.admin.ethnicity.includes.update-field')
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="clearFields('confirmingEthnicityUpdate', false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="updateEthnicity({{ $confirmingEthnicityUpdate }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
