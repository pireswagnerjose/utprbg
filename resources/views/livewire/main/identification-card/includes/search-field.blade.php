{{-- Linha 1 --}}
<div class="grid grid-cols-2 mt-6">
    <div class="relative z-0 w-full group px-6">
        <div class="col-span-1 relative z-0 w-full group">
            <x-input type="text" wire:model.live.debounce.500ms="identificationCardForm.visitant_name" />
            <x-label for="identificationCardForm.date_of_creation" value="{{ 'Nome do Visitante' }}" />
        </div>
    </div>

    <div class="relative z-0 w-full group px-6">
        <div class="col-span-1 relative z-0 w-full group">
            <x-input type="text" wire:model.live.debounce.500ms="identificationCardForm.prisoner_name" />
            <x-label for="identificationCardForm.date_of_creation" value="{{ 'Nome do Preso' }}" />
        </div>
    </div>
</div>
