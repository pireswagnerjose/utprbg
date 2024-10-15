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
                Tipo do Atendimento
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
        @forelse ( $internal_services as $key=>$internal_service )
        <tr class="odd:bg-white odd:dark:bg-zinc-900 even:bg-zinc-50 even:dark:bg-zinc-800 border-b dark:border-zinc-700">
            <td class="px-2 py-4 w-[3%] text-center">
                {{ $key+1 }}
            </td>
            <td class="px-2 py-4 w-[27%]">
                {{ $internal_service->prisoner->name }}
            </td>
            <td class="px-2 py-4 w-[5%] text-center font-bold">
                @if (!empty( $internal_service->prisoner->unit_address))
                    @foreach ( $internal_service->prisoner->unit_address as $unit_address)
                        @if ($unit_address->status == "ATIVO")
                            {{ $unit_address->cell->cell }}
                        @endif
                    @endforeach
                @endif
            </td>
            <td class="px-2 py-4 w-[20%]">
                {{ $internal_service->type_service->type_service }}
            </td>
            <td class="px-2 py-4 w-[7%] text-center">
                {{ \Carbon\Carbon::parse($internal_service->date)->format('d/m/Y') }}
            </td>
            <td class="px-2 py-4 w-[7%] text-center">
                {{ $internal_service->time }}
            </td>
            <td class="px-2 py-4 w-[7%] text-center">
                {{ $internal_service->status }}
            </td>
            <td class="px-2 py-4 w-[24%]">
                {{ $internal_service->remark }}
            </td>
        </tr>
        @empty
            <td class="px-2">
                Não existe agendamentos feitos.
            </td>
        @endforelse
    </tbody>
</table>