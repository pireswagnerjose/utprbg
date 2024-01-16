<!-- update-->
<x-dialog-modal wire:model="confirmingPrisonUnitUpdate">
    <x-slot name="title">
        {{ 'Atualizar Unidade Prisional' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.admin.prison-unit.includes.update-field')
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$toggle('confirmingPrisonUnitUpdate', false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="updatePrisonUnit({{ $confirmingPrisonUnitUpdate }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
