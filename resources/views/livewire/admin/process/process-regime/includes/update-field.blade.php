<div class="grid grid-cols-2 gap-4 mt-6">
    <div class="relative z-0 w-full group">
        <x-input type="text" id="processRegime" wire:model="processRegime" />
        <x-label for="processRegime" wire:model="processRegime" value="{{ 'Regime do Processo' }}" />
        <x-input-error for="process_regime" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>