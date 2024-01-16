<div class="grid grid-cols-2 gap-4 mt-6">
    <div class="relative z-0 w-full group">
        <x-input type="text" id="pad_status" wire:model="pad_status" />
        <x-label for="pad_status" wire:model="pad_status" value="{{ 'Status da Ocorrência' }}" />
        <x-input-error for="pad_status" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>