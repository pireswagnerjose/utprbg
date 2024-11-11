{{-- Linha 1 --}}
<div class="grid grid-cols-2 gap-10 mt-6">
    <div class="relative z-0 w-full group">
        <x-input type="date" wire:model.live.debounce.500ms="start_date" />
        <x-label for="start_date" value="{{ 'DATA INICIAL' }}" />
    </div>
 
    <div class="relative z-0 w-full group">
        <x-input type="date" wire:model.live.debounce.500ms="end_date" />
        <x-label for="end_date" value="{{ 'DATA FINAL' }}" />
    </div>
</div>