@foreach ($unit_adds as $cell)
    <!-- title -->
    <h3 style="width: 100%; text-align: center; margin-top: 10px;">{{ $cell->cell }}</h3>

    <!-- table -->
    <table class="w-full text-sm text-left rtl:text-right text-zinc-500 dark:text-zinc-400">
        <thead class="text-xs text-zinc-700 uppercase bg-zinc-50 dark:bg-zinc-700 dark:text-zinc-400">
            <tr>
                <th scope="col" class="p-2"> Cód </th>
                @if($this->c_s_photo == 1)
                    <th scope="col" class="p-2"> Foto </th>
                @endif
                <th scope="col" class="p-2"> Nome do Preso </th>
                <th scope="col" class="p-2"> Cela </th>
                <th scope="col" class="p-2"> Data da Entrada </th>
            </tr>
        </thead>
        <tbody>
            @php
            $unit_adds = App\Models\Main\UnitAddress::where('cell_id', $cell->id)
                ->where('status', 'ATIVO')
                ->whereHas('prisoner', function ($querey){
                    $querey->where('status_prison_id', 1);
                })
                ->get();
            @endphp
            @forelse ( $unit_adds as $key=>$data )
            <tr class="odd:bg-white odd:dark:bg-zinc-900 even:bg-zinc-50 even:dark:bg-zinc-800 border-b dark:border-zinc-700">
                <td class="p-2"> {{ $key+1 }} </td>
                @if($this->c_s_photo == 1)
                    <td style="text-align: center; height: 78px; padding: 2px">
                        <img src='{{ asset("storage/".$data->prisoner->photo) }}' width="78"
                            alt="Neil image">
                    </td>
                @endif
                <td class="p-2"> <a class="text-blue-700" href="{{ route('prisoners.show', $data->prisoner->id ) }}"> {{ $data->prisoner->name }} </a> </td>
                <td class="p-2 text-red-600">{{ empty($data->cell->cell) ? null : $data->cell->cell }}</td>
                @php $prison = $prisons->where('prisoner_id', $data->prisoner->id)->first() @endphp
                <td class="p-2"> {{ empty($prison->entry_date) ? null : \Carbon\Carbon::parse($prison->entry_date)->format('d/m/Y') }}</td>
            </tr>
            @empty
                <td class="p-2"> Não existe resultado para essa consulta. </td>
            @endforelse
        </tbody>
    </table>
@endforeach