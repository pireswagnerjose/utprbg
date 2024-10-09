<!-- update-->
<x-dialog-modal wire:model="openModalVisitantEdit" maxWidth="6xl">
    <x-slot name="title">
        {{ 'Atualizar os Dados do Visitante' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.main.visitant.includes.fields_update')
    </x-slot>

    <x-slot name="footer">
        <x-danger-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-danger-button>

        <x-blue-button class="ms-3" wire:click="visitantUpdate({{ $openModalVisitantEdit }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-blue-button>
    </x-slot>
</x-dialog-modal>
