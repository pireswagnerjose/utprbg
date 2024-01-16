<div class="grid grid-cols-2 gap-4 mt-6">
    <div class="relative z-0 w-full group">
        <x-input type="text" id="ethnicity" wire:model="ethnicity" />
        <x-label for="ethnicity" wire:model="ethnicity" value="{{ 'Etnia' }}" />
        <x-input-error for="ethnicity" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>