<!-- update-->
<x-dialog-modal wire:model="openModalPadDocumentCreate" maxWidth="xl">
    <x-slot name="title">
        {{ 'Adicionar Documento referente ao Pad' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.main.pad.includes.document-fields')
    </x-slot>

    <x-slot name="footer">
        <x-danger-button wire:click="clearFields" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-danger-button>

        <x-blue-button class="ms-3" wire:click="padDocumentCreate" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-blue-button>
    </x-slot>
</x-dialog-modal>
