<!-- update-->
<x-dialog-modal wire:model="confirmingOriginProcessUpdate">
    <x-slot name="title">
        {{ 'Atualizar Origem do Processo' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.admin.process.origin-process.includes.field')
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="clearFields('confirmingOriginProcessUpdate', false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="updateOriginProcess({{ $confirmingOriginProcessUpdate }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
