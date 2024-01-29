<!-- update-->
<x-dialog-modal wire:model="openModalPrisonDocumentEdit" maxWidth="xl">
    <x-slot name="title">
        {{ 'Atualizar os Dados do Documento' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.main.prison.includes.document-fields')
    </x-slot>

    <x-slot name="footer">
        <x-danger-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-danger-button>

        <x-blue-button class="ms-3" wire:click="documentUpdate({{ $openModalPrisonDocumentEdit }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-blue-button>
    </x-slot>
</x-dialog-modal>
