<div class="grid grid-cols-2 gap-4 mt-6">
    <div class="relative z-0 w-full group">
        <x-input type="text" id="country" wire:model="country" />
        <x-label for="country" wire:model="country" value="{{ 'País' }}" />
        <x-input-error for="country" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>