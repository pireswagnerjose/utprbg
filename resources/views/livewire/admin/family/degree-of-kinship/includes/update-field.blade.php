<div class="grid grid-cols-2 gap-4 mt-6">
    <div class="relative z-0 w-full group">
        <x-input type="text" id="degree_of_kinship" wire:model="degree_of_kinship" />
        <x-label for="degree_of_kinship" wire:model="degree_of_kinship" value="{{ 'Grau de Parentesco' }}" />
        <x-input-error for="degree_of_kinship" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>