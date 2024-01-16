<div class="grid grid-cols-2 gap-4 mt-6">
    <div class="relative z-0 w-full group">
        <x-input type="text" id="pad_nature_of_event" wire:model="pad_nature_of_event" />
        <x-label for="pad_nature_of_event" wire:model="pad_nature_of_event" value="{{ 'Natureza da Ocorrência' }}" />
        <x-input-error for="pad_nature_of_event" class="mt-2">{{ $message ?? '' }}</x-input-error>
    </div>
</div>