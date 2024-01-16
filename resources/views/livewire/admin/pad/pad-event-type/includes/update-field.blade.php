<div class="grid grid-cols-2 gap-4 mt-6">
    <div class="relative z-0 w-full group">
        <x-input type="text" id="pad_event_type" wire:model="pad_event_type" />
        <x-label for="pad_event_type" wire:model="pad_event_type" value="{{ 'Tipo de Evento' }}" />
        <x-input-error for="pad_event_type" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>