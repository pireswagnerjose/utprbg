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
                    <th scope="col"> Data de Nascimento </th>
                    <th scope="col"> Idade </th>
                </tr>
            </thead>
            <tbody>
                @forelse ( $prisoners as $key=>$prisoner )
                <tr>
                    <td> {{ $key+1 }} </td>
                    <td> {{ $prisoner->name }} </td>
                    <td>
                        @if (!empty( $prisoner->unit_address))
                            @foreach ( $prisoner->unit_address as $unit_address)
                                @if ($unit_address->status == "ATIVO")
                                    {{ $unit_address->cell->cell }}
                                @endif
                            @endforeach
                        @endif
                    </td>
                    <td> {{ \Carbon\Carbon::parse($prisoner->date_birth)->format('d/m/Y') }}</td>
                    <td> {{ \Carbon\Carbon::parse($prisoner->date_birth)->age }} ANOS</td>
                </tr>
                @empty
                    <td> Não existe resultado para essa consulta. </td>
                @endforelse
            </tbody>
        </table>
    </main>
</body>
</html>



