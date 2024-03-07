<div class="grid grid-cols-2 gap-4 mt-6">
    <div class="relative z-0 w-full group">
        <x-input type="text" wire:model="ward" />
        <x-label for="ward" value="{{ 'Ala - Pavilhão' }}" />
        <x-input-error for="ward" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>