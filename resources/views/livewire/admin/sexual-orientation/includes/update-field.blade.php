<div class="grid grid-cols-2 gap-4 mt-6">
    <div class="relative z-0 w-full group">
        <x-input type="text" id="sexualOrientation" wire:model="sexualOrientation" />
        <x-label for="sexualOrientation" wire:model="sexualOrientation" value="{{ 'Orientação Sexual' }}" />
        <x-input-error for="sexual_orientation" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>