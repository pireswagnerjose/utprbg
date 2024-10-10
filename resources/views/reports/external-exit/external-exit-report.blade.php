<!DOCTYPE html>
<html lang="pt-br">
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
   <title>Extra Muro</title>

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
      .prisoner{
          width: 100%;
          padding-top: 5px;
      }
      .prisoner_img{
          width: 23%;
          border-radius: 0.5rem;
          border-radius: 5px;
          position: absolute;
          z-index: 50;
          margin:0;
      }
      .prisoner_img img{
          width: 100%;
          height: 220px;
          border-radius: 5px;
      }
      .prisoner_data{
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
         {{-- PRESO --}}
         <div>
            {{-- Título --}}
            <h1 class="title">AUTORIZAÇÃO DE SAÍDA COM ESCOLTA - EXTRAMUROS</h1>
            {{-- Foto --}}
            <section class="prisoner">
               <article class="prisoner_img">
                  @if ($external_exit->prisoner->photo)
                  <div class="">
                        <img src='{{ storage_path('app/public/' . $external_exit->prisoner->photo) }}' alt="{{ $external_exit->prisoner->name }}" class="rounded-lg" >
                  </div>
                  @else
                  <div width="150px" height="200px" style="border-radius: 5px">
                        <img src='{{ storage_path('app/public/site/sem_imagem.jpeg') }}' alt="sem imagem" class="rounded-lg">
                  </div>
                  @endif
               </article>
               {{-- Dados Básicos --}}
               <article class="prisoner_data">
                  <div class="line">
                        <div class="colum" style="width: 48%;">
                           <span class="item_span">Nome:</span>
                           <p class="item_p" style="font-weight: 700;">{{ $external_exit->prisoner->name }}</p>
                        </div>
                        <div class="colum" style="width: 40%;">
                           <span class="item_span">Alcunha:</span>
                           <p class="item_p" style="font-weight: 700;">{{ $external_exit->prisoner->nickname }}</p>
                        </div>
                        <div class="colum" style="width: 12%;">
                           <span class="item_span">Data Nasc: </span>
                           <p class="item_p">{{ \Carbon\Carbon::parse($external_exit->prisoner->date_birth)->format('d/m/Y') }}</p>
                        </div>
                  </div>

                  <div class="line">
                        <div class="colum" style="width: 25%;">
                           <span class="item_span">CPF: </span>
                           <p class="item_p">{{ $external_exit->prisoner->cpf }}</p>
                        </div>
                        <div class="colum" style="width: 25%;">
                           <span class="item_span">RG: </span>
                           <p class="item_p">{{ $external_exit->prisoner->rg }}</p>
                        </div>
                        <div class="colum" style="width: 25%;">
                           <span class="item_span">Título Eleitor: </span>
                           <p class="item_p">{{ $external_exit->prisoner->title }}</p>
                        </div>
                        <div class="colum" style="width: 25%;">
                           <span class="item_span">Cert. Nasc.: </span>
                           <p class="item_p">{{ $external_exit->prisoner->birth_certificate }}</p>
                        </div>
                  </div>

                  <div class="line">
                        <div class="colum" style="width: 33%;">
                           <span class="item_span">Reservista: </span>
                           <p class="item_p">{{ $external_exit->prisoner->reservist }}</p>
                        </div>
                        <div class="colum" style="width: 33%;">
                           <span class="item_span">Cartão SUS: </span>
                           <p class="item_p">{{ $external_exit->prisoner->sus_card }}</p>
                        </div>
                        <div class="colum" style="width: 33%;">
                           <span class="item_span">RJI: </span>
                           <p class="item_p">{{ $external_exit->prisoner->rji }}</p>
                        </div>
                  </div>

                  <div class="line">
                        <div class="colum" style="width: 25%">
                           <span class="item_span">Sexo: </span>
                           <p class="item_p">{{ $external_exit->prisoner->sex->sex }}</p>
                        </div>
                        <div class="colum" style="width: 25%">
                           <span class="item_span">Etnia: </span>
                           <p class="item_p">{{ $external_exit->prisoner->ethnicity->ethnicity }}</p>
                        </div>
                        <div class="colum" style="width: 25%">
                           <span class="item_span">Orientação Sexual: </span>
                           <p class="item_p">{{ $external_exit->prisoner->sexual_orientation->sexual_orientation }}</p>
                        </div>
                        <div class="colum" style="width: 25%">
                           <span class="item_span">Estado Civil: </span>
                           <p class="item_p">{{ $external_exit->prisoner->civil_status->civil_status }}</p>
                        </div>
                  </div>

                  <div class="line">
                        <div class="colum" style="width: 50%;">
                           <span class="item_span">Nome da Mãe: </span>
                           <p class="item_p">{{ $external_exit->prisoner->mother }}</p>
                        </div>
                        <div class="colum" style="width: 50%;">
                           <span class="item_span">Nome do Pai: </span>
                           <p class="item_p">{{ $external_exit->prisoner->father }}</p>
                        </div>
                  </div>


                  <div class="line">
                        <div class="colum" style="width: 40%;">
                           <span class="item_span">Escolaridade: </span>
                           <p class="item_p">{{ $external_exit->prisoner->education_level->education_level }}</p>
                        </div>
                        <div class="colum" style="width: 20%;">
                           <span class="item_span">Status da Prisão:</span>
                           <p class="item_p">{{ $external_exit->prisoner->status_prison->status_prison }}</p>
                        </div>
                        <div class="colum" style="width: 40%">
                           <span class="item_span">Prifissão: </span>
                           <p class="item_p">{{ $external_exit->prisoner->profession }}</p>
                        </div>
                  </div>

                  <div class="line">
                        <div class="colum" style="width: 40%; text-transform: uppercase;">
                           <span class="item_span">Naturalidade: </span>
                           <p class="item_p">{{ $external_exit->prisoner->municipality->municipality }}</p>
                        </div>
                        <div class="colum" style="width: 40%; text-transform: uppercase;">
                           <span class="item_span">UF: </span>
                           <p class="item_p">{{ $external_exit->prisoner->state->state }}</p>
                        </div>
                        <div class="colum" style="width: 20%">
                           <span class="item_span">Nacionalidade: </span>
                           <p class="item_p">{{ $external_exit->prisoner->country->country }}</p>
                        </div>
                  </div>
                  <div class="line">
                        <div class="colum" style="width:100%; text-transform: uppercase;">
                           <span class="item_span">INFORMAÇÕES COMPLEMENTARES: </span>
                           <p class="item_p">{{ $external_exit->prisoner->remarks }}</p>
                        </div>
                  </div>
               </article>
            </section>
         </div>

         {{-- PRESO --}}
         <div>
            {{-- Título --}}
            <h1 class="title">DADOS COMPLEMENTARES</h1>
            <section>
               <div class="line">
                  <div class="colum" style="width: 50%;">
                      <span class="item_span">Requisitante:</span>
                      <p class="item_p">{{ $external_exit->requesting->requesting }}</p>
                  </div>
                  <div class="colum" style="width: 50%;">
                      <span class="item_span">Motivo da Saída:</span>
                      <p class="item_p">{{ $external_exit->exit_reason->exit_reason }}</p>
                  </div>
               </div>

               <div class="line">
                  <div class="colum" style="width: 50%;">
                      <span class="item_span">Data do Evento:</span>
                      <p class="item_p">{{ \Carbon\Carbon::parse($external_exit->event_date)->format('d/m/Y') }}</p>
                  </div>
                  <div class="colum" style="width: 50%;">
                      <span class="item_span">Hora do Evento:</span>
                      <p class="item_p">{{ $external_exit->event_time }}</p>
                  </div>
               </div>

               <div class="line">
                  <div class="colum" style="width: 50%;">
                     <span class="item_span">Município:</span>
                     <p class="item_p" style="text-transform: uppercase;">{{ $external_exit->municipality->municipality }}</p>
                  </div>
                  <div class="colum" style="width: 50%;">
                     <span class="item_span">Estado:</span>
                     <p class="item_p" style="text-transform: uppercase;">{{ $external_exit->state->state }}</p>
                  </div>
               </div>

               <div class="line">
                  <div class="colum" style="width: 100%;">
                     <span class="item_span">Observação:</span>
                     <p class="item_p" style="text-transform: uppercase;">{{ $external_exit->remark }}</p>
                  </div>
               </div>

               <div class="line">
                  <div class="colum" style="width: 100%; padding-top: 12%; border-top: 1px solid #999;">
                     <p class="item_p" style="margin-top: 6px; text-align: center;">
                        _______________________________________<br><br>
                        Diretor – UTPRBG
                     </p>
                  </div>
               </div>

               <div class="line">
                  <div style="width: 100%; margin-top: 3%;">
                     <div class="colum" style="width: 45%; padding: 4px; margin-right: 7%; border: 1px solid #999;">
                        <p class="item_p" style="margin-top: 6px; text-align: center;">
                           <strong>SAÍDA DA UTPRBG</strong><br><br><br><br>
                           Saída às _____:_____ horas do dia _____/_____/20____.
                           <br><br><br><br>
                           _______________________________________
                           <br>
                           Responsável pela escolta
                        </p>
                     </div>

                     <div class="colum" style="width: 45%; padding: 4px; text-align: center; border: 1px solid #999;">
                        <p class="item_p" style="margin-top: 6px; text-align: center;">
                           <strong>CHEGADA NA UTPRBG</strong><br><br><br><br>
                           Chegada às _____:_____ horas do dia _____/_____/20____.
                           <br><br><br><br>
                           _______________________________________
                           <br>
                           Chefe de Plantão
                        </p>
                     </div>
                  </div>
               </div>

               <div class="line">
                  <div class="colum" style="width: 100%; margin-top: 24px; border-top: 1px solid #999;">
                     <p class="item_p" style="margin-top: 6px;">
                        <strong>Termo de Responsabilidade</strong> <br><br>
                        O reeducando identificado têm autorização desta chefia para  <strong>DEVIDAMENTE ESCOLTADO</strong>
                        pelo Policial Penal acima identificado, ser encaminhado ao local e hora indicados, com a finalidade predeterminada,
                        a escolta pelo presente se compromete e se responsabiliza:
                        <br><br>
                        <strong>01</strong> - Integralmente pela saída e retorno do reeducando acima citado.
                        <br><br>
                        <strong>02</strong> - O reeducando deverá ser conduzido somente ao local referido e para a finalidade mencionada,
                        devendo retornar a esta Unidade ao término do objetivo da saída.
                     </p>
                  </div>
               </div>
            </section>
         </div>
    </main>
</body>
</html>