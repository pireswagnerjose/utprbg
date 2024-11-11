<!-- update-->
<x-dialog-modal wire:model="openModalUpdate">
    <x-slot name="title">
        {{ 'Atualizar Data da Visita' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.main.visit.visit-control.includes.fields')
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
