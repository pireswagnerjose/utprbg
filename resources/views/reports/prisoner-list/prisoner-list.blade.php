<x-report-layout>
    <div style="text-align: center; margin: 20px 0;">
        <?php $date = new DateTimeImmutable();
      echo '<strong>LISTAGEM DE INTERNOS </strong> - Data: '.$date->format('d-m-Y'); ?>
    </div>

    <table cellspacing="0" rules="none" style="font-size: 11px; font-stretch: condensed">
        <thead>
            <tr style="background-color: #000; color: #ccc;">
                @if ($c_s_photo == 1)
                <th scope="col" style="width: 78px">
                    FOTO
                </th>
                @else
                <th scope="col" style="width: 78px">
                    CÓD.
                </th>
                @endif
                <th scope="col" class="name" style="width: 400px">
                    NOME
                </th>
                <th scope="col" class="date" style="width: 90px">
                    DT. ENTRADA
                </th>
                <th scope="col" class="ward" style="width: 150px">
                    PAVILHÃO / CELA
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($unit_adds as $id => $unit_add)
            <tr style="border: 1px solid #ccc;">
                @if ($c_s_photo == 1)
                    <td style="text-align: center; height: 78px; padding: 2px">
                        <img src="{{ storage_path('app/public/'.$unit_add->prisoner->photo) }}" width="78"
                            alt="Neil image">
                    </td>
                @else
                    <td style="text-align: center; padding: 0 2px">
                        <p> {{ $id + 1 }} </p>
                    </td>
                @endif
                <td style="padding: 3px 0;">
                    <p>{{ $unit_add->prisoner->name }}</p>
                </td>

                @php
                    $prison = $prisons->where('prisoner_id', $unit_add->prisoner_id)
                                        ->first();
                @endphp
                <td style="text-align: center;">
                    <p>{{ \Carbon\Carbon::parse($prison->entry_date)->format('d/m/Y') }}</p>
                </td>
                <td style="text-align: center;">
                    <p>{{ $unit_add->cell->cell }}</p>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="padding-top: 10px; text-align: center; font-size: 12px">
                    CELA VAZIA!
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

</x-report-layout>