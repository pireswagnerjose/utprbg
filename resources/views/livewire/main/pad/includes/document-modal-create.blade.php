<!-- update-->
<x-dialog-modal wire:model="openModalPadDocumentCreate" maxWidth="xl">
    <x-slot name="title">
        {{ 'Adicionar Documento referente ao Pad' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.main.pad.includes.document-fields')
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="clearFields" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="padDocumentCreate" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
