<table class="w-full text-sm text-left rtl:text-right text-zinc-500 dark:text-zinc-400">
   <thead class="text-xs text-zinc-700 uppercase bg-zinc-50 dark:bg-zinc-700 dark:text-zinc-400">
       <tr>
            <th scope="col" class="px-2 py-3 text-center">
                CÓD.
            </th>
            <th scope="col" class="px-2 py-3">
                NOME
            </th>
            <th scope="col" class="px-2 py-3 text-center">
                DT. ENTRADA
            </th>
            <th scope="col" class="px-2 py-3 text-center">
                DT. SAÍDA
            </th>
            <th scope="col" class="px-2 py-3 text-center">
                DIÁRIAS
            </th>
       </tr>
   </thead>
   <tbody>
       @forelse ( $prisons as $key=>$prison )
           <tr class="odd:bg-white odd:dark:bg-zinc-900 even:bg-zinc-50 even:dark:bg-zinc-800 border-b dark:border-zinc-700">
               <td class="px-2 py-2 w-[5%] text-center">
                   {{ $key+1 }}
               </td>
               <td class="px-2 py-2 w-[40%]">
                    {{ $prison->prisoner->name }} - {{ $prison->prisoner->cpf }}
               </td>
               <td class="px-2 py-2 w-[15%] text-center">
                    {{ \Carbon\Carbon::parse($prison->entry_date)->format('d/m/Y') }}
               </td>
               <td class="px-2 py-2 w-[15%] text-center">
                @if (!empty($prison->exit_date))
                    {{ \Carbon\Carbon::parse($prison->exit_date)->format('d/m/Y') }}
                @endif
               </td>
               
               <td class="px-2 py-2 w-[15%] text-center">
                    @php
                        // CÁLCULO DOS DIAS -----------------------
                        // retorna o a data de entrada do preso na unidade
                        $data_entry = \Carbon\Carbon::parse($prison->entry_date);

                        // retorna a data de saída do preso da unidade
                        if (!empty($prison->exit_date)) {
                            $exit_date = \Carbon\Carbon::parse($prison->exit_date);
                        }

                        // retorna o primeiro dia do mês para cálculo
                        $first_day = \Carbon\Carbon::parse($start_date);

                        // retorna o último dia do mês para cálculo = 30 ou 31
                        $last_day = \Carbon\Carbon::parse($end_date);

                        if (!empty($prison->exit_date)) {
                            if ($first_day->diffInDays($exit_date) < $first_day->diffInDays($last_day)) {
                                $days = $first_day->diffInDays($exit_date) + 1;
                            } elseif ($data_entry->diffInDays($last_day) < $first_day->diffInDays($last_day)) {
                                $days = $data_entry->diffInDays($last_day) + 1;
                            } else {
                                $days = $first_day->diffInDays($last_day) + 1;
                            }
                        } else {
                            if ($data_entry->diffInDays($last_day) < $first_day->diffInDays($last_day)) {
                                $days = $data_entry->diffInDays($last_day) + 1;
                            } else {
                                $days = $first_day->diffInDays($last_day) + 1;
                            }
                        }
                        // ---------------------
                    @endphp
                    @if (!empty($start_date) && !empty($end_date))
                        {{ $days }}
                    @endif
               </td>
           </tr>
       @empty
           <td class="px-2">
               Não existe agendamentos feitos.
           </td>
       @endforelse
       
   </tbody>
</table>