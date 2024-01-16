<!-- update-->
<x-dialog-modal wire:model="confirmingPrisonOriginUpdate">
    <x-slot name="title">
        {{ 'Atualizar Origem da Prisão' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.admin.prison.prison-origin.includes.update-field')
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="clearFields('confirmingPrisonOriginUpdate', false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="updatePrisonOrigin({{ $confirmingPrisonOriginUpdate }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
