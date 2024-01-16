<div class="grid grid-cols-2 gap-4 mt-6">
    <div class="relative z-0 w-full group">
        <x-input type="text" id="pad_local" wire:model="pad_local" />
        <x-label for="pad_local" wire:model="pad_local" value="{{ 'Local da Ocorrência' }}" />
        <x-input-error for="pad_local" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>