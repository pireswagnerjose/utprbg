<!-- update-->
<x-dialog-modal wire:model="openModalCreate">
    <x-slot name="title">
        {{ 'Cadastrar Atendimento com a Justiça Restaurativa' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.main.legal-assistance.restorative-justice.includes.fields')
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="closeModal">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="create()" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
