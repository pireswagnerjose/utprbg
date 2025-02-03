<table class="w-full text-sm text-left rtl:text-right text-zinc-500 dark:text-zinc-400">
    <thead class="text-xs text-zinc-700 uppercase bg-zinc-50 dark:bg-zinc-700 dark:text-zinc-400">
        <tr>
            <th scope="col" class="p-2"> Cód </th>
            <th scope="col" class="p-2"> Nome do Visitante </th>
            <th scope="col" class="p-2"> Nome do Preso </th>
            <th scope="col" class="p-2"> Cela </th>
            <th scope="col" class="p-2"> Data da Visita </th>
            <th scope="col" class="p-2"> Data do Agendamento </th>
            <th scope="col" class="p-2"> Tipo da Visita </th>
        </tr>
    </thead>
    <tbody>
        @forelse ( $visit_schedulings as $key=>$visit )
        <tr
            class="odd:bg-white odd:dark:bg-zinc-900 even:bg-zinc-50 even:dark:bg-zinc-800 border-b dark:border-zinc-700">
            <td class="p-2"> {{ $key+1 }} </td>
            <td class="p-2"> <a class="text-blue-700" href="{{ route('visitant.show', $visit->visitant_id ) }}"> {{
                    $visit->visitant->name }} </a> </td>
            <td class="p-2"> <a class="text-blue-700" href="{{ route('prisoners.show', $visit->prisoner_id ) }}"> {{
                    $visit->prisoner->name }} </a> </td>
            <td class="p-2 text-red-600">
                @if (!empty( $visit->prisoner->unit_address))
                @foreach ( $visit->prisoner->unit_address as $unit_address)
                @if ($unit_address->status == "ATIVO")
                {{ $unit_address->cell->cell }}
                @endif
                @endforeach
                @endif
            </td>
            <td class="p-2"> {{ \Carbon\Carbon::parse($visit->date_visit)->format('d/m/Y') }}</td>
            <td class="p-2"> {{ \Carbon\Carbon::parse($visit->created_at)->format('d/m/Y - H:i:s') }}</td>
            <td class="p-2"> {{ $visit->type }} </td>
        </tr>
        @empty
        <td class="p-2"> Não existe resultado para essa consulta. </td>
        @endforelse
    </tbody>
</table>