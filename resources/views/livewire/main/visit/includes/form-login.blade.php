<div class="w-full sm:w-[35%] p-12">
   <form class="space-y-8">
      <div>
         <span class=" flex justify-center">
            <img class="w-[20%] sm:w-[25%]" src='{{ asset("storage/site/policia_penal_logo.png") }}'>
         </span>
         <h5 class="text-base m-2 text-center font-medium text-zinc-900 dark:text-white">AGENDAMENTO DE VISITAS</h5>
      </div>
      {{-- mensagens do sistema --}}
      <div class="w-full text-center">
         @if (session('success'))
         <span class="text-green-500 text-base">{{ session('success') }}</span>
         @endif
         @if (session('error'))
         <span class="text-red-500 text-base">{{ session('error') }}</span>
         @endif
      </div>

      <div class="col-span-1 z-0 w-full group py-8">
         <select wire:model="type"
            class="uppercase block py-1 px-2 w-full text-sm text-zinc-500 dark:text-zinc-400 bg-transparent border-0 border-b border-zinc-400 dark:border-zinc-600 dark:focus:border-blue-500 focus:border-blue-600 appearance-none focus:outline-none focus:ring-0 peer">
            <option class="bg-zinc-100 dark:bg-zinc-900 text-zinc-900 dark:text-zinc-600 text-xs" selected value="">
               Escolha o Tipo de visita
            </option>
            @foreach ($this->visit_types as $visit_type_content)
            <option class="bg-zinc-100 dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100 text-base"
               value="{{ $visit_type_content ?? '' }}" @selected(old('type')==$visit_type_content)>{{
               $visit_type_content }}</option>
            @endforeach
         </select>
         <x-input-error for="type" class="mt-2">{{ $message ?? '' }}</x-input-error>
      </div>

      <div>
         <label for="text" class="block mb-2 text-sm font-medium text-zinc-900 dark:text-white">
            Código do Visitante
         </label>
         <input type="text" wire:model="code" x-mask="99999" placeholder="Somente números"
            class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-600 dark:border-zinc-500 dark:placeholder-zinc-400 dark:text-white" />
         <x-input-error for="code" class="mt-2">{{ $message ?? '' }}</x-input-error>
      </div>

      <div class="">
         <label for="text" class="block mb-2 text-sm font-medium text-zinc-900 dark:text-white">
            CPF do Visitante
         </label>
         <input type="text" wire:model="cpf" x-mask="999.999.999-99" placeholder="Somente números"
            class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-600 dark:border-zinc-500 dark:placeholder-zinc-400 dark:text-white" />
         <x-input-error for="cpf" class="mt-2">{{ $message ?? '' }}</x-input-error>
      </div>

      <div class="flex justify-center pt-4">
         <button type="button" wire:click="visit"
            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Acessar
         </button>
      </div>
   </form>
</div>