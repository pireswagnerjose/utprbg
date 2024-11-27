{{-- Linha 1 --}}
<div class="grid md:grid-cols-3 gap-6 mt-6 w-[90%] mx-auto">
   <div class="md:relative z-0 w-full group">
      <select wire:model.live.debounce.500ms="status_prison_id" wire:change='selectOperator'
          class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
          <option class="text-zinc-900 dark:text-zinc-600" selected value="{{ $status_prison->id ?? '' }}">{{
              $status_prison->id ?? 'Status da Prisão' }}</option>
          @isset($status_prisons)
              @foreach ($status_prisons as $status_prison)
                  <option class="text-zinc-900 dark:text-zinc-600" value="{{ $status_prison->id}}">{{ $status_prison->status_prison }}</option>
              @endforeach
          @endisset
      </select>
  </div>

   <div class="relative md:col-span-2 z-0 w-full group">
      <select wire:model.live.debounce.500ms="type_prison_id"
         class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
         <option class="text-zinc-900 dark:text-zinc-600" selected value="">TIPO DA PRISÃO</option>
         @if(!empty($type_prisons))
            @foreach ($type_prisons as $type_prison)
               <option class="text-zinc-900 dark:text-zinc-600" value="{{ $type_prison->id }}">
                  {{ $type_prison->type_prison }}
               </option>
            @endforeach
         @endif
      </select>
   </div>
</div>

<div class="mt-12 w-[90%] md:w-[50%] mx-auto">
   <select wire:model='date_type' wire:change='selectOperator'
      class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
      <option class="text-zinc-900 dark:text-zinc-600" selected value=""> SELECIONE O TIPO DE DATA (ENTRADA OU SAÍDA)</option>
      <option class="text-zinc-900 dark:text-zinc-600" value="date_entry">DATA DE ENTRADA</option>
      <option class="text-zinc-900 dark:text-zinc-600" value="date_exit">DATA DE SAÍDA</option>
   </select>
</div>

@if (!empty($date_type))
   <div class="md:flex md:gap-6 mt-6 w-[90%] md:w-[50%] mx-auto">
      <div class="w-full">
         <select wire:model="operator" wire:change='selectOperator'
            class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="text-zinc-900 dark:text-zinc-600" selected value=""> SELECIONE O OPERADOR</option>
            <option class="text-zinc-900 dark:text-zinc-600" value="="> = IGUAL A</option>
            <option class="text-zinc-900 dark:text-zinc-600" value="<"> < MENOR QUE</option>
            <option class="text-zinc-900 dark:text-zinc-600" value=">"> > MAIOR QUE</option>
            <option class="text-zinc-900 dark:text-zinc-600" value="<="> <= MENOR OU IGUAL A</option>
            <option class="text-zinc-900 dark:text-zinc-600" value=">="> >= MAIOR OU IGUAL A</option>
            <option class="text-zinc-900 dark:text-zinc-600" value="between">ENTRE</option>
         </select>
      </div>

      <div class="w-full">
         <x-input type="date" wire:model.live.debounce.500ms="start_date" />
         <x-label for="data_inicial" value="{{ $operator == 'between' ? 'DATA INICIAL' : 'DATA' }}" />
      </div>

      @if ($operator == 'between')
         <div class="w-full">
            <x-input type="date" wire:model.live.debounce.500ms="end_date" />
            <x-label for="data_final" value="{{ 'DATA FINAL' }}" />
         </div>
      @endif
   </div>
@endif