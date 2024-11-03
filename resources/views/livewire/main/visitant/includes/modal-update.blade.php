<!-- update-->
<x-dialog-modal wire:model="openModalUpdate" maxWidth="6xl">
    <x-slot name="title">
        {{ 'Atualizar os Dados do Visitante' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.main.visitant.includes.fields')
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
