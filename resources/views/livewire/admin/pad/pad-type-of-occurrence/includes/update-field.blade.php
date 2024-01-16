<div class="grid grid-cols-2 gap-4 mt-6">
    <div class="relative z-0 w-full group">
        <x-input type="text" id="pad_type_of_occurrence" wire:model="pad_type_of_occurrence" />
        <x-label for="pad_type_of_occurrence" wire:model="pad_type_of_occurrence" value="{{ 'Tipo da Ocorrência' }}" />
        <x-input-error for="pad_type_of_occurrence" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>