<!-- update-->
<x-dialog-modal wire:model="openModalUpdate" maxWidth="6xl">
    <x-slot name="title">
        {{ 'Atualizar os Dados do Advogado' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.admin.legal-assistance.lawyers.includes.fields')
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="update({{ $openModalUpdate }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
