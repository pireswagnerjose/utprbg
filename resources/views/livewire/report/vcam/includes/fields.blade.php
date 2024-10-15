{{-- Linha 1 --}}
<div class="grid md:grid-cols-2 md:gap-6 mt-16 mb-6 w-1/2">
   <div class="col-span-1 relative z-0 w-full group">
       <x-input type="date" wire:model.live.debounce.500ms="start_date" required />
       <x-label for="start_date" name="start_date" value="{{ 'Data Inicial' }}" />
   </div>
   <div class="col-span-1 relative z-0 w-full group">
       <x-input type="date" wire:model.live.debounce.500ms="end_date" required />
       <x-label for="end_date" name="end_date" value="{{ 'Data Final' }}" />
   </div>
</div>