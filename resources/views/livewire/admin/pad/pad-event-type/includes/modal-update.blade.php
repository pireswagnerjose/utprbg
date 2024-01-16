<!-- update-->
<x-dialog-modal wire:model="openModalPadEventTypeUpdate">
    <x-slot name="title">
        {{ 'Atualizar Tipo de Evento' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.admin.pad.pad-event-type.includes.update-field')
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="padEventTypeUpdate({{ $openModalPadEventTypeUpdate }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
