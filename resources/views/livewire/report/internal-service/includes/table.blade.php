<table class="w-full text-sm text-left rtl:text-right text-zinc-500 dark:text-zinc-400">
   <thead class="text-xs text-zinc-700 uppercase bg-zinc-50 dark:bg-zinc-700 dark:text-zinc-400">
       <tr>
           <th scope="col" class="px-2 py-3 text-center">
               Cód
           </th>
           <th scope="col" class="px-2 py-3">
               Nome do Preso
           </th>
           <th scope="col" class="px-2 py-3">
               Tipo do Atendimento
           </th>
           <th scope="col" class="px-2 py-3 text-center">
               Data do Evento
           </th>
           <th scope="col" class="px-2 py-3 text-center">
               Hora do Evento
           </th>
           <th scope="col" class="px-2 py-3 text-center">
               Status
           </th>
       </tr>
   </thead>
   <tbody>
       @forelse ( $internal_services as $key=>$internal_service )
           <tr class="odd:bg-white odd:dark:bg-zinc-900 even:bg-zinc-50 even:dark:bg-zinc-800 border-b dark:border-zinc-700">
               <td class="px-2 py-4 w-[5%] text-center">
                   {{ $key+1 }}
               </td>
               <td class="px-2 py-4 w-[40%]">
                   {{ $internal_service->prisoner->name }}
               </td>
               <td class="px-2 py-4 w-[25%]">
                   {{ $internal_service->type_service->type_service }}
               </td>
               <td class="px-2 py-4 w-[10%] text-center">
                   {{ \Carbon\Carbon::parse($internal_service->date)->format('d/m/Y') }}
               </td>
               <td class="px-2 py-4 w-[10%]  text-center">
                   {{ $internal_service->time }}
               </td>
               <td class="px-2 py-4 w-[10%]  text-center">
                   {{ $internal_service->status }}
               </td>
           </tr>
       @empty
           <td class="px-2">
               Não existe agendamentos feitos.
           </td>
       @endforelse
       
   </tbody>
</table>