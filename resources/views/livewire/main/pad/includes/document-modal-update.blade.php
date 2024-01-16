<!-- update-->
<x-dialog-modal wire:model="openModalPadDocumentUpdate" maxWidth="xl">
    <x-slot name="title">
        {{ 'Atualizar os Dados do Documento' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.main.pad.includes.document-fields')
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="clearFields" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="padDocumentUpdate({{ $openModalPadDocumentUpdate }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
