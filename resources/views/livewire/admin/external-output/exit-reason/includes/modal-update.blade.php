<!-- update-->
<x-dialog-modal wire:model="confirmingExitReasonUpdate">
    <x-slot name="title">
        {{ 'Atualizar Motivo da Saída' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.admin.external-output.exit-reason.includes.update-field')
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="clearFields('confirmingExitReasonUpdate', false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="updateExitReason({{ $confirmingExitReasonUpdate }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
