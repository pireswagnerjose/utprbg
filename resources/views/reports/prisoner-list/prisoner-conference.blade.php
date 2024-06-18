<x-report-layout>
    <div style="text-align: center; margin: 20px 0;">
        <?php $date = new DateTimeImmutable();
      echo '<strong>LISTAGEM DE INTERNOS </strong> - Data: '.$date->format('d-m-Y'); ?>
    </div>
    <div>
        {{-- @if ($ward)
         - 
        <h1 style="text-align: center; font-size: 20px; font-stretch: condensed">{{ $ward->ward }}</h1>
        @endif --}}
    </div>


    @foreach ($cells as $cell)
        <h3 style="width: 100%; text-align: center; margin-top: 10px;">{{ $cell->cell }}</h3>

        <table cellspacing="0" rules="none" style="font-size: 11px; font-stretch: condensed">
            <thead>
                <tr style="background-color: #000; color: #ccc">
                    @if ($c_s_photo == 1)
                    <th scope="col" style="width: 10px">
                        FOTO
                    </th>
                    @else
                    <th scope="col" style="width: 78px">
                        CÓD.
                    </th>
                    @endif
                    <th scope="col" class="name" style="width: 335px">
                        NOME
                    </th>
                    <th scope="col" class="date" style="width: 90px">
                        DT. ENTRADA
                    </th>
                    <th scope="col" class="ward" style="width: 220px">
                        OBS
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cell->unit_addresses as $id => $unit_address)
                <tr style="border: 1px solid #ccc">
                    @if ($c_s_photo == 1)
                        <td style="text-align: center; height: 78px; padding: 2px">
                            <img src="{{ storage_path('app/public/'.$unit_address->prisoner->photo) }}" width="78"
                                alt="Neil image">
                        </td>
                    @else
                        <td style="text-align: center; padding: 0 2px">
                            <p> {{ $id + 1 }} </p>
                        </td>
                    @endif
                    <td style="">
                        <p>{{ $unit_address->prisoner->name }}</p>
                    </td>
                    @php
                        $prison = $prisons->where('prisoner_id', $unit_address->prisoner_id)->first();
                    @endphp
                    <td style="text-align: center;">
                        <p>{{ \Carbon\Carbon::parse($prison->entry_date)->format('d/m/Y') }}</p>
                    </td>
                    <td style="text-align: center;">
                        <p></p>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding-top: 10px; text-align: center; font-size: 12px">
                        Não foram encontrados registros na sua pesquisa!
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    @endforeach

</x-report-layout>