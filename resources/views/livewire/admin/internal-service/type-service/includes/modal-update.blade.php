<!-- update-->
<x-dialog-modal wire:model="confirmingTypeServiceUpdate">
    <x-slot name="title">
        {{ 'Atualizar Estado' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.admin.internal-service.type-service.includes.update-field')
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="clearFields('confirmingTypeServiceUpdate', false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="updateTypeService({{ $confirmingTypeServiceUpdate }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
