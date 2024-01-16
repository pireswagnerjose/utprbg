<!-- update-->
<x-dialog-modal wire:model="confirmingProcessRegimeUpdate">
    <x-slot name="title">
        {{ 'Atualizar Regime do Processo' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.admin.process.process-regime.includes.update-field')
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="clearFields('confirmingProcessRegimeUpdate', false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="updateProcessRegime({{ $confirmingProcessRegimeUpdate }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
