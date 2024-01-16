<!-- update-->
<x-dialog-modal wire:model="openModalProfilePhoto" maxWidth="xl">
    <x-slot name="title">
        {{ 'Cadastrar foto do perfil' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.main.prisoner.includes.field-profile-photo')
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="profilePhoto({{ $openModalProfilePhoto }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
