<div class="w-1/4  mx-auto p-4 bg-white border border-zinc-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-zinc-800 dark:border-zinc-700">
   <form class="space-y-8">
       <div>
           <span class="flex justify-center">
               <img class="w-1/3" src='{{ asset("storage/site/policia_penal_logo.png") }}' >
           </span>
           <h5 class="text-base m-2 text-center font-medium text-zinc-900 dark:text-white">AGENDAMENTO DE VISITAS</h5>
       </div>
       <div>
           <label for="text" class="block mb-2 text-sm font-medium text-zinc-900 dark:text-white">Código do Visitante</label>
           <input type="text" wire:model="code" x-mask="99999" placeholder="Somente números" class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-600 dark:border-zinc-500 dark:placeholder-zinc-400 dark:text-white" />
       </div>
       <div class="">
           <label for="text" class="block mb-2 text-sm font-medium text-zinc-900 dark:text-white">CPF do Visitante</label>
           <input type="text" wire:model="cpf" x-mask="999.999.999-99" placeholder="Somente números" class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-600 dark:border-zinc-500 dark:placeholder-zinc-400 dark:text-white" />
       </div>
      
       <div class="grid place-items-center pt-4">
           <button type="button" wire:click="visit" class="w-1/2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
               Acessar
           </button>
       </div>
   </form>
</div>