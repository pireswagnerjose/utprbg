<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Visitas Agendadas do Dia</title>

    <style>
        *,
        *:after,
        *:before {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            text-decoration: none;
            font-family: Arial, Helvetica, sans-serif;
            border: 0;
        }

        @page {
            size: A4 landscape;
        }

        body {
            margin: 1cm;
            font-size: 100%;
            list-style-type: none;
        }

        header {
            width: 100%;
            padding-bottom: 2px;
        }

        header img {
            width: 50%;
            align-items: center;
        }

        main {
            margin-top: 2px;
            padding-top: 2px;
            border-top: 1px solid #ccc;
        }

        main table {
            width: 100%;
            margin: 6px 0;
            border-collapse: collapse;
        }

        main th {
            font-size: 8px;
            height: 16px;
            background-color: #666;
            color: #CCC;
            border: 1px solid white;
        }

        main td {
            font-size: 12px;
            height: 16px;
            padding: 2px;
            border: 1px solid #ccc;
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
                    <th scope="col"> Nº </th>
                    <th scope="col"> Cód. </th>
                    <th scope="col"> Visitante </th>
                    <th scope="col"> CPF Visitante </th>
                    <th scope="col"> Preso </th>
                    <th scope="col"> Cela </th>
                    <th scope="col"> Data Visita </th>
                    <th scope="col"> Tipo Visita </th>
                    <th scope="col"> Status </th>
                    <th scope="col"> Observações </th>
                </tr>
            </thead>
            <tbody>
                @forelse ( $visit_schedulings as $key=>$visit )
                    <tr>
                        <td> {{ $key + 1 }} </td>
                        <td> {{ $visit->visit_scheduling_id }} </td>
                        <td> {{ $visit->visitant->name }} </td>
                        <td> {{ $visit->visitant->cpf }} </td>
                        <td> {{ $visit->prisoner->name }} </td>
                        <td>
                            @if (!empty($visit->prisoner->unit_address))
                                @foreach ($visit->prisoner->unit_address as $unit_address)
                                    @if ($unit_address->status == 'ATIVO')
                                        {{ $unit_address->cell->cell }}
                                    @endif
                                @endforeach
                            @endif
                        </td>
                        <td> {{ \Carbon\Carbon::parse($visit->date_visit)->format('d/m/Y') }}</td>
                        </td>
                        <td> {{ $visit->type }} </td>
                        <td> {{ $visit->status ? 'MANTIDA' : 'CANCELADA' }} </td>
                        <td> {{ $visit->remark }} </td>
                    </tr>
                @empty
                    <td> Não existe resultado para essa consulta. </td>
                @endforelse
            </tbody>
        </table>
    </main>
</body>

</html>
