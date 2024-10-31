<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Atendimentos Jurídicos</title>

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
        main h1{
            font-size: 12px; text-align: center; color: #666; text-transform: uppercase; font-weight: bold; margin: 12px 0 0 0;
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
        @if (isset($assistance_with_lawyers) && $assistance_with_lawyers->count() > 0)
            @include('reports.legal-assistance.includes.assistance-with-lawyer-table')
        @endif
        @if (isset($assistance_with_public_defenders) && $assistance_with_public_defenders->count() > 0)
            @include('reports.legal-assistance.includes.assistance-with-public-defender-table')
        @endif
        @if (isset($hearing_with_police_officers) && $hearing_with_police_officers->count() > 0)
            @include('reports.legal-assistance.includes.hearing-with-police-officer-table')
        @endif
        @if (isset($restorative_justices) && $restorative_justices->count() > 0)
            @include('reports.legal-assistance.includes.restorative-justice-table')
        @endif
        @if (isset($videoconference_hearings) && $videoconference_hearings->count() > 0)
            @include('reports.legal-assistance.includes.videoconference-hearing-table')
        @endif
    </main>
</body>
</html>