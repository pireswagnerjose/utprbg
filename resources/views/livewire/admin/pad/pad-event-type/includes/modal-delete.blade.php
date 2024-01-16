
<!-- Delete User Confirmation Modal -->
<x-dialog-modal wire:model.live="openModalPadEventTypeDelete">
    <x-slot name="title">
        {{ 'Excluir Tipo de Evento' }}
    </x-slot>

    <x-slot name="content">
        {{ __('Você tem certeza que deseja excluir esse item!!!.') }}
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="padEventTypeDelete({{ $openModalPadEventTypeDelete }})" wire:loading.attr="disabled">
            {{ 'Excluir' }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>