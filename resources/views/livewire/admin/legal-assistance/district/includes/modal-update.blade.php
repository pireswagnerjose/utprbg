<!-- update-->
<x-dialog-modal wire:model="openModalDistrictUpdate">
    <x-slot name="title">
        {{ 'Atualizar Comarca' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.admin.legal-assistance.district.includes.update-field')
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="districtUpdate({{ $openModalDistrictUpdate }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
