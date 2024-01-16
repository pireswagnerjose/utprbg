<!-- update-->
<x-dialog-modal wire:model="confirmingCountryUpdate">
    <x-slot name="title">
        {{ 'Atualizar País' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.admin.country.includes.update-field')
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="clearFields('confirmingCountryUpdate', false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="updateCountry({{ $confirmingCountryUpdate }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
