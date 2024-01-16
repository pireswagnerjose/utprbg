<!-- update-->
<x-dialog-modal wire:model="openModalInternalServiceUpdate" maxWidth="6xl">
    <x-slot name="title">
        {{ 'Atualizar Atendimento Interno' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.main.internal-service.includes.fields')
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="internalServiceUpdate({{ $openModalInternalServiceUpdate }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
