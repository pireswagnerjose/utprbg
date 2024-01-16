
<!-- Delete User Confirmation Modal -->
<x-dialog-modal wire:model="openModalPadDelete">
    <x-slot name="title">
        {{ "Excluir Pad" }}
    </x-slot>

    <x-slot name="content">
        {{ __('Você tem certeza!!!') }}
        
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="padDelete({{ $openModalPadDelete }})" wire:loading.attr="disabled">
            {{ 'Excluir' }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>