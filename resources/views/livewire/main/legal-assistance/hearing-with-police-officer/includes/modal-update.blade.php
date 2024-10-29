<!-- update-->
<x-dialog-modal wire:model="openModalUpdate">
    <x-slot name="title">
        {{ 'Atualizar o Atendimento com o Delegado' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.main.legal-assistance.hearing-with-police-officer.includes.fields')
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="closeModal">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="update({{ $openModalUpdate }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
