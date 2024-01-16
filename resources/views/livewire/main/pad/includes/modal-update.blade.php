<!-- update-->
<x-dialog-modal wire:model="openModalPadUpdate" maxWidth="6xl">
    <x-slot name="title">
        {{ 'Atualizar Pad' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.main.pad.includes.fields')
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="padUpdate({{ $openModalPadUpdate }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
