<!-- update-->
<x-dialog-modal wire:model="openModalPadDocumentUpdate" maxWidth="xl">
    <x-slot name="title">
        {{ 'Atualizar os Dados do Documento' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.main.pad.includes.document-fields')
    </x-slot>

    <x-slot name="footer">
        <x-danger-button wire:click="clearFields" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-danger-button>

        <x-blue-button class="ms-3" wire:click="padDocumentUpdate({{ $openModalPadDocumentUpdate }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-blue-button>
    </x-slot>
</x-dialog-modal>
