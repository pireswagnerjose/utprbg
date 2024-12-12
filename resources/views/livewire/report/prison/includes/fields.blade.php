<!-- Tipo da Pesquisa -->
<div class="w-[50%] m-auto mb-12">
   <select wire:model.live.debounce.500ms="type_search"
      class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
      <option class="text-zinc-900 dark:text-zinc-600" selected value="">PESQUISA POR ENTRADAS OU SAÍDAS</option>
      <option class="text-zinc-900 dark:text-zinc-600" value="entry">ENTRADAS</option>
      <option class="text-zinc-900 dark:text-zinc-600" value="exit">SAIDAS</option>
   </select>
</div>
<!-- end Tipo da Pesquisa -->

<!-- Entradas -->
@if ($type_search == 'entry')
   <div class="grid md:grid-cols-4 gap-6 mt-6 w-[90%] mx-auto">
      <div class="col-span-1 w-full">
         <x-input type="date" wire:model.live.debounce.500ms="start_date" />
         <x-label for="data_inicial" value="{{ 'DATA INICIAL' }}" />
      </div>
      <div class="col-span-1 w-full">
         <x-input type="date" wire:model.live.debounce.500ms="end_date" />
         <x-label for="data_final" value="{{ 'DATA FINAL' }}" />
      </div>
      <div class="col-span-2 w-full">
         <select wire:model.live.debounce.500ms="prison_origin_id"
            class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="">TIPO DA ENTRADA</option>
            @if(!empty($prison_origins))
               @foreach ($prison_origins as $prison_origin)
                  <option class="text-zinc-900 dark:text-zinc-600" value="{{ $prison_origin->id }}">
                     {{ $prison_origin->prison_origin }}
                  </option>
               @endforeach
            @endif
         </select>
      </div>
   </div>
@endif
<!-- end Entradas -->

<!-- Saídas -->
@if ($type_search == 'exit')
   <div class="grid md:grid-cols-4 gap-6 mt-6 w-[90%] mx-auto">
      <div class="col-span-1 w-full">
         <x-input type="date" wire:model.live.debounce.500ms="start_date" />
         <x-label for="data_inicial" value="{{ 'DATA INICIAL' }}" />
      </div>
      <div class="col-span-1 w-full">
         <x-input type="date" wire:model.live.debounce.500ms="end_date" />
         <x-label for="data_final" value="{{ 'DATA FINAL' }}" />
      </div>
      <div class="col-span-2 w-full">
         <select wire:model.live.debounce.500ms="output_type_id"
            class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value="">TIPO DA SAÍDA</option>
            @if(!empty($output_types))
               @foreach ($output_types as $output_type)
                  <option class="text-zinc-900 dark:text-zinc-600" value="{{ $output_type->id }}">
                     {{ $output_type->output_type }}
                  </option>
               @endforeach
            @endif
         </select>
      </div>
   </div>
@endif
<!-- end Saídas -->