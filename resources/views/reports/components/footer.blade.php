<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .footer{
            font-size: 12px;
            margin:0px 20px 0 20px;
            padding: 1px;
            text-align: center;
            width: 100%;
            border-top: 1px solid #ccc;
            background-color: #ccc;
        }
    </style>

</head>
<body>
    <div class="footer">
        © Polícia Penal - Documento de acesso restrito -
        <?php $date = new DateTimeImmutable();
        echo $date->format('d-m-Y'); ?>
        - Usuário: {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
        - Página @pageNumber de @totalPages
    </div>
</body>
</html>
