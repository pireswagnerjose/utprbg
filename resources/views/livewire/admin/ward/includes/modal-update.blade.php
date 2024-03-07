<!-- update-->
<x-dialog-modal wire:model="confirmingWardUpdate">
    <x-slot name="title">
        {{ 'Atualizar Ala - Pavilhão' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.admin.ward.includes.update-field')
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="clearFields('confirmingWardUpdate', false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="updateWard({{ $confirmingWardUpdate }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
