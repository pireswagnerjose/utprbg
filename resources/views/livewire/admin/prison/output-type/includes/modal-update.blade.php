<!-- update-->
<x-dialog-modal wire:model="confirmingOutputTypeUpdate">
    <x-slot name="title">
        {{ 'Atualizar Tipo de Saída' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.admin.prison.output-type.includes.update-field')
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="clearFields('confirmingOutputTypeUpdate', false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="updateOutputType({{ $confirmingOutputTypeUpdate }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
