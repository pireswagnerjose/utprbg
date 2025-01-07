<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Lista de Visitantes</title>

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
            width: 96%;
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
            font-size: 8px;
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
                    <th scope="col"> Cód </th>
                    <th scope="col"> Nome do Visitante </th>
                    <th scope="col"> Data de Nasc. </th>
                    <th scope="col"> CPF </th>
                    <th scope="col"> Fone </th>
                </tr>
            </thead>
            <tbody>
                @forelse ( $visitants as $key=>$visitant )
                <tr>
                    <td> {{ $key+1 }} </td>
                    <td> {{ $visitant->name }} </td>
                    <td class="p-2"> {{ \Carbon\Carbon::parse($visitant->date_of_birth)->format('d/m/Y') }}</td>
                    <td class="p-2"> {{ $visitant->cpf }} </td>
                    <td class="p-2"> {{ $visitant->phone }} </td>
                </tr>
                @empty
                <td> Sem dados cadastrados. </td>
                @endforelse
            </tbody>
        </table>
    </main>
</body>

</html>