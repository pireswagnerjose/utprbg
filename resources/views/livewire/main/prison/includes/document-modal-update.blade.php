<!-- update-->
<x-dialog-modal wire:model="openmodalPrisonDocumentEdit" maxWidth="xl">
    <x-slot name="title">
        {{ 'Atualizar os Dados do Documento' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.main.prison.includes.document-fields')
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="clearFields" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="documentUpdate({{ $openmodalPrisonDocumentEdit }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
