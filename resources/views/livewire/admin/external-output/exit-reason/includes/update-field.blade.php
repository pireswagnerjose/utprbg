<div class="grid grid-cols-2 gap-4 mt-6">
    <div class="relative z-0 w-full group">
        <x-input type="text" id="exitReason" wire:model="exitReason" />
        <x-label for="exitReason" wire:model="exitReason" value="{{ 'Motivo da Saída' }}" />
        <x-input-error for="exit_reason" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>