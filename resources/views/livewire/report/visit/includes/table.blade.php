<table class="w-full text-sm text-left rtl:text-right text-zinc-500 dark:text-zinc-400">
    <thead class="text-xs text-zinc-700 uppercase bg-zinc-50 dark:bg-zinc-700 dark:text-zinc-400">
        <tr>
            <th scope="col" class="p-2"> Cód </th>
            <th scope="col" class="p-2"> Cód. do Agendamento </th>
            <th scope="col" class="p-2"> Nome do Visitante </th>
            <th scope="col" class="p-2"> Nome do Preso </th>
            <th scope="col" class="p-2"> Cela </th>
            <th scope="col" class="p-2"> Data da Visita </th>
            <th scope="col" class="p-2"> Data do Agendamento </th>
            <th scope="col" class="p-2"> Tipo da Visita </th>
            <th scope="col" class="p-2"> Ação </th>
        </tr>
    </thead>
    <tbody>
        @forelse ( $visit_schedulings as $key=>$visit )
        <tr
            class="odd:bg-white odd:dark:bg-zinc-900 even:bg-zinc-50 even:dark:bg-zinc-800 border-b dark:border-zinc-700">
            <td class="p-2"> {{ $key+1 }} </td>
            <td class="p-2"> {{ $visit->id }} </td>
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
            <td class="p-2">
                <div class="group grid justify-items-center w-12">
                    <button type="button" wire:click="delete({{ $visit->id }})"
                        class="w-6 h-6 bg-red-600 dark:bg-red-500 rounded-full p-2">
                        <svg class="w-3 h-3 text-red-50 dark:text-red-50 hover:text-red-400 hover:dark:text-red-400"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 8h6m-9-3.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0ZM5 11h3a4 4 0 0 1 4 4v2H1v-2a4 4 0 0 1 4-4Z" />
                        </svg>
                    </button>
                </div>
            </td>
        </tr>
        @empty
        <td class="p-2"> Não existe resultado para essa consulta. </td>
        @endforelse
    </tbody>
</table>