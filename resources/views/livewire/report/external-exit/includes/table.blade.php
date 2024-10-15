<table class="w-full text-sm text-left rtl:text-right text-zinc-500 dark:text-zinc-400">
   <thead class="text-xs text-zinc-700 uppercase bg-zinc-50 dark:bg-zinc-700 dark:text-zinc-400">
       <tr>
           <th scope="col" class="px-2 py-3 text-center">
               Cód
           </th>
           <th scope="col" class="px-2 py-3">
               Nome do Preso
           </th>
           <th scope="col" class="px-2 py-3 text-center">
               Cela
           </th>
           <th scope="col" class="px-2 py-3">
               Requisitante
           </th>
           <th scope="col" class="px-2 py-3 text-center">
               Data
           </th>
           <th scope="col" class="px-2 py-3 text-center">
               Hora
           </th>
           <th scope="col" class="px-2 py-3 text-center">
               Status
           </th>
           <th scope="col" class="px-2 py-3 text-center">
               Obs.
           </th>
       </tr>
   </thead>
   <tbody>
        @forelse ( $external_exits as $key=>$external_exit )
            <tr class="odd:bg-white odd:dark:bg-zinc-900 even:bg-zinc-50 even:dark:bg-zinc-800 border-b dark:border-zinc-700">
                <td class="px-2 py-4 w-[3%] text-center">
                    {{ $key+1 }}
                </td>
                <td class="px-2 py-4 w-[27%]">
                    {{ $external_exit->prisoner->name }}
                </td>
                <td class="px-2 py-4 w-[5%] text-center font-bold">
                    @if (!empty( $external_exit->prisoner->unit_address))
                        @foreach ( $external_exit->prisoner->unit_address as $unit_address)
                            @if ($unit_address->status == "ATIVO")
                                {{ $unit_address->cell->cell }}
                            @endif
                        @endforeach
                    @endif
                </td>
                <td class="px-2 py-4 w-[20%]">
                   {{ $external_exit->requesting->requesting }}
                </td>
                <td class="px-2 py-4 w-[7%] text-center">
                   {{ \Carbon\Carbon::parse($external_exit->event_date)->format('d/m/Y') }}
                </td>
                <td class="px-2 py-4 w-[7%]  text-center">
                   {{ $external_exit->event_time }}
                </td>
                <td class="px-2 py-4 w-[7%]  text-center">
                   {{ $external_exit->status }}
                </td>
                <td class="px-2 py-4 w-[24%]">
                    {{ $external_exit->remark }}
                </td>
            </tr>
        @empty
            <td class="px-2">
                Não existe agendamentos feitos.
            </td>
        @endforelse
       
   </tbody>
</table>