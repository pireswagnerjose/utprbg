
<!-- Delete User Confirmation Modal -->
<x-dialog-modal wire:model.live="confirmingLevelAccessDeletion">
    <x-slot name="title">
        {{ 'Excluir Nível de Acesso' }}
    </x-slot>

    <x-slot name="content">
        {{ __('Você tem certeza que deseja excluir esse item!!!.') }}
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$toggle('confirmingLevelAccessDeletion', false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="deleteLevelAccess({{ $confirmingLevelAccessDeletion }})" wire:loading.attr="disabled">
            {{ __('Delete Account') }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>