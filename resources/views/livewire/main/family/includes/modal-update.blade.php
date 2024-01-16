<!-- update-->
<x-dialog-modal wire:model="openModalFamilyUpdate" maxWidth="6xl">
    <x-slot name="title">
        {{ 'Atualizar Familiar' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.main.family.includes.fields')
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="familyUpdate({{ $openModalFamilyUpdate }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
