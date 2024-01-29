<!-- update-->
<x-dialog-modal wire:model="openModalPrisonDocument" maxWidth="xl">
    <x-slot name="title">
        {{ 'Adicionar Documento referente a Prisão' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.main.prison.includes.document-fields')
    </x-slot>

    <x-slot name="footer">
        <x-danger-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-danger-button>

        <x-blue-button class="ms-3" wire:click="prisonDocumentCreate({{ $prison_id }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-blue-button>
    </x-slot>
</x-dialog-modal>
