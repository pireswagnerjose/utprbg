<div class="grid grid-cols-2 gap-4 mt-6">
    <div class="relative z-0 w-full group">
        <x-input type="text" id="civilStatus" wire:model="civilStatus" />
        <x-label for="civilStatus" wire:model="civilStatus" value="{{ 'Estado Civil' }}" />
        <x-input-error for="civil_status" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>