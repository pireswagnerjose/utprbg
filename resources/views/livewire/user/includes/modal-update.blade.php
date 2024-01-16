<!-- update-->
<x-dialog-modal wire:model="confirmingUserUpdate">
    <x-slot name="title">
        {{ __('Update User') }}
    </x-slot>

    <x-slot name="content">
        @include('livewire.user.includes.update-field')
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$toggle('confirmingUserUpdate', false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="updateUser({{ $confirmingUserUpdate }})" wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>
