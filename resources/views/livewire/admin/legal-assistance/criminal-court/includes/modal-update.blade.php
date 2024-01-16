<!-- update-->
<x-dialog-modal wire:model="openModalCriminalCourtUpdate">
    <x-slot name="title">
        {{ 'Atualizar Vara Criminal' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.admin.legal-assistance.criminal-court.includes.update-field')
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="criminalCourtUpdate({{ $openModalCriminalCourtUpdate }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
