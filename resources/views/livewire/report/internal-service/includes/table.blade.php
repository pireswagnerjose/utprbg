<table class="w-full text-sm text-left rtl:text-right text-zinc-500 dark:text-zinc-400">
    <thead class="text-xs text-zinc-700 uppercase bg-zinc-50 dark:bg-zinc-700 dark:text-zinc-400">
        <tr>
            <th scope="col" class="p-2"> Cód </th>
            <th scope="col" class="p-2"> Nome do Preso </th>
            <th scope="col" class="p-2"> Cela </th>
            <th scope="col" class="p-2"> Tipo do Atendimento </th>
            <th scope="col" class="p-2"> Data </th>
            <th scope="col" class="p-2"> Hora </th>
            <th scope="col" class="p-2"> Status </th>
            <th scope="col" class="p-2"> Obs. </th>
        </tr>
    </thead>
    <tbody>
        @forelse ( $internal_services as $key=>$internal_service )
        <tr class="odd:bg-white odd:dark:bg-zinc-900 even:bg-zinc-50 even:dark:bg-zinc-800 border-b dark:border-zinc-700">
            <td class="p-2"> {{ $key+1 }} </td>
            <td class="p-2"> {{ $internal_service->prisoner->name }} </td>
            <td class="p-2 text-red-600">
                @if (!empty( $internal_service->prisoner->unit_address))
                    @foreach ( $internal_service->prisoner->unit_address as $unit_address)
                        @if ($unit_address->status == "ATIVO")
                            {{ $unit_address->cell->cell }}
                        @endif
                    @endforeach
                @endif
            </td>
            <td class="p-2"> {{ $internal_service->type_service->type_service }} </td>
            <td class="p-2"> {{ \Carbon\Carbon::parse($internal_service->date)->format('d/m/Y') }} </td>
            <td class="p-2"> {{ $internal_service->time }} </td>
            <td class="p-2"> {{ $internal_service->status }} </td>
            <td class="p-2"> {{ $internal_service->remark }} </td>
        </tr>
        @empty
            <td class="p-2"> Não existe agendamentos feitos. </td>
        @endforelse
    </tbody>
</table>