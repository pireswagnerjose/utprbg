<!-- update-->
<x-dialog-modal wire:model="confirmingCivilStatusUpdate">
    <x-slot name="title">
        {{ 'Atualizar Estado Civil' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.admin.civil-status.includes.update-field')
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="clearFields('confirmingCivilStatusUpdate', false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="updateCivilStatus({{ $confirmingCivilStatusUpdate }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
