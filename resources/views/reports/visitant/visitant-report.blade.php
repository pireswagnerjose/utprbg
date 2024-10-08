<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
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
        .title{
            font-size: 12px;
            font-weight: bold;
            background-color: #ccc;
            text-align: center;
            color: black;
            clear: both;
        }
        .line{
            width: 100%;
            clear: both;
        }
        .colum{
            float: left;
            margin-bottom: 5px;
        }
        .item_span{
            letter-spacing: -0.025em;
            color: #666;
            font-size: 0.6rem;
            line-height: 1;
            margin: 0;
        }
        .item_p{
            font-size: 0.75rem/* 12px */;
            line-height: 1rem/* 16px */;
            letter-spacing: -0.025em;
            line-height: 1;
            margin: 0;
            text-align: justify;
        }
        .box{
            width: 100%;
            padding-top: 5px;
        }

        /* PRISONER */
        .visitant{
            width: 100%;
            padding-top: 5px;
        }
        .visitant_img{
            width: 23%;
            border-radius: 0.5rem;
            border-radius: 5px;
            position: absolute;
            z-index: 50;
            margin:0;
        }
        .visitant_img img{
            width: 100%;
            height: 220px;
            border-radius: 5px;
        }
        .visitant_data{
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
         {{-- VISITANTE --}}
         <div>
            {{-- Título --}}
            <h1 class="title">DADOS BÁSICOS DO VISITANTE</h1>
            {{-- Foto --}}
            <section class="visitant">
               <article class="visitant_img">
                  @if ($visitant->photo)
                  <div >
                        <img src='{{ storage_path('app/public/' . $visitant->photo) }}' alt="{{ "$visitant->name" }}" >
                  </div>
                  @else
                  <div width="150px" height="200px" style="border-radius: 5px">
                        <img src='{{ storage_path('app/public/site/sem_imagem.jpeg') }}' alt="sem imagem" class="rounded-lg">
                  </div>
                  @endif
               </article>
               {{-- Dados Básicos --}}
               <article class="visitant_data">
                  <div class="line">
                     <div class="colum" style="width: 70%;">
                        <span class="item_span">Nome:</span>
                        <p class="item_p" style="font-weight: 700;">{{ $visitant->name }}</p>
                     </div>
                     
                     <div class="colum" style="width: 30%;">
                        <span class="item_span">Data Nasc: </span>
                        <p class="item_p">{{ \Carbon\Carbon::parse($visitant->date_of_birth)->format('d/m/Y') }}</p>
                     </div>
                  </div>

                  <div class="line">
                     <div class="colum" style="width: 34%;">
                        <span class="item_span">CPF:</span>
                        <p class="item_p">{{ $visitant->cpf }}</p>
                     </div>
                     <div class="colum" style="width: 33%;">
                        <span class="item_span">Sexo:</span>
                        <p class="item_p">{{ $visitant->sex->sex }}</p>
                     </div>
                     <div class="colum" style="width: 33%;">
                        <span class="item_span">phone: </span>
                        <p class="item_p">{{ $visitant->phone }}</p>
                     </div>
                  </div>

                  <div class="line">
                     <div class="colum" style="width: 33%;">
                        <span class="item_span">Rua: </span>
                        <p class="item_p">{{ $visitant->street }}</p>
                     </div>
                     <div class="colum" style="width: 33%;">
                        <span class="item_span">Número: </span>
                        <p class="item_p">{{ $visitant->number }}</p>
                     </div>
                  </div>

                  <div class="line">
                        <div class="colum" style="width: 25%">
                           <span class="item_span">Complemento: </span>
                           <p class="item_p">{{ $visitant->complement }}</p>
                        </div>
                        <div class="colum" style="width: 25%">
                           <span class="item_span">Bairro: </span>
                           <p class="item_p">{{ $visitant->barrio }}</p>
                        </div>
                        <div class="colum" style="width: 25%">
                           <span class="item_span">Tipo de Residência: </span>
                           <p class="item_p">{{ $visitant->type_of_residence }}</p>
                        </div>
                        <div class="colum" style="width: 25%">
                           <span class="item_span">Status: </span>
                           <p class="item_p">{{ $visitant->status }}</p>
                        </div>
                  </div>

                  <div class="line">
                        <div class="colum" style="width: 60%; text-transform: uppercase;">
                           <span class="item_span">Naturalidade: </span>
                           <p class="item_p">{{ $visitant->municipality->municipality }}</p>
                        </div>
                        <div class="colum" style="width: 40%; text-transform: uppercase;">
                           <span class="item_span">UF: </span>
                           <p class="item_p">{{ $visitant->state->state }}</p>
                        </div>
                  </div>

                  <div class="line">
                        <div class="colum" style="width:100%; text-transform: uppercase;">
                           <span class="item_span">INFORMAÇÕES COMPLEMENTARES: </span>
                           <p class="item_p">{{ $visitant->remark }}</p>
                        </div>
                  </div>
               </article>
            </section>
         </div>
    </main>
</body>
</html>