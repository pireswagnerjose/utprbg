<!-- update-->
<x-dialog-modal wire:model="openModalProfilePhoto" maxWidth="xl">
    <x-slot name="title">
        {{ 'Cadastrar foto do perfil' }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.main.prisoner.includes.field-profile-photo')
    </x-slot>

    <x-slot name="footer">
        <x-danger-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-danger-button>

        <x-blue-button class="ms-3" wire:click="profilePhoto({{ $openModalProfilePhoto }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-blue-button>
    </x-slot>
</x-dialog-modal>
