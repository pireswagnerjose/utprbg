<!-- update-->
<x-dialog-modal wire:model="openModalDocumentCreate" maxWidth="3xl">
    <x-slot name="title">
        {{ 'Cadastrar Documento' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.main.document.includes.fields')
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="documentCreate" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
