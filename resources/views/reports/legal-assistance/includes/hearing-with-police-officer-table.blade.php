<h1>Oitiva com Delegado</h1>
<table>
    <thead>
        <tr>
            <th scope="col"> Cód </th>
            <th scope="col"> Nome do Preso </th>
            <th scope="col"> Cela </th>
            <th scope="col"> Delegado </th>
            <th scope="col"> Tipo do Atendimento </th>
            <th scope="col"> Data </th>
            <th scope="col"> Hora </th>
            <th scope="col"> Status </th>
            <th scope="col"> Obs. </th>
        </tr>
    </thead>
    <tbody>
        @forelse ( $hearing_with_police_officers as $key=>$hearing_with_police_officer )
            <tr>
                <td> {{ $key+1 }} </td>
                <td> {{ $hearing_with_police_officer->prisoner->name }} </td>
                <td>
                    @if (!empty( $hearing_with_police_officer->prisoner->unit_address))
                        @foreach ( $hearing_with_police_officer->prisoner->unit_address as $unit_address)
                            @if ($unit_address->status == "ATIVO")
                                {{ $unit_address->cell->cell }}
                            @endif
                        @endforeach
                    @endif
                </td>
                <td> {{ $hearing_with_police_officer->delegate }} </td>
                <td> {{ $hearing_with_police_officer->modality_care->modality_care }} </td>
                <td> {{ \Carbon\Carbon::parse($hearing_with_police_officer->date_of_service)->format('d/m/Y') }} </td>
                <td> {{ $hearing_with_police_officer->time_of_service }} </td>
                <td> {{ $hearing_with_police_officer->status }} </td>
                <td> {{ $hearing_with_police_officer->remark }} </td>
            </tr>
        @empty
            <td> Não existe agendamentos feitos. </td>
        @endforelse
    </tbody>
</table>