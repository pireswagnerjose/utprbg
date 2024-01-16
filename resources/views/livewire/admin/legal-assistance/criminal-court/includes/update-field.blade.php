<div class="grid grid-cols-2 gap-4 mt-6">
    <div class="relative z-0 w-full group">
        <x-input type="text" id="criminal_court" wire:model="criminal_court" />
        <x-label for="criminal_court" wire:model="criminal_court" value="{{ 'Vara Criminal' }}" />
        <x-input-error for="criminal_court" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>