
<!-- Delete User Confirmation Modal -->
<x-dialog-modal wire:model="openModalPhotoDelete">
    <x-slot name="title">
        {{ "Excluir a Foto" }}
    </x-slot>

    <x-slot name="content">
        {{ __('Você tem certeza!!!.') }}
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:loading.attr="disabled">
            {{ 'Excluir' }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>