<h1 class="text-base text-blue-700 uppercase font-bold mb-2">Atendimento com a Justiça Restaurativa</h1>
<table class="w-full text-sm text-left rtl:text-right text-zinc-500 dark:text-zinc-400">
    <thead class="text-xs text-zinc-700 uppercase bg-zinc-50 dark:bg-zinc-700 dark:text-zinc-400">
        <tr>
            <th scope="col" class="p-2"> Cód </th>
            <th scope="col" class="p-2"> Nome do Preso </th>
            <th scope="col" class="p-2"> Cela </th>
            <th scope="col" class="p-2"> Conciliador </th>
            <th scope="col" class="p-2"> Tipo do Atendimento </th>
            <th scope="col" class="p-2"> Data </th>
            <th scope="col" class="p-2"> Hora </th>
            <th scope="col" class="p-2"> Status </th>
            <th scope="col" class="p-2"> Obs. </th>
        </tr>
    </thead>
    <tbody>
        @forelse ( $restorative_justices as $key=>$restorative_justice )
            <tr class="odd:bg-white odd:dark:bg-zinc-900 even:bg-zinc-50 even:dark:bg-zinc-800 border-b border-zinc-400 dark:border-zinc-700">
                <td class="p-2"> {{ $key+1 }} </td>
                <td class="p-2"> {{ $restorative_justice->prisoner->name }} </td>
                <td class="p-2 text-red-600">
                    @if (!empty( $restorative_justice->prisoner->unit_address))
                        @foreach ( $restorative_justice->prisoner->unit_address as $unit_address)
                            @if ($unit_address->status == "ATIVO")
                                {{ $unit_address->cell->cell }}
                            @endif
                        @endforeach
                    @endif
                </td>
                <td class="p-2"> {{ $restorative_justice->facilitator_conciliator }} </td>
                <td class="p-2"> {{ $restorative_justice->modality_care->modality_care }} </td>
                <td class="p-2"> {{ \Carbon\Carbon::parse($restorative_justice->date_of_service)->format('d/m/Y') }} </td>
                <td class="p-2"> {{ $restorative_justice->time_of_service }} </td>
                <td class="p-2"> {{ $restorative_justice->status }} </td>
                <td class="p-2"> {{ $restorative_justice->remark }} </td>
            </tr>
        @empty
            <td class="p-2"> Não existe agendamentos feitos. </td>
        @endforelse
    </tbody>
</table>
{{-- paginação --}}
<div class="pl-2 py-4 mt-4 text-zinc-50 dark:text-zinc-400 border-t border-blue-300 dark:border-blue-500 pb-3">
    {{ $restorative_justices->onEachSide(1)->links() }}
</div>