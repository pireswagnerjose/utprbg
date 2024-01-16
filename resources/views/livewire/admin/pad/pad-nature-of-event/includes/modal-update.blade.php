<!-- update-->
<x-dialog-modal wire:model="openModalPadNatureOfEventUpdate">
    <x-slot name="title">
        {{ 'Atualizar Natureza da Ocorrência' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.admin.pad.pad-nature-of-event.includes.update-field')
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="padNatureOfEventUpdate({{ $openModalPadNatureOfEventUpdate }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
