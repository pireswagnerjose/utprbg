<!-- update-->
<x-dialog-modal wire:model="openModalFamilyCreate" maxWidth="6xl">
    <x-slot name="title">
        {{ 'Cadastrar Familiar' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.main.family.includes.fields')
    </x-slot>

    <x-slot name="footer">
        <x-danger-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-danger-button>

        <x-blue-button class="ms-3" wire:click="familyCreate" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-blue-button>
    </x-slot>
</x-dialog-modal>
