<h1>Atendimento com Advogado</h1>
<table>
    <thead>
        <tr>
            <th scope="col"> Cód </th>
            <th scope="col"> Nome do Preso </th>
            <th scope="col"> Cela </th>
            <th scope="col"> Nome do Advogado </th>
            <th scope="col"> Tipo do Atendimento </th>
            <th scope="col"> Data </th>
            <th scope="col"> Hora </th>
            <th scope="col"> Status </th>
            <th scope="col"> Obs. </th>
        </tr>
    </thead>
    <tbody>
        @forelse ( $assistance_with_lawyers as $key=>$assistance_with_lawyer )
            <tr>
                <td> {{ $key+1 }} </td>
                <td> {{ $assistance_with_lawyer->prisoner->name }} </td>
                <td>
                    @if (!empty( $assistance_with_lawyer->prisoner->unit_address))
                        @foreach ( $assistance_with_lawyer->prisoner->unit_address as $unit_address)
                            @if ($unit_address->status == "ATIVO")
                                {{ $unit_address->cell->cell }}
                            @endif
                        @endforeach
                    @endif
                </td>
                <td> {{ $assistance_with_lawyer->lawyer->lawyer }} </td>
                <td> {{ $assistance_with_lawyer->modality_care->modality_care }} </td>
                <td> {{ \Carbon\Carbon::parse($assistance_with_lawyer->date_of_service)->format('d/m/Y') }} </td>
                <td> {{ $assistance_with_lawyer->time_of_service }} </td>
                <td> {{ $assistance_with_lawyer->status }} </td>
                <td> {{ $assistance_with_lawyer->remark }} </td>
            </tr>
        @empty
            <td> Não existe agendamentos feitos. </td>
        @endforelse
    </tbody>
</table>