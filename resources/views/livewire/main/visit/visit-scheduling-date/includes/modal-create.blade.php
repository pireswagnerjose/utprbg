<!-- update-->
<x-dialog-modal wire:model="openModalCreate">
    <x-slot name="title">
        {{ 'Cadastrar Nova Data para Agendamento' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.main.visit.visit-scheduling-date.includes.fields')
    </x-slot>

    <x-slot name="footer">
        <x-danger-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-danger-button>

        <x-blue-button class="ms-3" wire:click="create" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-blue-button>
    </x-slot>
</x-dialog-modal>
