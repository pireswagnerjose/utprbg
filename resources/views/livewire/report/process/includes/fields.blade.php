<!-- Linha 1 -->
<div class="grid md:grid-cols-4 gap-6 mt-6 w-[90%] mx-auto">
   <div class="col-span-2 w-full">
      <select wire:model.live.debounce.500ms="origin_process_id"
         class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
         <option class="text-zinc-900 dark:text-zinc-600" selected value="">ORIGEM DO PROCESSO</option>
         @foreach ($origin_processes as $origin_process)
         <option class="text-zinc-900 dark:text-zinc-600" value="{{ $origin_process->id }}">
            {{ $origin_process->origin_process }}
         </option>
         @endforeach
      </select>
   </div>
   <div class="col-span-2 w-full">
      <select wire:model.live.debounce.500ms="process_regime_id"
         class="uppercase block py-1 mt-1 px-0 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
         <option class="text-zinc-900 dark:text-zinc-600" selected value="">ORIGEM DO PROCESSO</option>
         @foreach ($process_regimes as $process_regime)
         <option class="text-zinc-900 dark:text-zinc-600" value="{{ $process_regime->id }}">
            {{ $process_regime->process_regime }}
         </option>
         @endforeach
      </select>
   </div>
</div>
<!-- end -->