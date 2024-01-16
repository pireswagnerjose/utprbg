<!-- update-->
<x-dialog-modal wire:model="confirmingStatusPrisonUpdate">
    <x-slot name="title">
        {{ 'Atualizar Status da Prisão' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.admin.prison.status-prison.includes.update-field')
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="clearFields('confirmingStatusPrisonUpdate', false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="updateStatusPrison({{ $confirmingStatusPrisonUpdate }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
