
<!-- Delete User Confirmation Modal -->
<x-dialog-modal wire:model="openModalDelete">
    <x-slot name="title">
        {{ "Excluir o Visitante:" }}
    </x-slot>

    <x-slot name="content">
        <h2 class="text-base text-red-700 dark:text-red-500">{{ $visitant->name }}</h2>
        {{ __('Você tem certeza!!!.') }}
        
    </x-slot>

    <x-slot name="footer">
        <x-blue-button wire:click="closeModal" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-blue-button>

        <x-danger-button class="ms-3" wire:click="delete({{ $openModalDelete }})" wire:loading.attr="disabled">
            {{ 'Excluir' }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>