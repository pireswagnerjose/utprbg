
<!-- Delete User Confirmation Modal -->
<x-dialog-modal wire:model="openModalDocumentDelete">
    <x-slot name="title">
        {{ "Excluir Documento" }}
    </x-slot>

    <x-slot name="content">
        {{ __('Você tem certeza!!!') }}
        
    </x-slot>

    <x-slot name="footer">
        <x-blue-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-blue-button>

        <x-danger-button class="ms-3" wire:click="documentDelete({{ $openModalDocumentDelete }})" wire:loading.attr="disabled">
            {{ 'Excluir' }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>