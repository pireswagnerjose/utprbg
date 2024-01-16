<x-dialog-modal wire:model="openModalProcessDocument" maxWidth="xl">
    <x-slot name="title">
        {{ 'Adicionar Documento referente ao Processo' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.main.process.includes.document-fields')
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="processDocumentCreate" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
