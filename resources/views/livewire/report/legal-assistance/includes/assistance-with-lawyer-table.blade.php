<h1 class="text-base text-blue-700 uppercase font-bold mb-2">Atendimento com Advogado</h1>
<table class="w-full text-sm text-left rtl:text-right text-zinc-500 dark:text-zinc-400">
    <thead class="text-xs text-zinc-700 uppercase bg-zinc-50 dark:bg-zinc-700 dark:text-zinc-400">
        <tr>
            <th scope="col" class="p-2"> Cód </th>
            <th scope="col" class="p-2"> Nome do Preso </th>
            <th scope="col" class="p-2"> Cela </th>
            <th scope="col" class="p-2"> Nome do Advogado </th>
            <th scope="col" class="p-2"> Tipo do Atendimento </th>
            <th scope="col" class="p-2"> Data </th>
            <th scope="col" class="p-2"> Hora </th>
            <th scope="col" class="p-2"> Status </th>
            <th scope="col" class="p-2"> Obs. </th>
        </tr>
    </thead>
    <tbody>
        @forelse ( $assistance_with_lawyers as $key=>$assistance_with_lawyer )
            <tr class="odd:bg-white odd:dark:bg-zinc-900 even:bg-zinc-50 even:dark:bg-zinc-800 border-b dark:border-zinc-700">
                <td class="p-2"> {{ $key+1 }} </td>
                <td class="p-2"> {{ $assistance_with_lawyer->prisoner->name }} </td>
                <td class="p-2 text-red-600">
                    @if (!empty( $assistance_with_lawyer->prisoner->unit_address))
                        @foreach ( $assistance_with_lawyer->prisoner->unit_address as $unit_address)
                            @if ($unit_address->status == "ATIVO")
                                {{ $unit_address->cell->cell }}
                            @endif
                        @endforeach
                    @endif
                </td>
                <td class="p-2"> {{ $assistance_with_lawyer->lawyer->lawyer }} </td>
                <td class="p-2"> {{ $assistance_with_lawyer->modality_care->modality_care }} </td>
                <td class="p-2"> {{ \Carbon\Carbon::parse($assistance_with_lawyer->date_of_service)->format('d/m/Y') }} </td>
                <td class="p-2"> {{ $assistance_with_lawyer->time_of_service }} </td>
                <td class="p-2"> {{ $assistance_with_lawyer->status }} </td>
                <td class="p-2"> {{ $assistance_with_lawyer->remark }} </td>
            </tr>
        @empty
            <td class="p-2"> Não existe agendamentos feitos. </td>
        @endforelse
    </tbody>
</table>
{{-- paginação --}}
<div class="pl-2 py-4 mt-4 text-zinc-50 dark:text-zinc-400 border-t border-blue-300 dark:border-blue-500 pb-3">
    {{ $assistance_with_lawyers->onEachSide(1)->links() }}
</div>