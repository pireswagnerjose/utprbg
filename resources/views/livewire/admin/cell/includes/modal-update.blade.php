<!-- update-->
<x-dialog-modal wire:model="confirmingCellUpdate">
    <x-slot name="title">
        {{ 'Atualizar Cela' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.admin.cell.includes.update-field')
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="clearFields('confirmingCellUpdate', false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="updateCell({{ $confirmingCellUpdate }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
