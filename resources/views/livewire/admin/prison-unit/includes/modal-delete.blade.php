
<!-- Delete User Confirmation Modal -->
<x-dialog-modal wire:model.live="confirmingPrisonUnitDeletion">
    <x-slot name="title">
        {{ 'Excluir Unidade Prisional' }}
    </x-slot>

    <x-slot name="content">
        {{ __('Você tem certeza que deseja excluir esse item!!!.') }}
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$toggle('confirmingPrisonUnitDeletion', false)" wire:loading.attr="disabled">
            {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button class="ms-3" wire:click="deletePrisonUnit({{ $confirmingPrisonUnitDeletion }})" wire:loading.attr="disabled">
            {{ 'Excluir' }}
        </x-danger-button>
    </x-slot>
</x-dialog-modal>