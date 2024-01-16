<!-- update-->
<x-dialog-modal wire:model="openModalLawyerUpdate" maxWidth="6xl">
    <x-slot name="title">
        {{ 'Atualizar os Dados do Advogado' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.admin.legal-assistance.lawyers.includes.update-field')
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="lawyerUpdate({{ $openModalLawyerUpdate }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
