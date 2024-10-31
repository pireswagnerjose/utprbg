<h1>Atendimento com a Justiça Restaurativa</h1>
<table>
    <thead>
        <tr>
            <th scope="col"> Cód </th>
            <th scope="col"> Nome do Preso </th>
            <th scope="col"> Cela </th>
            <th scope="col"> Conciliador </th>
            <th scope="col"> Tipo do Atendimento </th>
            <th scope="col"> Data </th>
            <th scope="col"> Hora </th>
            <th scope="col"> Status </th>
            <th scope="col"> Obs. </th>
        </tr>
    </thead>
    <tbody>
        @forelse ( $restorative_justices as $key=>$restorative_justice )
        <tr>
            <td> {{ $key+1 }} </td>
            <td> {{ $restorative_justice->prisoner->name }} </td>
            <td>
                @if (!empty( $restorative_justice->prisoner->unit_address))
                    @foreach ( $restorative_justice->prisoner->unit_address as $unit_address)
                        @if ($unit_address->status == "ATIVO")
                            {{ $unit_address->cell->cell }}
                        @endif
                    @endforeach
                @endif
            </td>
            <td> {{ $restorative_justice->facilitator_conciliator }} </td>
            <td> {{ $restorative_justice->modality_care->modality_care }} </td>
            <td> {{ \Carbon\Carbon::parse($restorative_justice->date_of_service)->format('d/m/Y') }} </td>
            <td> {{ $restorative_justice->time_of_service }} </td>
            <td> {{ $restorative_justice->status }} </td>
            <td> {{ $restorative_justice->remark }} </td>
        </tr>
        @empty
        <td> Não existe agendamentos feitos. </td>
        @endforelse
    </tbody>
</table>