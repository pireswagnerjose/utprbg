{{-- Linha 1 --}}
<div class="grid mt-6 w-[50%] mx-auto">
   <select wire:model.live.debounce.500ms="education_level_id"
      class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
      <option class="text-zinc-900 dark:text-zinc-600" selected value="">ESCOLARIDADE</option>
      @foreach ($education_levels as $education_level)
         <option class="text-zinc-900 dark:text-zinc-600" value="{{ $education_level->id }}">
            {{ $education_level->education_level }}
         </option>
      @endforeach
   </select>
</div>

<div class="md:flex md:gap-6 mt-6 w-[90%] md:w-[50%] mx-auto">
   <div class="w-full">
      <x-input type="date" wire:model.live.debounce.500ms="start_date" />
      <x-label for="start_date" value="{{ 'DATA INICIAL' }}" />
   </div>
   
   <div class="w-full">
      <x-input type="date" wire:model.live.debounce.500ms="end_date" />
      <x-label for="end_date" value="{{ 'DATA FINAL' }}" />
   </div>
</div>