
<!-- Delete User Confirmation Modal -->
<x-dialog-modal wire:model.live="confirmingUserDeletion">
    <x-slot name="title">
        {{ __('Delete Account') }}
    </x-slot>

    <x-slot name="content">
        {{ __('Você tem certeza que deseja excluir esse item!!!.') }}
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$set('confirmingUserDeletion', false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="deleteUser({{ $confirmingUserDeletion }})" wire:loading.attr="disabled">
            {{ __('Delete Account') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>