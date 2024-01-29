<!-- update-->
<x-dialog-modal wire:model="openModalDocumentCreate" maxWidth="3xl">
    <x-slot name="title">
        {{ 'Cadastrar Documento' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.main.document.includes.fields')
    </x-slot>

    <x-slot name="footer">
        <x-danger-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-danger-button>

        <x-blue-button class="ms-3" wire:click="documentCreate" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-blue-button>
    </x-slot>
</x-dialog-modal>
