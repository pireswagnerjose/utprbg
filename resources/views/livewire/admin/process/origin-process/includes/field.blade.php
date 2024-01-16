<div class="mt-6">
    <div class="relative z-0 w-full group">
        <x-input type="text" id="originProcess" wire:model="originProcess" />
        <x-label for="originProcess" wire:model="originProcess" value="{{ 'Origem do Processo' }}" />
        <x-input-error for="origin_process" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>