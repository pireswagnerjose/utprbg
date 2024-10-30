<h1 class="text-base text-blue-700 uppercase font-bold mb-2">Oitiva com Delegado</h1>
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
                Delegado
            </th>
            <th scope="col" class="px-2 py-3 text-center">
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
        @forelse ( $hearing_with_police_officers as $key=>$hearing_with_police_officer )
            <tr class="odd:bg-white odd:dark:bg-zinc-900 even:bg-zinc-50 even:dark:bg-zinc-800 border-b dark:border-zinc-700">
                <td class="px-2 py-4 w-[3%] text-center">
                    {{ $key+1 }}
                </td>
                <td class="px-2 py-4 w-[20%]">
                    {{ $hearing_with_police_officer->prisoner->name }}
                </td>
                <td class="px-2 py-4 w-[5%] text-center font-bold">
                    @if (!empty( $hearing_with_police_officer->prisoner->unit_address))
                        @foreach ( $hearing_with_police_officer->prisoner->unit_address as $unit_address)
                            @if ($unit_address->status == "ATIVO")
                                {{ $unit_address->cell->cell }}
                            @endif
                        @endforeach
                    @endif
                </td>
                <td class="px-2 py-4 w-[15%]">
                    {{ $hearing_with_police_officer->delegate }}
                </td>
                <td class="px-2 py-4 w-[12%] text-center">
                    {{ $hearing_with_police_officer->modality_care->modality_care }}
                </td>
                <td class="px-2 py-4 w-[7%] text-center">
                    {{ \Carbon\Carbon::parse($hearing_with_police_officer->date_of_service)->format('d/m/Y') }}
                </td>
                <td class="px-2 py-4 w-[7%]  text-center">
                    {{ $hearing_with_police_officer->time_of_service }}
                </td>
                <td class="px-2 py-4 w-[7%]  text-center">
                    {{ $hearing_with_police_officer->status }}
                </td>
                <td class="px-2 py-4 w-[24%] text-center">
                    {{ $hearing_with_police_officer->remark }}
                </td>
            </tr>
        @empty
            <td class="px-2">
                Não existe agendamentos feitos.
            </td>
        @endforelse
    </tbody>
</table>
{{-- paginação --}}
<div class="pl-2 py-4 mt-4 text-zinc-50 dark:text-zinc-400 border-t border-blue-300 dark:border-blue-500 pb-3">
    {{ $hearing_with_police_officers->onEachSide(1)->links() }}
</div>