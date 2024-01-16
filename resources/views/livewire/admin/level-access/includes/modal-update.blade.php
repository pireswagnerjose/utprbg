<!-- update-->
<x-dialog-modal wire:model="confirmingLevelAccessUpdate">
    <x-slot name="title">
        {{ 'Atualizar nível de acesso' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.admin.level-access.includes.update-field')
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$toggle('confirmingLevelAccessUpdate', false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="updateLevelAccess({{ $confirmingLevelAccessUpdate }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
