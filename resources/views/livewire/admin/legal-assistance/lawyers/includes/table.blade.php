<table class="w-full text-sm text-left rtl:text-right text-zinc-500 dark:text-zinc-400 mb-6">
    <thead class="text-xs text-zinc-700 uppercase bg-zinc-50 dark:bg-zinc-700 dark:text-zinc-400">
        <tr>
            <th scope="col" class="p-2"> Nº </th>
            <th scope="col" class="p-2"> Preso </th>
            <th scope="col" class="p-2"> Data Atendimento </th>
            <th scope="col" class="p-2"> Tipo Atendimento </th>
            <th scope="col" class="p-2"> Status </th>
            <th scope="col" class="p-2"> Observação </th>
        </tr>
    </thead>
    <tbody>
        @forelse ($lawyer->assistance_with_lawyers as $key=>$assistance_with_lawyer)
            <tr
                class="odd:bg-white odd:dark:bg-zinc-900 even:bg-zinc-50 even:dark:bg-zinc-800 border-b dark:border-zinc-700">
                <td class="p-2"> {{ $key + 1 }} </td>
                <td class="p-2"> <a class="text-blue-700"
                        href="{{ route('prisoners.show', $assistance_with_lawyer->prisoner->id) }}">
                        <p>{{ $assistance_with_lawyer->prisoner->name }}</p>
                    </a> </td>
                <td class="p-2">
                    {{ \Carbon\Carbon::parse($assistance_with_lawyer->date_of_service)->format('d/m/Y') }}</td>
                <td class="p-2"> {{ $assistance_with_lawyer->modality_care->modality_care }} </td>
                <td class="p-2"> {{ $assistance_with_lawyer->status }} </td>
                <td class="p-2"> {{ $assistance_with_lawyer->remark }} </td>
            </tr>
        @empty
            <td colspan="6" class="p-2 text-center text-blue-600"> Não existe resultado para essa consulta. </td>
        @endforelse
    </tbody>
</table>
