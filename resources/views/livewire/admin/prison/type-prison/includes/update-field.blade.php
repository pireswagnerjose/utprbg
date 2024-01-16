<div class="grid grid-cols-2 gap-4 mt-6">
    <div class="relative z-0 w-full group">
        <x-input type="text" id="typePrison" wire:model="typePrison" />
        <x-label for="typePrison" wire:model="typePrison" value="{{ 'Tipo de Prisão' }}" />
        <x-input-error for="type_prison" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>