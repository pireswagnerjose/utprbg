
<!-- Delete User Confirmation Modal -->
<x-dialog-modal wire:model.live="openModalPadTypeOfOccurrenceDelete">
    <x-slot name="title">
        {{ 'Excluir Tipo da Ocorrência' }}
    </x-slot>

    <x-slot name="content">
        {{ __('Você tem certeza que deseja excluir esse item!!!.') }}
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="padTypeOfOccurrenceDelete({{ $openModalPadTypeOfOccurrenceDelete }})" wire:loading.attr="disabled">
            {{ 'Excluir' }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>