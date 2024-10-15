<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Atendimentos Internos</title>

    <style>
        *, 
        *:after,
        *:before {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            text-decoration: none;
            font-family: Arial, Helvetica, sans-serif;
            border:0;
        }
        body{
            margin:1cm;
            font-size: 100%;
            list-style-type: none;
        }
        header{
            width: 100%;
            padding-bottom: 2px;
        }
        header img{
            width: 96%;
            align-items: center;
        }
        main{
            margin-top: 2px;
            padding-top: 2px;
            border-top: 1px solid #ccc;
        }
        main table{
         width: 100%;
        }
        main th{
         font-size: 8px;
         height: 16px;
         background-color: #333;
         color: #CCC;
        }
        main td{
         font-size: 8px;
         height: 16px;
         padding: 2px;
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
                    <th scope="col">
                        Cód
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Nome do Preso
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Cela
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Tipo do Atendimento
                    </th>
                    <th scope="col" class="px-2 py-3 text-center">
                        Data
                    </th>
                    <th scope="col" class="px-2 py-3 text-center">
                        Hora
                    </th>
                    <th scope="col" class="px-2 py-3 text-center">
                        Status
                    </th>
                    <th scope="col" class="px-2 py-3 text-center">
                        Obs.
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ( $internal_services as $key=>$internal_service )
                    <tr>
                        <td style="width: 3%; text-align: center;">
                            {{ $key+1 }}
                        </td>
                        <td style="width: 27%;">
                            {{ $internal_service->prisoner->name }}
                        </td>
                        <td style="width: 5%; text-align: center; font-weight: bold;">
                            @if (!empty( $internal_service->prisoner->unit_address))
                                @foreach ( $internal_service->prisoner->unit_address as $unit_address)
                                    @if ($unit_address->status == "ATIVO")
                                        {{ $unit_address->cell->cell }}
                                    @endif
                                @endforeach
                            @endif
                        </td>
                        <td style="width: 20%;">
                            {{ $internal_service->type_service->type_service }}
                        </td>
                        <td style="width: 7%; text-align: center;">
                            {{ \Carbon\Carbon::parse($internal_service->date)->format('d/m/Y') }}
                        </td>
                        <td style="width: 7%; text-align: center;">
                            {{ $internal_service->time }}
                        </td>
                        <td style="width: 7%; text-align: center;">
                            {{ $internal_service->status }}
                        </td>
                        <td style="width: 24%;">
                            {{ $internal_service->remark }}
                        </td>
                    </tr>
                @empty
                    <td class="px-2">
                        Não existe agendamentos feitos.
                    </td>
                @endforelse
            </tbody>
        </table>
    </main>
</body>
</html>