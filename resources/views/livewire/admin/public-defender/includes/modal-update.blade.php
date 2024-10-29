<!-- update-->
<x-dialog-modal wire:model="openModalPublicDefenderUpdate">
    <x-slot name="title">
        {{ 'Atualizar Defensor Público' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.admin.public-defender.includes.update-field')
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="clearFields">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="update({{ $openModalPublicDefenderUpdate }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
