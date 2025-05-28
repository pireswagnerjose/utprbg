<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Advogado: {{ $lawyer->lawyer }}</title>

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
            size: A4 portrait;
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
            width: 80%;
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

        .item_span {
            letter-spacing: -0.025em;
            text-transform: uppercase;
            color: #666;
            font-size: 0.6rem;
            line-height: 1;
            margin: 0;
        }

        .item_p {
            font-size: 1.0rem
                /* 12px */
            ;
            line-height: 1rem
                /* 16px */
            ;
            letter-spacing: -0.025em;
            line-height: 1;
            margin: 0;
            text-align: justify;
            font-weight: bold;
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
        <div>
            <h1 style="text-transform: uppercase; font-weight: bold; font-size: 18px; text-align: center; color: #666;">
                Dados do(a) Advogado(a)
            </h1>
            <div style="float: left; margin: 10px 0">
                <img src='{{ storage_path('app/public/' . $lawyer->photo) }}' width="300px">
            </div>
            <div style="padding: 10px;">
                <div>
                    <div>
                        <span class="item_span">Advogado:</span>
                        <p class="item_p" style="font-size: 16px;">{{ $lawyer->lawyer }}</p>
                    </div>
                    <div>
                        <span class="item_span">Registro OAB: </span>
                        <p class="item_p">{{ $lawyer->register }}</p>
                    </div>
                    <div>
                        <span class="item_span">Contato: </span>
                        <p class="item_p">{{ $lawyer->contact }}</p>
                    </div>
                </div>
                <div style="margin-top: 12px">
                    <span class="item_span">Observação: </span>
                    <p class="item_p">{{ $lawyer->remark }}</p>
                </div>
            </div>
        </div>
        <div style="clear: both"></div>
        <h1 style="text-transform: uppercase; font-weight: bold; font-size: 18px; text-align: center; color: #666;">
            Atendimento(s) do(a) Advogado(a)
        </h1>
        <table>
            <thead>
                <tr>
                    <th scope="col"> Nº </th>
                    <th scope="col"> Preso </th>
                    <th scope="col"> Data Atendimento </th>
                    <th scope="col"> Tipo Atendimento </th>
                    <th scope="col"> Status </th>
                    <th scope="col"> Observação </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($lawyer->assistance_with_lawyers as $key=>$assistance_with_lawyer)
                    <tr>
                        <td> {{ $key + 1 }} </td>
                        <td> {{ $assistance_with_lawyer->prisoner->name }} </td>
                        <td> {{ \Carbon\Carbon::parse($assistance_with_lawyer->date_of_service)->format('d/m/Y') }}
                        </td>
                        <td> {{ $assistance_with_lawyer->modality_care->modality_care }} </td>
                        <td> {{ $assistance_with_lawyer->status }} </td>
                        <td> {{ $assistance_with_lawyer->remark }} </td>
                    </tr>
                @empty
                    <td colspan="6"> Sem atendimento para esse advogado.
                    </td>
                @endforelse
            </tbody>
        </table>
    </main>
</body>

</html>
