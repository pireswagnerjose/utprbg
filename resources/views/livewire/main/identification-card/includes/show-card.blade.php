{{-- carteirinha --}}
<div class="grid grid-cols-2 justify-stretch gap-2">
   <div class="border-2 border-zinc-600 dark:border-zinc-600 p-2 rounded-lg">
      <div class="flex w-full gap-2">
         <div class="w-[75%]">
            <div class="flex flex-row w-full">
               <div class="w-[20%]">{{-- logo polícia penal --}}
                  <span class="flex flex-col w-full">
                     <img class="max-h-48 rounded-lg" src='{{ asset("storage/site/policia_penal_logo.png") }}'
                        alt="{{ $identification_card->visitant->name }}">
                  </span>
               </div>
               <div class="w-[80%] text-center">{{-- cabeçalho --}}
                  <span class="text-xs block">ESTADO DO TOCANTINS</span>
                  <span class="text-base font-bold block">SECRETARIA DA CIDADANIA E JUSTIÇA</span>
                  <span class="text-xs font-bold block">SUPERINTENDÊNCIA DE ADMINISTRAÇÃO <br>PENITENCIÁRIO E
                     PRISIONAL</span>
                  <span class="text-2xl font-bold block">UTPRBG</span>
                  <span class="text-xs font-bold block">ARAGUAÍNA/TO</span>
               </div>
            </div>
            <div class="bg-zinc-700 mt-1 rounded-lg">{{-- identificação da carteirinha --}}
               <h1 class="text-zinc-100 text-2xl font-bold p-2 text-center">{{ $identification_card->type }}</h1>
            </div>
         </div>
         <div class="w-[25%]">{{-- foto do perfil --}}
            <span class="flex flex-col w-full h-full">
               <img class="object-cover h-full rounded-lg"
                  src='{{ asset("storage/" . $identification_card->visitant->photo ) }}'
                  alt="{{ $identification_card->visitant->name }}">
            </span>
         </div>
      </div>
      <div class="mt-2 space-y-2">
         <span class="text-sm block">
            VISITANTE:
            <strong class="text-base">
               {{ $identification_card->visitant->name }}
            </strong>
         </span>
         <span class="text-sm block">
            REEDUCANDO:
            <strong class="text-base">
               {{ $identification_card->prisoner->name }}
            </strong>
         </span>
         <div class="flex flex-row gap-4 justify-between">
            <span class="text-sm block">
               PARENTESCO:
               <strong class="text-base">
                  {{ $identification_card->degree_of_kinship->degree_of_kinship }}
               </strong>
            </span>
            <span class="text-sm block">
               CPF:
               <strong class="text-base">
                  {{ $identification_card->visitant->cpf }}
               </strong>
            </span>
         </div>
         <div class="flex justify-between">
            <span class="text-base">
               CÓD.:
               <strong class="text-xl text-red-700">
                  {{ $identification_card->id }}
               </strong>
            </span>
            <span class="text-base">
               VALIDADE:
               <strong class="text-xl text-red-700">
                  {{ \Carbon\Carbon::parse($identification_card->expiration_date)->format('d/m/Y') }}
               </strong>
            </span>
         </div>
      </div>
   </div>
   <div class="border-2 border-zinc-600 dark:border-zinc-600 p-2 rounded-lg">
      <div>
         <ul class="text-sm mt-4">
            <li>Esta carteira é de uso pessoal do titular e intransferível;</li>
            <li>É obrigatório a apresentação da identidade junto com esta carteira;</li>
            <li>A perda, furto ou extravio desta carteira deverá ser imediatamente comunicado à UTPRBG;</li>
            <li>O uso indevido por terceiros implicará na suspensão do direito de visita;</li>
            <li>É obrigatório a apresentação desta plastificada.</li>
         </ul>
      </div>
      <div class="mt-36 w-3/4 mx-auto border-t border-zinc-300 dark:border-zinc-600 text-center text-xs">DIRETOR DA
         UTPRBG</div>
   </div>
</div>

{{-- Conteúdo da Página --}}
<div class="mt-12">
   <div class="w-full col-span-10">
      {{-- linha 1 --}}
      <div class=" mb-5">
         <x-item-topic>Data do Cadastro</x-item-topic>
         @empty(!$identification_card->date_of_creation)
         <x-item-data>{{ \Carbon\Carbon::parse($identification_card->date_of_creation)->format('d/m/Y') }}
         </x-item-data>
         @endempty
      </div>
      <div>
         <x-item-topic>Informações Complementares</x-item-topic>
         <x-item-data>{{ $identification_card->remark }}</x-item-data>
      </div>
   </div>
</div>
</div>