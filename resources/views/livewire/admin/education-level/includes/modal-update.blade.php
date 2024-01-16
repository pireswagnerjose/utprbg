<!-- update-->
<x-dialog-modal wire:model="confirmingEducationLevelUpdate">
    <x-slot name="title">
        {{ 'Atualizar Escolaridade' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.admin.education-level.includes.update-field')
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="clearFields('confirmingEducationLevelUpdate', false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="updateEducationLevel({{ $confirmingEducationLevelUpdate }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
