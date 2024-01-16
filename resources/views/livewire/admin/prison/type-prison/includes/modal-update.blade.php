<!-- update-->
<x-dialog-modal wire:model="confirmingTypePrisonUpdate">
    <x-slot name="title">
        {{ 'Atualizar Tipo de Prisão' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.admin.prison.type-prison.includes.update-field')
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="clearFields('confirmingTypePrisonUpdate', false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="updateTypePrison({{ $confirmingTypePrisonUpdate }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
