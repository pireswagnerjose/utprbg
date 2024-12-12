<table class="w-full text-sm text-left rtl:text-right text-zinc-500 dark:text-zinc-400">
    <thead class="text-xs text-zinc-700 uppercase bg-zinc-50 dark:bg-zinc-700 dark:text-zinc-400">
        <tr>
            <th scope="col" class="p-2"> Cód </th>
            <th scope="col" class="p-2"> Nome do Preso </th>
            <th scope="col" class="p-2"> Cela </th>
            <th scope="col" class="p-2"> Requisitante </th>
            <th scope="col" class="p-2"> Data </th>
            <th scope="col" class="p-2"> Hora </th>
            <th scope="col" class="p-2"> Município </th>
            <th scope="col" class="p-2"> Status </th>
            <th scope="col" class="p-2"> Obs. </th>
        </tr>
    </thead>
    <tbody>
        @forelse ( $external_exits as $key=>$external_exit )
        <tr class="odd:bg-white odd:dark:bg-zinc-900 even:bg-zinc-50 even:dark:bg-zinc-800 border-b dark:border-zinc-700">
            <td class="p-2"> {{ $key+1 }} </td>
            <td class="p-2"> <a class="text-blue-700" href="{{ route('prisoners.show',  $external_exit->prisoner->id ) }}"> {{  $external_exit->prisoner->name }} </a> </td>
            <td class="p-2 text-red-600">
                @if (!empty( $external_exit->prisoner->unit_address))
                    @foreach ( $external_exit->prisoner->unit_address as $unit_address)
                        @if ($unit_address->status == "ATIVO")
                            {{ $unit_address->cell->cell }}
                        @endif
                    @endforeach
                @endif
            </td>
            <td class="p-2"> {{ $external_exit->requesting->requesting }} </td>
            <td class="p-2"> {{ \Carbon\Carbon::parse($external_exit->event_date)->format('d/m/Y') }} </td>
            <td class="p-2"> {{ $external_exit->event_time }} </td>
            <td class="p-2 uppercase"> {{ $external_exit->municipality->municipality }}/{{ $external_exit->municipality->state->uf }} </td>
            <td class="p-2"> {{ $external_exit->status }} </td>
            <td class="p-2"> {{ $external_exit->remark }} </td>
        </tr>
        @empty
            <td class="p-2"> Não existe agendamentos feitos. </td>
        @endforelse
    </tbody>
</table>