{{-- Linha 1 --}}
<div class="grid grid-cols-3 gap-6 w-[80%] mx-auto mt-8">
   <div class="relative z-0 w-full group">
       <x-input type="date" wire:model.live.debounce.500ms="start_date" />
       <x-label for="data_inicial" value="{{ 'DATA INICIAL' }}" />
   </div>

   <div class="relative z-0 w-full group">
       <x-input type="date" wire:model.live.debounce.500ms="end_date" />
       <x-label for="data_final" value="{{ 'DATA FINAL' }}" />
   </div>

   <div class="relative z-0 w-full group">
      <select wire:model.live.debounce.500ms="status" class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
         <option class="text-zinc-900 dark:text-zinc-600" selected value="">STATUS</option>
         <option class="text-zinc-900 dark:text-zinc-600" value="MANTIDO">MANTIDO</option>
         <option class="text-zinc-900 dark:text-zinc-600" value="CANCELADO">CANCELADO</option>
      </select>
   </div>
</div>