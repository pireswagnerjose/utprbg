<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Prisoner Report</title>

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
            text-transform: uppercase;
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

        .title {
            font-size: 12px;
            font-weight: bold;
            background-color: #ccc;
            text-align: center;
            color: black;
            clear: both;
        }

        .line {
            width: 100%;
            clear: both;
        }

        .colum {
            float: left;
            margin-bottom: 5px;
        }

        .item_span {
            letter-spacing: -0.025em;
            color: #666;
            font-size: 0.6rem;
            line-height: 1;
            margin: 0;
        }

        .item_p {
            font-size: 0.75rem
                /* 12px */
            ;
            line-height: 1rem
                /* 16px */
            ;
            letter-spacing: -0.025em;
            line-height: 1;
            margin: 0;
            text-align: justify;
        }

        .box {
            width: 100%;
            padding-top: 5px;
        }

        /* PRISONER */
        .prisoner {
            width: 100%;
            padding-top: 5px;
        }

        .prisoner_img {
            width: 23%;
            border-radius: 0.5rem;
            border-radius: 5px;
            position: absolute;
            z-index: 50;
            margin: 0;
        }

        .prisoner_img img {
            width: 100%;
            height: 220px;
            border-radius: 5px;
        }

        .prisoner_data {
            width: 73%;
            margin-left: 27%;
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
        {{ $slot }}
    </main>
</body>

</html>
