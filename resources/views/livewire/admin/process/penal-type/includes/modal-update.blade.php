<!-- update-->
<x-dialog-modal wire:model="confirmingPenalTypeUpdate">
    <x-slot name="title">
        {{ 'Atualizar Tipo Penal' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.admin.process.penal-type.includes.field')
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="clearFields('confirmingPenalTypeUpdate', false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="updatePenalType({{ $confirmingPenalTypeUpdate }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
