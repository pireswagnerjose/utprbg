<table class="w-full text-sm text-left rtl:text-right text-zinc-500 dark:text-zinc-400">
    <thead class="text-xs text-zinc-700 uppercase bg-zinc-50 dark:bg-zinc-700 dark:text-zinc-400">
        <tr>
            <th scope="col" class="p-2"> Cód </th>
            <th scope="col" class="p-2"> Nome do Preso </th>
        </tr>
    </thead>
    <tbody>
        @forelse ($prisoners as $key=>$prisoner)
            <tr
                class="odd:bg-white odd:dark:bg-zinc-900 even:bg-zinc-50 even:dark:bg-zinc-800 border-b dark:border-zinc-700">
                <td class="p-2"> {{ $key + 1 }} </td>
                <td class="p-2"> <a class="text-blue-700" href="{{ route('prisoners.show', $prisoner->id) }}">
                        {{ $prisoner->name }} </a> </td>
            </tr>
        @empty
            <td class="p-2"> Não existe resultado para essa consulta. </td>
        @endforelse
    </tbody>
</table>
