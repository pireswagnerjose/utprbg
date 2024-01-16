<div class="grid grid-cols-2 gap-4 mt-6">
    <div class="relative z-0 w-full group">
        <x-input type="text" id="district" wire:model="district" />
        <x-label for="district" wire:model="district" value="{{ 'Comarca' }}" />
        <x-input-error for="district" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>