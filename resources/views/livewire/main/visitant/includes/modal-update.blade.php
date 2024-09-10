<!-- update-->
<x-dialog-modal wire:model="openModalPrisonerUpdate" maxWidth="6xl">
    <x-slot name="title">
        {{ 'Atualizar os Dados do Preso' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.main.prisoner.prisoner-update-livewire')
    </x-slot>

    <x-slot name="footer">
        <x-danger-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-danger-button>

        <x-blue-button class="ms-3" wire:click="prisonerUpdate({{ $openModalPrisonerUpdate }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-blue-button>
    </x-slot>
</x-dialog-modal>
