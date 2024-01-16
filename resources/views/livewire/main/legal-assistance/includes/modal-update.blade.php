<!-- update-->
<x-dialog-modal wire:model="openModalLegalAssistanceUpdate" maxWidth="6xl">
    <x-slot name="title">
        {{ 'Atualizar Atendimento Jurídico' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.main.legal-assistance.includes.fields')
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="legalAssistanceUpdate({{ $openModalLegalAssistanceUpdate }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
