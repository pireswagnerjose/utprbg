<!-- update-->
<x-dialog-modal wire:model="openModalUpdate">
    <x-slot name="title">
        {{ 'Atualizar as Datas da Marcação das Visitas' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.main.visit.visit-scheduling-date.includes.fields')
    </x-slot>

    <x-slot name="footer">
        <x-danger-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-danger-button>

        <x-blue-button class="ms-3" wire:click="update({{ $openModalUpdate }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-blue-button>
    </x-slot>
</x-dialog-modal>
