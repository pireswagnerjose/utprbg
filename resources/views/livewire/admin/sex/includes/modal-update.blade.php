<!-- update-->
<x-dialog-modal wire:model="confirmingSexUpdate">
    <x-slot name="title">
        {{ 'Atualizar Sexo' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.admin.sex.includes.update-field')
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="clearFields('confirmingSexUpdate', false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="updateSex({{ $confirmingSexUpdate }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
