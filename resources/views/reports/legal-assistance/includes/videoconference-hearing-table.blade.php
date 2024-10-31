<h1>Audiência por Videoconferência</h1>
<table>
    <thead>
        <tr>
            <th scope="col"> Cód </th>
            <th scope="col"> Nome do Preso </th>
            <th scope="col"> Cela </th>
            <th scope="col"> Comarca </th>
            <th scope="col"> Vara Criminal </th>
            <th scope="col"> Data </th>
            <th scope="col"> Hora </th>
            <th scope="col"> Status </th>
            <th scope="col"> Obs. </th>
        </tr>
    </thead>
    <tbody>
        @forelse ( $videoconference_hearings as $key=>$videoconference_hearing )
            <tr>
                <td> {{ $key+1 }} </td>
                <td> {{ $videoconference_hearing->prisoner->name }} </td>
                <td>
                    @if (!empty( $videoconference_hearing->prisoner->unit_address))
                        @foreach ( $videoconference_hearing->prisoner->unit_address as $unit_address)
                            @if ($unit_address->status == "ATIVO")
                                {{ $unit_address->cell->cell }}
                            @endif
                        @endforeach
                    @endif
                </td>
                <td> {{ $videoconference_hearing->district->district }} </td>
                <td> {{ $videoconference_hearing->criminal_court->criminal_court }} </td>
                <td> {{ \Carbon\Carbon::parse($videoconference_hearing->date_of_service)->format('d/m/Y') }} </td>
                <td> {{ $videoconference_hearing->time_of_service }} </td>
                <td> {{ $videoconference_hearing->status }} </td>
                <td> {{ $videoconference_hearing->remark }} </td>
            </tr>
        @empty
            <td> Não existe agendamentos feitos.  </td>
        @endforelse
    </tbody>
</table>