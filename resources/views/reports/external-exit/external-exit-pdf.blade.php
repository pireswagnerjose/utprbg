<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Saídas Externas</title>

    <style>
        *, 
        *:after,
        *:before {
            margin: 0; padding: 0; box-sizing: border-box; text-decoration: none;
            font-family: Arial, Helvetica, sans-serif; border:0;
        }
        body{
            margin:1cm; font-size: 100%; list-style-type: none;
        }
        header{
            width: 100%;  padding-bottom: 2px;
        }
        header img{
            width: 96%; align-items: center;
        }
        main{
            margin-top: 2px; padding-top: 2px; border-top: 1px solid #ccc;
        }
        main table{
            width: 100%; margin: 6px 0; border-collapse: collapse;
        }
        main th{
            font-size: 8px; height: 16px; background-color: #666; color: #CCC; border: 1px solid white;
        }
        main td{
            font-size: 8px; height: 16px; padding: 2px; border: 1px solid #ccc;
        }
        
        tr:nth-child(even) {
            background: #CCC
        }
    </style>
</head>
<body>
    {{-- header --}}
    <header>
        <img src="{{ storage_path('app/public/site/topo_report.png') }}" alt="">
    </header>
    <!-- Page Content -->
    <main>
        <table>
            <thead>
                <tr>
                    <th scope="col"> Cód </th>
                    <th scope="col"> Nome do Preso </th>
                    <th scope="col"> Cela </th>
                    <th scope="col"> Requisitante </th>
                    <th scope="col"> Data </th>
                    <th scope="col"> Hora </th>
                    <th scope="col"> Município </th>
                    <th scope="col"> Status </th>
                    <th scope="col"> Obs. </th>
                </tr>
            </thead>
            <tbody>
                @forelse ( $external_exits as $key=>$external_exit )
                    <tr>
                        <td> {{ $key+1 }} </td>
                        <td> {{ $external_exit->prisoner->name }} </td>
                        <td>
                            @if (!empty( $external_exit->prisoner->unit_address))
                                @foreach ( $external_exit->prisoner->unit_address as $unit_address)
                                    @if ($unit_address->status == "ATIVO")
                                        {{ $unit_address->cell->cell }}
                                    @endif
                                @endforeach
                            @endif
                        </td>
                        <td> {{ $external_exit->requesting->requesting }} </td>
                        <td> {{ \Carbon\Carbon::parse($external_exit->event_date)->format('d/m/Y') }} </td>
                        <td> {{ $external_exit->event_time }} </td>
                        <td style="text-transform: uppercase"> {{ $external_exit->municipality->municipality }}/{{ $external_exit->municipality->state->uf }} </td>
                        <td> {{ $external_exit->status }} </td>
                        <td> {{ $external_exit->remark }} </td>
                    </tr>
                @empty
                    <td> Não existe agendamentos feitos. </td>
                @endforelse
            </tbody>
        </table>
    </main>
</body>
</html>