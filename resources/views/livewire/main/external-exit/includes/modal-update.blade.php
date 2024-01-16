<!-- update-->
<x-dialog-modal wire:model="openModalExternalExitUpdate" maxWidth="6xl">
    <x-slot name="title">
        {{ 'Atualizar Saída Externa' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.main.external-exit.includes.fields')
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="externalExitUpdate({{ $openModalExternalExitUpdate }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
