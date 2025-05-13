<!-- update-->
<x-dialog-modal wire:model="openModalVisitUpdate" maxWidth="6xl">
    <x-slot name="title">
        {{ 'Atualizar os Dados da Visita' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.main.visitant.includes.visit-fields')
    </x-slot>

    <x-slot name="footer">
        <x-danger-button wire:click="closeModalVisitUpdate" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-danger-button>

        <x-blue-button class="ms-3" wire:click="updateVisit({{ $openModalVisitUpdate }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-blue-button>
    </x-slot>
</x-dialog-modal>
