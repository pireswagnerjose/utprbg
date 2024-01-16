<div class="grid grid-cols-2 gap-4 mt-6">
    <div class="relative z-0 w-full group">
        <x-input type="text" id="requesting" wire:model="requesting" />
        <x-label for="requesting" wire:model="requesting" value="{{ 'Requisitante' }}" />
        <x-input-error for="requesting" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>