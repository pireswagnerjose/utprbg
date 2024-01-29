<!-- update-->
<x-dialog-modal wire:model="openModalPadUpdate" maxWidth="6xl">
    <x-slot name="title">
        {{ 'Atualizar Pad' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.main.pad.includes.fields')
    </x-slot>

    <x-slot name="footer">
        <x-danger-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-danger-button>

        <x-blue-button class="ms-3" wire:click="padUpdate({{ $openModalPadUpdate }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-blue-button>
    </x-slot>
</x-dialog-modal>
