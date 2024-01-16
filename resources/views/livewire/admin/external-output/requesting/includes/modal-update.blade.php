<!-- update-->
<x-dialog-modal wire:model="confirmingRequestingUpdate">
    <x-slot name="title">
        {{ 'Atualizar Requisitante' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.admin.external-output.requesting.includes.update-field')
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="clearFields('confirmingRequestingUpdate', false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="updateRequesting({{ $confirmingRequestingUpdate }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
