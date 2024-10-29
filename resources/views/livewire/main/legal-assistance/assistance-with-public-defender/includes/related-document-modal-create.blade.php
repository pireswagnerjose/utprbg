<!-- update-->
<x-dialog-modal wire:model="openModalRelatedDocumentCreate">
    <x-slot name="title">
        {{ 'Cadastrar documento do Atendimento com Defensor Público' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.main.legal-assistance.assistance-with-public-defender.includes.related-document-fields')
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
