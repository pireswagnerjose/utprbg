<!-- update-->
<x-dialog-modal wire:model="openModalExternalExitCreate" maxWidth="6xl">
    <x-slot name="title">
        {{ 'Cadastrar Saída Externa' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.main.external-exit.includes.fields')
    </x-slot>

    <x-slot name="footer">
        <x-danger-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-danger-button>

        <x-blue-button class="ms-3" wire:click="externalExitCreate" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-blue-button>
    </x-slot>
</x-dialog-modal>
