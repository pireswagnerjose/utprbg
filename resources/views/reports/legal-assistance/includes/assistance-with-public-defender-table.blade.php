<h1>Atendimento com Defensor Público</h1>
<table>
    <thead>
        <tr>
            <th scope="col"> Cód </th>
            <th scope="col"> Nome do Preso </th>
            <th scope="col"> Cela </th>
            <th scope="col"> Nome do Defensor </th>
            <th scope="col"> Tipo do Atendimento </th>
            <th scope="col"> Data </th>
            <th scope="col"> Hora </th>
            <th scope="col"> Status </th>
            <th scope="col"> Obs. </th>
        </tr>
    </thead>
    <tbody>
        @forelse ( $assistance_with_public_defenders as $key=>$assistance_with_public_defender )
            <tr>
                <td> {{ $key+1 }} </td>
                <td> {{ $assistance_with_public_defender->prisoner->name }} </td>
                <td>
                    @if (!empty( $assistance_with_public_defender->prisoner->unit_address))
                        @foreach ( $assistance_with_public_defender->prisoner->unit_address as $unit_address)
                            @if ($unit_address->status == "ATIVO")
                                {{ $unit_address->cell->cell }}
                            @endif
                        @endforeach
                    @endif
                </td>
                <td> {{ $assistance_with_public_defender->public_defender->public_defender }} </td>
                <td> {{ $assistance_with_public_defender->modality_care->modality_care }} </td>
                <td> {{ \Carbon\Carbon::parse($assistance_with_public_defender->date_of_service)->format('d/m/Y') }} </td>
                <td> {{ $assistance_with_public_defender->time_of_service }} </td>
                <td> {{ $assistance_with_public_defender->status }} </td>
                <td> {{ $assistance_with_public_defender->remark }} </td>
            </tr>
        @empty
            <td> Não existe agendamentos feitos. </td>
        @endforelse
    </tbody>
</table>