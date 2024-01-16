<div class="grid grid-cols-2 gap-4 mt-6">
    <div class="relative z-0 w-full group">
        <x-input type="text" id="statusPrison" wire:model="statusPrison" />
        <x-label for="statusPrison" wire:model="statusPrison" value="{{ 'Status da Prisão' }}" />
        <x-input-error for="status_prison" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>