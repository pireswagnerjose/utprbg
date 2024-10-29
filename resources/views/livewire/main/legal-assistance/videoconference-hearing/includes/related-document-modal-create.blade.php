<!-- update-->
<x-dialog-modal wire:model="openModalRelatedDocumentCreate">
    <x-slot name="title">
        {{ 'Cadastrar documento da Audiência por Videoconferência' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.main.legal-assistance.videoconference-hearing.includes.related-document-fields')
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="closeModal">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="createRelatedDocumment()" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
