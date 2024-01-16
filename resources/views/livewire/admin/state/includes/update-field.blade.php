<div class="grid grid-cols-2 gap-4 mt-6">
    <div class="relative z-0 w-full group">
        <x-input type="text" id="state" wire:model="state" />
        <x-label for="state" wire:model="state" value="{{ 'Estado' }}" />
        <x-input-error for="state" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>