<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div style="width: 100%; display: flex; flex-direction: column; align-items: center;">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents('site/topo_report.png')) }}" alt="Cabeçalho" width="700px" />
    </div>
</body>
</html>