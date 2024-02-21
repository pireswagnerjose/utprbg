<!-- update-->
<x-dialog-modal wire:model="openModalUpdate" maxWidth="xl">
    <x-slot name="title">
        {{ 'Atualizar os Dados da Prisão' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.main.photo.includes.fields-update')
    </x-slot>

    <x-slot name="footer">
        <x-danger-button wire:click="$set('openModalUpdate', false)" >
            {{ __('Cancel') }}
        </x-danger-button>

        <x-blue-button class="ms-3" wire:click="photoUpdate({{ $openModalUpdate }})" >
            {{ __('Save') }}
        </x-blue-button>
    </x-slot>
</x-dialog-modal>
